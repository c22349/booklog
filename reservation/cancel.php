<?php

// 変数の初期化
$company = [
  'name' => '',
  'establishment' => '',
  'founder' => ''
];

$errors = [];

$title = '予約キャンセル フォーム | HYUGA BASE 座席予約システム';
$content = __DIR__ . '/views/cancel.php';

include __DIR__ . '/views/layout.php';
