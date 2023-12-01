<?php

/* Заменить цикл foreach в листинге ls10-4.php
   Листинг 10-5. Чтение данных произвольной формы
           с помощью ассоциативных массивов
*/

?>


<html> <head>
    <title> Листинг 10-4. Обработка данных формы
        из листинга 10-3 </title> </head> <body>

<?php


$user = $_POST["user"];
$hobby = $_POST["hobby"];

print "<p>$user, оказывается, вы предпочитаете";

print "<ul>\n";

foreach ($_POST as $key=>$value) {
    print "$key = $value<br>\n";
}


print "</ul>\n";

?>
</body> </html>
