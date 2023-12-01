<html>

<head>
    <title> Листинг 10-2. Чтение данных формы из листинга 10-1 </title>
</head>

<body>
<?php

$horizontal = $_GET['horizontal'];
$vertical = $_GET['vertical'];


print "<table border=1 style='width: 100px; height: 100px;'>\n";
print "<tr>\n";
print "\t<td style='text-align: $horizontal; vertical-align: $vertical;'>";
print "<span>Текст";

print "</td>\n";
print "</tr>\n";
print "</table>";

print "<p style='text-align: center'><a href='1a.php'>назад</a>";

?>

</body>
</html>