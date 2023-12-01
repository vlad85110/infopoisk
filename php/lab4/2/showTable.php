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
include("showTables.php");
include("dbConnect.php");

$conn = dbConnect();
showTableContent($conn, "notebook");

mysqli_close($conn);
?>

</body>
</html>