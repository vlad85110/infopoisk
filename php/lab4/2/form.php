<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма для таблицы notebook</title>
    <style>
        label {
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<?php

include("dbConnect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST["name"];
    $city = $_POST["city"];
    $address = $_POST["address"];
    $birthday = !empty($_POST["birthday"]) ? "'" . $_POST["birthday"] . "'" : 'NULL';
    $mail = $_POST["mail"];

    $conn = dbConnect();

    $sql = "INSERT INTO notebook (name, city, address, birthday, mail) 
        VALUES ('$name', '$city', '$address', $birthday, '$mail')";
    
    try {
        mysqli_query($conn, $sql);
    } catch (Exception $e) {
        print $e->getMessage();
    }
    mysqli_close($conn);
}
?>

<h2>Заполните таблицу notebook</h2>

<form action="form.php" method="post">
    <div>
        <a>Введите фамилию и имя [*]: </a>
        <input type="text" id="name" name="name" required maxlength="50">
    </div>

    <br>

    <div>
        <a>Введите город:</a>
        <input type="text" id="city" name="city" maxlength="50">
    </div>

    <br>

    <div>
        <a>Введите адрес:</a>
        <input type="text" id="address" name="address" maxlength="50">
    </div>

    <br>

    <div>
        <a for="birthday">Введите дату рождения:</a>
        <input type="date" id="birthday" name="birthday">
    </div>

    <br>

    <div>
        <a for="mail">Введите email[*]:</a>
        <input type="email" id="mail" name="mail" maxlength="40" required>
    </div>

    <br>

    <input type="submit" value="Отправить">
</form>

<br>

<div>Поля, помеченные [*], являются обязательными</div>

</body>
</html>
