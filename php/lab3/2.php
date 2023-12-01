<html>
<head>
    <title> Листинг 10-1. Простая HTML-форма </title>
</head>
<body>

<?php
$horizontal = $_GET['horizontal'];
$vertical = $_GET['vertical'];

if ($horizontal == "") {
    $horizontal = "left";
}

if ($vertical == "") {
    $vertical = "top";
}

print "<table border=1 style='width: 100px; height: 100px;'>\n";
print "<tr>\n";
print "\t<td style='text-align: $horizontal; vertical-align: $vertical;'>";
print "<span>Текст";

print "</td>\n";
print "</tr>\n";
print "</table>";

?>
<form action="2.php" method="GET">
    <p><b>Выберите горизонтальное расположение:</b></p>
    <p><input type="radio" name="horizontal" value="left">слева</p>
    <p><input type="radio" name="horizontal" value="center">по центру</p>
    <p><input type="radio" name="horizontal" value="right">справа</p>

    <p><b>Выберите вертикальное расположение:</b></p>
    <p><input type="checkbox" name="vertical" value="top">сверху</p>
    <p><input type="checkbox" name="vertical" value="center">посередине</p>
    <p><input type="checkbox" name="vertical" value="bottom">внизу</p>

    <p><input type="submit" value="Выполнить"></p>
</form>
</body>
</html>