<?php

if (isset ($_POST["site"])) {
    $site = $_POST["site"];
    header("Location: https://$site");
    exit;
} else {
?>

<html>
<head>
    <title> Листинг 10-9. Посылка заголовка с помощью
        функции header() </title></head>
<body>

<?php
$sites = array("www.yandex.ru", "www.rambler.ru", "www.yahoo.com", "www.altavista.com", "www.google.com");

print "<form action='{$_SERVER['PHP_SELF']}' method='post'>";

?>

<select name="site">
    <option value="">Поисковые системы
        <?php

        foreach ($sites as $site) {
            print "<option value='$site'> $site";
        }

        ?>
</select>
<input type="submit" value="Перейти">

</form>

<?php
} // конец блока else
?>
</body>
</html>