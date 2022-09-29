<?php

require __DIR__ . '/../vendor/autoload.php';

function dbConnect()
{
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();

    $dbHost = $_ENV['DB_HOST'];
    $dbUsername = $_ENV['DB_USERNAME'];
    $dbPassword = $_ENV['DB_PASSWORD'];
    $dbDatabase = $_ENV['DB_DATABASE'];

    $link = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbDatabase);
    if (!$link) {
        echo 'Error： データベースに接続できません' . PHP_EOL;
        echo 'Debugging error:' . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    return $link;
}


function dropTable($link)
{
    $dropTablesql = 'DROP TABLE IF EXISTS companies;';
    $result = mysqli_query($link, $dropTablesql);
    if ($result) {
        echo 'テーブルを削除しました' . PHP_EOL;
    } else {
        echo 'Error: データの削除に失敗しました' . PHP_EOL;
        echo 'Debugging Error: ' . mysqli_error($link) . PHP_EOL . PHP_EOL;
    }
}

function createTable($link)
{
    //     $createTablesql = <<<EOT
    // CREATE TABLE reservations (
    //     id INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
    //     name VARCHAR(50),
    //     sect VARCHAR(10),
    //     time_st DATE,
    //     time_end DATE,
    //     cpt_name VARCHAR(10),
    //     kwd VARCHAR(255),
    //     created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    // ) DEFAULT CHARACTER SET=utf8mb4;
    // EOT;
    $result = mysqli_query($link, $createTablesql);
    if ($result) {
        echo 'テーブルを作成しました' . PHP_EOL;
    } else {
        echo 'Error: データの作成に失敗しました' . PHP_EOL;
        echo 'Debugging Error: ' . mysqli_error($link) . PHP_EOL . PHP_EOL;
    }
}

$link = dbConnect();
dropTable($link);
createTable($link);
mysqli_close($link);
