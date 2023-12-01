<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отображение таблиц</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
include("dbConnect.php");
include("showTables.php");

$tables = array("sal", "cust", "ord");
$conn = dbConnect();

for ($i = 1; $i <= 3; $i++) {
    $isShowContent = $_GET["showContent$i"];
    $isShowStructure = $_GET["showStructure$i"];

    $tableName = $tables[$i - 1];

    if ($isShowContent) {
        showTableContent($conn, $tableName);
    }

    if ($isShowStructure) {
        showTableStructure($conn, $tableName);
    }
}

mysqli_close($conn);
?>

<a href="form.html">Возврат к выбору таблицы</a>
</body>
</html>