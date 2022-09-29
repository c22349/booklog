<?php

$review = [
  'title' => '',
  'author' => '',
  'status' => '未読',
  'score' => '',
  'summary' => ''
];
$errors = [];

$title = '読書ログ登録';
$content = __DIR__ . "/views/new.php";
include __DIR__ . '/views/layout.php';
