<html>
<head>
    <title> Листинг 10-4. Обработка данных формы
        из листинга 10-3 </title></head>
<body>

<?php

$user = $_POST["user"];
$hobby = $_POST["hobby"];

print "<p>$user, оказывается, вы предпочитаете";
print "<ul>\n";

$PARAMS = (isset($_POST)) ? $_POST : $_GET;

foreach ($PARAMS as $key => $value) {
    if (gettype($value) == "array") {
        print "$key = <br>\n";
        foreach ($value as $v)
            print "$v<br>";
    } else {
        print "$key = $value<br>\n";
    }
}
print "</ul>\n";

?>
</body>
</html>
