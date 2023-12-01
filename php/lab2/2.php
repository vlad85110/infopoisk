<?php
$lang = $_GET['lang'];

$text = "Неизвестен";
if ($lang == "ru") {
    $text = "Русский";
} elseif ($lang == "en") {
    $text = "Английский";
} elseif ($lang == "fr") {
    $text = "Французский";
} elseif ($lang == "de") {
    $text = "Немецкий";
}

print "<p> Язык - $text";
