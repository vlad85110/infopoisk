<html>
<head>
    <title> Листинг 7-6. Вложенные циклы for </title>
</head>
<body>

<?php

$outer_color = "blue";

print "<table border=1>\n";
for ($y = 0; $y <= 10; $y++) {
    print "<tr>\n";

    for ($x = 0; $x <= 10; $x++) {
        $color = "";

        if ($x == 0 && $y == 0) {
            $text = "+";
            $color = "red";
        } else {
            if ($x == 0 || $y == 0) {
                $color = $outer_color;
            }
            $text = $x + $y;
        }

        print "\t<td style='color: $color; padding: 5px; text-align: center'>";
        print $text;
        print "</td>\n";
    }
    print "</tr>\n";
}
print "</table>";

?>
</body>
</html>

