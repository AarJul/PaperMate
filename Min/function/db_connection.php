<?php

function connection()
{
  // table connect
  $server_name = "localhost";
  $db_user = "dbuser";
  $db_name = "papermate";
  $password = "ecc";

  $options = [
    // PDOの例外エラーを詳細にする
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // 結果を連想配列として返してくれる
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // エミュレートをオフにする
    PDO::ATTR_EMULATE_PREPARES => false,
  ];

  // データベースに接続
  try {
    return  new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8mb4", $db_user, $password, $options);
  } catch (PDOException $e) {
    echo "データベース接続エラー: " . $e->getMessage();
  }
}
