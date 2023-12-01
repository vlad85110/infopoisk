<html>
<body>

<?php

$outerColor = "red";
print "<table border=1>\n";

$x = 1;
while ($x <= 10) {
    $y = 1;
    print "<tr>\n";

    while ($y <= 10) {
        $color = "";

        if ($x == $y) {
            $color = $outerColor;
        }

        print "\t<td style='background-color: $color; padding: 5px; text-align: center'>";
        print ($x * $y);
        print "</td>\n";

        $y++;
    }

    print "</tr>\n";
    $x++;
}

print "</table>";

?>
</body>
</html>