<html>
<head>
    <title> Листинг 10-3. HTML-форма с выбором из списка
    </title></head>
<body>

<?php
function selectWithLabel($labelName, $options, $questionNumber)
{
    print "<a>$labelName  </a>";
    print "<select name='select$questionNumber' required>";
    print "<option value=''>находится в городе</option>";

    foreach ($options as $index => $option) {
        $num = $index + 1;

        print "<option value='$num'> $option";
    }
    print "</select><br><br>";
}

?>

<form action="3b.php" method="post">
    <p>Введите ваше имя
    <p><input type="text" name="user" required>

        <?php
        $monuments = array("Mузeй Прадо", "Рейхстаг", "Oпepный театр Ла Скала",
            "Meдный Всадник", "Cтeнa Плача", "Tpeтьяковскaя галерея",
            "Tpиумфaльнaя Арка", "Cтaтуя Свободы", "Taуэp");

        $cities = array("Caнкт-Пeтepбypг", "Moсква", "Иepуcaлим", "Mилaн",
            "Пapиж", "Maдpид", "Лондон", "Hью-Йopк", "Бepлин");

        print "<p> Определите, в каком городе находится данный памятник<br><br>";

        foreach ($monuments as $index => $monument) {
            selectWithLabel($monument, $cities, $index + 1);
        }
        ?>

    <p>
        <input type="submit" value="Выполнить">
        <input type="reset" value="Очистить">
    </p>


</form>
</body>
</html>