<html> <head>
    <title> Листинг 10-1. Простая HTML-форма </title>
</head> <body>


<form action="1b.php" method="GET">
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

</body> </html>