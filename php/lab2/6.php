<html> <head>
    <title>
    </title> </head>

<body>

<?php

function print_array($arr) {
    print "<p>";
    foreach ($arr as $item) {
        print "$item  ";
    }
    print "</p>";
}

$treug = array();
for ($i = 1; $i <= 10; $i++) {
    $treug[] = $i * ($i + 1) / 2;
}
print_array($treug);

$kvd = array();
for ($i = 1; $i <= 10; $i++) {
    $kvd[] = pow($i, 2);
}
print_array($kvd);

$rez = array_merge($treug, $kvd);
print_array($rez);

sort($rez);
print_array($rez);

array_shift($rez);
print_array($rez);

$rez1 = array_unique($rez);
print_array($rez1);

?>

</body> </html>