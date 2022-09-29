<?php

require_once __DIR__ . '/lib/mysqli.php';

function createReserve($link, $reserve)
{
  $sql = <<<EOT
INSERT INTO reservations (
  name,
  sect,
  time_st,
  time_end,
  cpt_name,
  kwd
) VALUES (
  "{$reserve['name']}",
  "{$reserve['sect']}",
  "{$reserve['time_st']}",
  "{$reserve['time_end']}",
  "{$reserve['cpt_name']}",
  "{$reserve['kwd']}"
)
EOT;
  $result = mysqli_query($link, $sql);
  if (!$result) {
    error_log('Error: fail to create reservation');
    error_log('Debugging Error:') . mysqli_error($link);
  }
}

function validate($reserve)
{
  // $error = [];
  // if (!strlen($reserve['name'])) {
  //   $errors['name'] = '名前を入力してください';
  // } elseif (strlen($reserve['name']) > 100) {
  //   $errors['name'] = '登録者名は100文字以内で入力してください';
  // }
  // $dates = explode('-', $reserve['day']);
  // if (!strlen($reserve['day'])) {
  //   $errors['day'] = '予約日を入力してください';
  // } elseif (count($reserve) !== 3) {
  //   $errors['day'] = '予約日を正しい形式で入力してください';
  // }
  // return $errors;
}

function DispReservation($sel)
{
  $start = date('Y-m-d') . ' 00:00:00';
  $end   = date('Y-m-d') . ' 24:00:00';
  switch ($sel) {
    case 0:
      $reservation = date('Y-m-d') . ' 09:00:00';
      break;
    case 1:
      $reservation = date('Y-m-d') . ' 15:00:00';
      break;
    case 2:
      $reservation = date('Y-m-d') . ' 19:00:00';
      break;
  }
  for ($i = $start; $i < $end; $i = date('Y-m-d H:i:s', strtotime($i . ' +1 hours'))) {
    if ($i == $reservation) {
      print '<td class="reservation"></td>';
    } else {
      print '<td></td>';
    }
  }
}




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $reserve = [
    'name' => $_POST['name'],
    'sect' => $_POST['sect'],
    'time_st' => $_POST['time_st'],
    'time_end' => $_POST['time_end'],
    'cpt_name' => $_POST['cpt_name'],
    'kwd' => $_POST['kwd']
  ];
  $errors = validate($reserve);
  if (!count($errors)) {
    $link = dbConnect();
    createReserve($link, $reserve);
    mysqli_close($link);
    header("Location: index.php");
  }
}

include 'views/new.php';
