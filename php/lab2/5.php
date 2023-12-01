<html>
<head>
    <title> Листинг 8-3. Функция-переменная </title>
</head>
<body>

<?php

$lang = $_GET['lang'];
$color = $_GET['color'];

function Ru($col)
{
    print "<p style='color: $col'>Здравствуйте!";
}

function En($col)
{
    print "<p style='color: $col'>Hello!";
}

function Fr($col)
{
    print "<p style='color: $col'>Bonjour!";
}

function De($col)
{
    print "<p style='color: $col'>Guten Tag!";
}

if ($lang) {
    $lang($color);
}

?>
</body>
</html>