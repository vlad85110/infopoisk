<?php

function dbConnect() {
    $username = "vlad";
    $password = "1234";
    $dbname = "testdb";

    $conn = mysqli_connect("localhost", $username, $password);
    if (!$conn ) die("Нет соединения с MySQL");

    mysqli_select_db($conn, $dbname)
    or die ("Нельзя открыть $dbname");

    return $conn;
}