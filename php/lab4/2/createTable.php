<?php

$username = "vlad";
$password = "1234";
$dbname = "testdb";

$conn = mysqli_connect("localhost", $username, $password);
if (!$conn ) die("Нет соединения с MySQL");

mysqli_select_db($conn, $dbname)
or die ("Нельзя открыть $dbname");

$sql = "CREATE TABLE notebook (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50) NOT NULL,
city VARCHAR(50),
address VARCHAR(50),
birthday DATE,
mail VARCHAR(50) NOT NULL 
)";

mysqli_query($conn, "DROP TABLE IF EXISTS notebook");

try {
    $result = mysqli_query($conn, $sql);
    print "Таблица успешно создана";
} catch (Exception $err) {
    print "Не удалось создать таблицу";
}

mysqli_close($conn);