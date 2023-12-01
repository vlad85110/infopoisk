<?php
include("dbConnect.php");

$conn = dbConnect();

if (isset($_POST['id']) && isset($_POST['field_name']) && isset($_POST['field_value'])) {
    $id = $_POST['id'];
    $field_name = $_POST['field_name'];
    $field_value = $_POST['field_value'];

    $update_sql = "UPDATE notebook SET $field_name = '$field_value' WHERE id = '$id'";
    mysqli_query($conn, $update_sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование записей</title>
</head>
<body>

<?php

echo "<form action='edit.php' method='post'>";

if (isset($_POST['id']) && !isset($_POST['field_name']) && !isset($_POST['field_value'])) {
    $id = $_POST['id'];

    print "<select name='field_name'>";
    print "<option value='name'>Имя</option>";
    print "<option value='city'>Город</option>";
    print "<option value='address'>Адрес</option>";
    print "<option value='birthday'>Дата рождения</option>";
    print "<option value='mail'>Email</option>";
    print "</select>";

    print "<label for='field_value'>Новое значение: </label>";
    print "<input type='text' name='field_value'><br>";

    print "<input type='hidden' name='id' value='$id'>";
    print "<input type='submit' value='Заменить'>";
} else {
    print "<table border='1'>";
    print "<tr>";
    print "<th>Имя</th>";
    print "<th>Город</th>";
    print "<th>Адрес</th>";
    print "<th>Дата рождения</th>";
    print "<th>Email</th>";
    print "<th>Выбрать</th>";
    print "</tr>";

    $query = "SELECT * FROM notebook";
    $result = mysqli_query($conn, $query);

    while ($a_row = mysqli_fetch_assoc($result)) {
        $id = $a_row['id'];
        print "<tr>";

        foreach ($a_row as $field_name => $field_value) {
            if ($field_name !== 'id') {
                print "<td>$field_value</td>";
            }
        }

        print "<td><input type='radio' name='id' value='$id'></td>";
        print "</tr>";
    }
    print "</table>";

    print "<br>";

    print "<input type='submit' value='Изменить'>";

}
echo "</form>";

mysqli_close($conn);
?>

</body>
</html>
