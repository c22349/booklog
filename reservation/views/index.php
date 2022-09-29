<main>
  <h1 class="h2 text-dark mt-4 mb-4">予約トップ</h1>

  <section>
    <h2 class="h3 text-dark mt-4 mb-4">現在の使用状況</h2>

    <div id="layout"><?php
                      foreach ($seats as $s) {
                        $taken = is_numeric($s["user_id"]);
                        printf(
                          "<div class='seat%s'%s>%s</div>",
                          $taken ? " taken" : "",
                          $taken ? "" : " onclick='reserve.toggle(this)'",
                          $s["seat_id"]
                        );
                      }
                      ?></div>

    <div>Green seats - Open</div>
    <div>Grey seats - Taken</div>
    <div>Blue seats - Your chosen seats</div>



    <!-- <img src="image/floormap.jpg" alt="HYUGA BASEフロアマップ"> -->
    <div class="">イメージ入ります※削除</div>
  </section>

  <section>
    <h2 class="h3 text-dark mt-4 mb-4">希望日を選択してしてください</h2>
    <div class="container">
      <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a><?php echo $html_title; ?><a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
      <table class="table table-bordered">
        <tr>
          <th>日</th>
          <th>月</th>
          <th>火</th>
          <th>水</th>
          <th>木</th>
          <th>金</th>
          <th>土</th>
        </tr>
        <?php
        foreach ($weeks as $week) {
          echo $week;
        }
        ?>
      </table>
    </div>
  </section>

  <div class="">希望日<div class="">2022/06/28</div>
  </div>
  <a href="new.php" class="btn btn-primary mb-4">予約をする</a>
  <a href="edit.php" class="btn btn-success mb-4">予約を変更</a>
  <a href="cancel.php" class="btn btn-danger mb-4">予約キャンセル</a>
