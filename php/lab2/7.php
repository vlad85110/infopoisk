<html>
<head>
    <title>
    </title></head>

<body>

<?php

function print_map($map)
{
    print "<div>";
    foreach ($map as $key => $value) {
        echo "<p> $key - $value";
    }
    print "</div>";
}

$cust = array(
    'cnum' => 2001,
    'cname' => "Hoffman",
    'city' => "London",
    'snum' => 1001,
    'rating' => 100
);
print_map($cust);

print "<br>";

asort($cust);
print_map($cust);

print "<br>";

ksort($cust);
print_map($cust);

print "<br>";

sort($cust);
foreach ($cust as $var) {
    print "$var<br>";
}


?>
</body>
</html>