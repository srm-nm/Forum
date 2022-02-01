<?php
ini_set("display_errors", "On");
ini_set("error_reporting", "E_ALL");

$dsn = "mysql:host=localhost;dbname=Forum;charset=utf8";
$username = "root";
$password = "root";
try{
    $pdo = new PDO($dsn, $username, $password);
//     $pdo->set_charset('UTF8');
    mysql_query('SET NAMES utf8');
    
    echo "MySQL への接続に成功しました。";
}  catch (PDOException $e) {
    $isConnect = false;
    echo "MySQL への接続に失敗しました。<br>(" . $e->getMessage() . ")";
}