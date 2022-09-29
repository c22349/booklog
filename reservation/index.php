<?php

require_once __DIR__ . '/lib/escape.php';
require_once __DIR__ . '/lib/mysqli.php';


function listCompanies($link)
{
  $companies = [];
  $sql = 'SELECT name, establishment, founder FROM companies;';
  $results = mysqli_query($link, $sql);

  while ($company = mysqli_fetch_assoc($results)) {
    $companies[] = $company;
  }
  mysqli_free_result($results);
  return $companies;
}

$link = dbConnect();
$companies = listCompanies($link);


// カレンダー
date_default_timezone_set('Asia/Tokyo');
if (isset($_GET['ym'])) {
  $ym = $_GET['ym'];
} else {
  $ym = date('Y-m');
}
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
  $ym = date('Y-m');
  $timestamp = strtotime($ym . '-01');
}
$today = date('Y-m-j');
$html_title = date('Y年n月', $timestamp);
$prev = date('Y-m', strtotime('-1 month', $timestamp));
$next = date('Y-m', strtotime('+1 month', $timestamp));
$day_count = date('t', $timestamp);
$youbi = date('w', $timestamp);
$weeks = [];
$week = '';
$week .= str_repeat('<td></td>', $youbi);
for ($day = 1; $day <= $day_count; $day++, $youbi++) {
  $date = $ym . '-' . $day;
  if ($today == $date) {
    $week .= '<td class="today">' . $day;
  } else {
    $week .= '<td>' . $day;
  }
  $week .= '</td>';
  if ($youbi % 7 == 6 || $day == $day_count) {
    if ($day == $day_count) {
      $week .= str_repeat('<td></td>', 6 - ($youbi % 7));
    }
    $weeks[] = '<tr>' . $week . '</tr>';
    $week = '';
  }
}

$title = 'トップページ | HYUGA BASE 座席予約システム';
$content = __DIR__ . '/views/index.php';
include __DIR__ . '/views/layout.php';
