<?php


function getFieldTypeString($type)
{
    switch ($type) {
        case MYSQLI_TYPE_NEWDECIMAL:
            return 'float';
        case MYSQLI_TYPE_LONG:
            return 'int';
        case MYSQLI_TYPE_DATE:
            return 'date';
        case MYSQLI_TYPE_VAR_STRING:
            return 'string';
        default:
            return 'Unknown';
    }
}

function getFieldFlagsString($flags)
{
    $flagStrings = array();

    if ($flags & MYSQLI_NOT_NULL_FLAG) {
        $flagStrings[] = 'not null';
    }

    if ($flags & MYSQLI_PRI_KEY_FLAG) {
        $flagStrings[] = 'primary key';
    }

    return implode(', ', $flagStrings);
}

function showTableContent($conn, $tableName)
{
    try {
        $result = mysqli_query($conn, "select * from $tableName");
    } catch (Exception $err) {
        print "no such table<br><br>";
        return;
    }

    $rusNames = array(
        "cnum" => "Номер покупателя",
        "cname" => "Имя покупателя",
        "city" => "Город",
        "rating" => "Рейтинг",
        "snum" => "Номер продавца",
        "sname" => "Имя продавца",
        "comm" => "Комиссионные",
        "onum" => "Номер заказа",
        "amt" => "Сумма заказа",
        "odate" => "Дата заказа"
    );

    print "<h4>Содержимое таблицы $tableName</h4>";
    print "<p><table style='border: 1px'>\n";
    print "<tr>\n";

    $num_fields = mysqli_num_fields($result);
    for ($x = 0; $x < $num_fields; $x++) {
        $name = mysqli_fetch_field_direct($result, $x)->name;
        print "\t<th>$rusNames[$name] <br> $name</th>\n";
    }
    print "</tr>\n";

    while ($a_row = mysqli_fetch_row($result)) {
        print "<tr>\n";
        foreach ($a_row as $field)
            print "\t<td>$field</td>\n";
        print "</tr>\n";
    }
    print "</table>\n";
}

function showTableStructure($conn, $tableName)
{
    try {
        $query_res = mysqli_query($conn, "SELECT * from $tableName");
    } catch (Exception $err) {
        print "no such table<br><br>";
        return;
    }

    print "<h4>Структура таблицы $tableName</h4>";

    $num_fields = mysqli_num_fields($query_res);
    print "<dl><dd>\n";
    for ($x = 0; $x < $num_fields; $x++) {  #2
        $properties = mysqli_fetch_field_direct($query_res, $x);

        print "<i>";
        print getFieldTypeString($properties->type);

        print "</i> <i>";
        print $properties->length;

        print "</i> <b>";
        print $properties->name;

        print "</b> <i>";
        print getFieldFlagsString($properties->flags);

        print "</i><br>\n";
    }
    print "</dl>\n";
}