</main>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PHP Hotel Room Booking (JavaScript/HTML5, MySQL)</title>

  <style type="text/css">
    p,
    body,
    td,
    input,
    select,
    button {
      font-family: -apple-system, system-ui, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
      font-size: 14px;
    }

    body {
      padding: 0px;
      margin: 0px;
      background-color: #ffffff;
    }

    a {
      color: #1155a3;
    }

    .space {
      margin: 10px 0px 10px 0px;
    }

    .header {
      background: #003267;
      background: linear-gradient(to right, #011329 0%, #00639e 44%, #011329 100%);
      padding: 20px 10px;
      color: white;
      box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.75);
    }

    .header a {
      color: white;
    }

    .header h1 a {
      text-decoration: none;
    }

    .header h1 {
      padding: 0px;
      margin: 0px;
    }

    .main {
      padding: 10px;
      margin-top: 10px;
    }
  </style>

  <!-- DayPilot library -->
  <script src="js/daypilot/daypilot-all.min.js"></script>

  <link type="text/css" rel="stylesheet" href="icons/style.css" />

  <style type="text/css">
    select {
      padding: 5px;
    }

    .toolbar {
      margin: 10px 0px;
    }

    .toolbar button {
      padding: 5px 15px;
    }

    .icon {
      font-size: 14px;
      text-align: center;
      line-height: 14px;
      vertical-align: middle;

      cursor: pointer;
    }

    .toolbar-separator {
      width: 1px;
      height: 28px;
      /*content: '&nbsp;';*/
      display: inline-block;
      box-sizing: border-box;
      background-color: #ccc;
      margin-bottom: -8px;
      margin-left: 15px;
      margin-right: 15px;
    }

    .scheduler_default_rowheader_inner {
      border-right: 1px solid #ccc;
    }

    .scheduler_default_rowheadercol2 {
      background: White;
    }

    .scheduler_default_rowheadercol2 .scheduler_default_rowheader_inner {
      top: 2px;
      bottom: 2px;
      left: 2px;
      background-color: transparent;
      border-left: 5px solid #38761d;
      /* green */
      border-right: 0px none;
    }

    .status_dirty.scheduler_default_rowheadercol2 .scheduler_default_rowheader_inner {
      border-left: 5px solid #cc0000;
      /* red */
    }

    .status_cleanup.scheduler_default_rowheadercol2 .scheduler_default_rowheader_inner {
      border-left: 5px solid #e69138;
      /* orange */
    }

    .area-menu {
      background-image: url("data:image/svg+xml,%3Csvg width='10' height='10' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M 0.5 1.5 L 5 6.5 L 9.5 1.5' style='fill:none;stroke:%23999999;stroke-width:2;stroke-linejoin:round;stroke-linecap:butt' /%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: center center;
      border: 1px solid #ccc;
      background-color: #fff;
      border-radius: 3px;
      opacity: 0.8;
      cursor: pointer;
    }

    .area-menu:hover {
      opacity: 1;
    }
  </style>

</head>


<div class="main">
  <div style="width:220px; float:left;">
    <div id="nav"></div>
  </div>

  <div style="margin-left: 220px;">

    <div class="toolbar">

      Room filter:
      <select id="filter">
        <option value="0">All</option>
        <option value="1">Single</option>
        <option value="2">Double</option>
        <option value="4">Family</option>
      </select>

      &nbsp;&nbsp;

      <button id="addroom">Add Room</button>

      <div class="toolbar-separator"></div>

      Time range:
      <select id="timerange">
        <option value="week">Week</option>
        <option value="month" selected>Month</option>
      </select>
      <div class="toolbar-separator"></div>
      <label for="autocellwidth"><input type="checkbox" id="autocellwidth">Auto Cell Width</label>

    </div>

    <div id="dp"></div>

  </div>

</div>

<script type="text/javascript">
  const nav = new DayPilot.Navigator("nav");
  nav.selectMode = "month";
  nav.showMonths = 3;
  nav.skipMonths = 3;
  nav.onTimeRangeSelected = function(args) {
    loadTimeline(args.start);
    dp.update();
    loadReservations();
  };
  nav.init();
</script>

<script>
  const dp = new DayPilot.Scheduler("dp");

  dp.allowEventOverlap = false;

  dp.days = dp.startDate.daysInMonth();
  loadTimeline(DayPilot.Date.today().firstDayOfMonth());

  dp.eventDeleteHandling = "Update";

  dp.timeHeaders = [{
      groupBy: "Month",
      format: "MMMM yyyy"
    },
    {
      groupBy: "Day",
      format: "d"
    }
  ];

  dp.eventHeight = 80;
  dp.cellWidth = 60;

  dp.rowHeaderColumns = [{
      title: "Room",
      display: "name",
      sort: "name"
    },
    {
      title: "Capacity",
      display: "capacity",
      sort: "capacity"
    },
    {
      title: "Status",
      display: "status",
      sort: "status"
    }
  ];

  dp.separators = [{
    location: DayPilot.Date.now(),
    color: "red"
  }];

  dp.contextMenuResource = new DayPilot.Menu({
    items: [{
        text: "Edit...",
        onClick: async (args) => {
          const capacities = [{
              name: "1",
              id: 1
            },
            {
              name: "2",
              id: 2
            },
            {
              name: "4",
              id: 4
            },
          ];

          const statuses = [{
              name: "Ready",
              id: "Ready"
            },
            {
              name: "Cleanup",
              id: "Cleanup"
            },
            {
              name: "Dirty",
              id: "Dirty"
            },
          ];

          const form = [{
              name: "Room Name",
              id: "name"
            },
            {
              name: "Capacity",
              id: "capacity",
              options: capacities
            },
            {
              name: "Status",
              id: "status",
              options: statuses
            }
          ];

          const data = args.source.data;

          const modal = await DayPilot.Modal.form(form, data);
          if (modal.canceled) {
            return;
          }

          const room = modal.result;
          await DayPilot.Http.post("backend_room_update.php", room);
          dp.rows.update(room);
        }
      },
      {
        text: "Delete",
        onClick: async (args) => {
          const id = args.source.id;

          await DayPilot.Http.post("backend_room_delete.php", {
            id: id
          });
          dp.rows.remove(id);
        }
      }
    ]
  });

  dp.onBeforeRowHeaderRender = (args) => {
    const beds = (count) => {
      return count + " bed" + (count > 1 ? "s" : "");
    };

    args.row.columns[1].html = beds(args.row.data.capacity);
    switch (args.row.data.status) {
      case "Dirty":
        args.row.cssClass = "status_dirty";
        break;
      case "Cleanup":
        args.row.cssClass = "status_cleanup";
        break;
    }

    args.row.columns[0].areas = [{
      right: 3,
      top: 3,
      width: 16,
      height: 16,
      cssClass: "area-menu",
      action: "ContextMenu",
      visibility: "Hover"
    }];

  };

  // http://api.daypilot.org/daypilot-scheduler-oneventmoved/
  dp.onEventMoved = async (args) => {
    const params = {
      id: args.e.id(),
      newStart: args.newStart,
      newEnd: args.newEnd,
      newResource: args.newResource
    };

    const {
      data
    } = await DayPilot.Http.post("backend_reservation_move.php", params);
    dp.message(data.message);

  };

  // http://api.daypilot.org/daypilot-scheduler-oneventresized/
  dp.onEventResized = async (args) => {
    const params = {
      id: args.e.id(),
      newStart: args.newStart,
      newEnd: args.newEnd
    };

    const {
      data
    } = await DayPilot.Http.post("backend_reservation_resize.php", params);
    dp.message("Resized");

  };

  dp.onEventDeleted = async (args) => {
    await DayPilot.Http.post("backend_reservation_delete.php", {
      id: args.e.id()
    });
    dp.message("Deleted.");
  };

  // event creating
  // http://api.daypilot.org/daypilot-scheduler-ontimerangeselected/
  dp.onTimeRangeSelected = async (args) => {

    const rooms = dp.resources.map((item) => {
      return {
        name: item.name,
        id: item.id
      };
    });

    const form = [{
        name: "Text",
        id: "text"
      },
      {
        name: "Start",
        id: "start",
        dateFormat: "MM/dd/yyyy HH:mm tt"
      },
      {
        name: "End",
        id: "end",
        dateFormat: "MM/dd/yyyy HH:mm tt"
      },
      {
        name: "Room",
        id: "resource",
        options: rooms
      },
    ];

    const data = {
      start: args.start,
      end: args.end,
      resource: args.resource
    };

    const modal = await DayPilot.Modal.form(form, data);

    dp.clearSelection();
    if (modal.canceled) {
      return;
    }
    const e = modal.result;

    const {
      data: result
    } = await DayPilot.Http.post("backend_reservation_create.php", e);

    e.id = result.id;
    e.paid = result.paid;
    e.status = result.status;
    dp.events.add(e);

  };

  dp.onEventClick = async (args) => {
    const rooms = dp.resources.map((item) => {
      return {
        name: item.name,
        id: item.id
      };
    });

    const statuses = [{
        name: "New",
        id: "New"
      },
      {
        name: "Confirmed",
        id: "Confirmed"
      },
      {
        name: "Arrived",
        id: "Arrived"
      },
      {
        name: "CheckedOut",
        id: "CheckedOut"
      }
    ];

    const paidoptions = [{
        name: "0%",
        id: 0
      },
      {
        name: "50%",
        id: 50
      },
      {
        name: "100%",
        id: 100
      },
    ]

    const form = [{
        name: "Text",
        id: "text"
      },
      {
        name: "Start",
        id: "start",
        dateFormat: "MM/dd/yyyy h:mm tt"
      },
      {
        name: "End",
        id: "end",
        dateFormat: "MM/dd/yyyy h:mm tt"
      },
      {
        name: "Room",
        id: "resource",
        options: rooms
      },
      {
        name: "Status",
        id: "status",
        options: statuses
      },
      {
        name: "Paid",
        id: "paid",
        options: paidoptions
      },
    ];

    const data = args.e.data;

    const modal = await DayPilot.Modal.form(form, data);

    dp.clearSelection();
    if (modal.canceled) {
      return;
    }
    const e = modal.result;
    await DayPilot.Http.post("backend_reservation_update.php", e);
    dp.events.update(e);
  };

  dp.onBeforeEventRender = (args) => {
    const start = new DayPilot.Date(args.data.start);
    const end = new DayPilot.Date(args.data.end);

    const today = DayPilot.Date.today();
    const now = new DayPilot.Date();

    args.data.html = DayPilot.Util.escapeHtml(args.data.text) + " (" + start.toString("M/d/yyyy") + " - " + end.toString("M/d/yyyy") + ")";

    switch (args.data.status) {
      case "New":
        const in2days = today.addDays(1);

        if (start < in2days) {
          args.data.barColor = '#cc0000';
          args.data.toolTip = 'Expired (not confirmed in time)';
        } else {
          args.data.barColor = '#e69138';
          args.data.toolTip = 'New';
        }
        break;
      case "Confirmed":
        const arrivalDeadline = today.addHours(18);

        if (start < today || (start.getDatePart() === today.getDatePart() && now > arrivalDeadline)) { // must arrive before 6 pm
          args.data.barColor = "#cc4125"; // red
          args.data.toolTip = 'Late arrival';
        } else {
          args.data.barColor = "#38761d";
          args.data.toolTip = "Confirmed";
        }
        break;
      case 'Arrived': // arrived
        const checkoutDeadline = today.addHours(10);

        if (end < today || (end.getDatePart() === today.getDatePart() && now > checkoutDeadline)) { // must checkout before 10 am
          args.data.barColor = "#cc4125"; // red
          args.data.toolTip = "Late checkout";
        } else {
          args.data.barColor = "#1691f4"; // blue
          args.data.toolTip = "Arrived";
        }
        break;
      case 'CheckedOut': // checked out
        args.data.barColor = "gray";
        args.data.toolTip = "Checked out";
        break;
      default:
        args.data.toolTip = "Unexpected state";
        break;
    }

    args.data.html = "<div>" + args.data.html + "<br /><span style='color:gray'>" + args.data.toolTip + "</span></div>";

    const paid = args.data.paid;
    const paidColor = "#aaaaaa";

    args.data.areas = [{
        bottom: 10,
        right: 4,
        html: "<div style='color:" + paidColor + "; font-size: 8pt;'>Paid: " + paid + "%</div>",
        v: "Visible"
      },
      {
        left: 4,
        bottom: 8,
        right: 4,
        height: 2,
        html: "<div style='background-color:" + paidColor + "; height: 100%; width:" + paid + "%'></div>",
        v: "Visible"
      }
    ];

  };


  dp.init();

  const elements = {
    filter: document.querySelector("#filter"),
    timerange: document.querySelector("#timerange"),
    autocellwidth: document.querySelector("#autocellwidth"),
    addroom: document.querySelector("#addroom"),
  };

  loadRooms();
  loadReservations();

  function loadTimeline(date) {
    dp.scale = "Manual";
    dp.timeline = [];
    const start = date.getDatePart().addHours(12);

    for (let i = 0; i < dp.days; i++) {
      dp.timeline.push({
        start: start.addDays(i),
        end: start.addDays(i + 1)
      });
    }
  }

  function loadReservations() {
    dp.events.load("backend_reservations.php");
  }

  async function loadRooms() {
    const {
      data
    } = await DayPilot.Http.post("backend_rooms.php", {
      capacity: elements.filter.value
    });
    dp.resources = data;
    dp.update();
  }

  elements.filter.addEventListener("change", (e) => {
    loadRooms();
  });

  elements.timerange.addEventListener("change", () => {
    switch (this.value) {
      case "week":
        dp.days = 7;
        nav.selectMode = "Week";
        nav.select(nav.selectionDay);
        break;
      case "month":
        dp.days = dp.startDate.daysInMonth();
        nav.selectMode = "Month";
        nav.select(nav.selectionDay);
        break;
    }
  });

  elements.autocellwidth.addEventListener("click", () => {
    dp.cellWidth = 60; // reset for "Fixed" mode
    dp.cellWidthSpec = this.checked ? "Auto" : "Fixed";
    dp.update();
  });

  elements.addroom.addEventListener("click", async (ev) => {
    ev.preventDefault();

    const capacities = [{
        name: "1",
        id: 1
      },
      {
        name: "2",
        id: 2
      },
      {
        name: "4",
        id: 4
      },
    ];

    const form = [{
        name: "Room Name",
        id: "name"
      },
      {
        name: "Capacity",
        id: "capacity",
        options: capacities
      }
    ];

    const data = {
      capacity: 2
    };

    const modal = await DayPilot.Modal.form(form, data);
    if (modal.canceled) {
      return;
    }

    const room = modal.result;
    const {
      data: result
    } = await DayPilot.Http.post("backend_room_create.php", room);

    room.id = result.id;
    room.status = result.status;
    dp.resources.push(room);
    dp.update();

  });
</script>
