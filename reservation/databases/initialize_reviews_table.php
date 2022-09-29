<?php

require_once __DIR__ . '/..//lib/mysqli.php';

function dropTable($link)
{
  $dropTableSql = 'DROP TABLE IF EXISTS reservations';
  $result = mysqli_query($link, $dropTableSql);
  if ($result) {
    echo 'テーブルを削除しました' . PHP_EOL;
  } else {
    echo 'Error: テーブルの削除に失敗しました' . PHP_EOL;
    echo 'Debugging Error: ' . mysqli_error($link) . PHP_EOL;
  }
}

$exists = dropTable($link, "seats");

function createTable($link)
{
  $createTableSql = <<<EOT
CREATE TABLE reservations (
    id INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name VARCHAR(50),
    time_st DATE,
    time_end DATE,
    kwd VARCHAR(255),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARACTER SET=utf8mb4;
EOT;
  $result = mysqli_query($link, $createTableSql);
  if ($result) {
    echo 'テーブルを作成しました' . PHP_EOL;
  } else {
    echo 'Error: テーブルを作成しました' . PHP_EOL;
    echo 'Debugging Error' . mysqli_error($link) . PHP_EOL;
  }
}

$link = dbConnect();
dropTable($link);
createTable($link);
mysqli_close($link);
