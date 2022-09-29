<?php

// 変数の初期化
$company = [
  'name' => '',
  'establishment' => '',
  'founder' => ''
];

$errors = [];

$title = '予約変更フォーム | HYUGA BASE 座席予約システム';
$content = __DIR__ . '/views/edit.php';

include __DIR__ . '/views/layout.php';
