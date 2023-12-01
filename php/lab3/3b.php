<html>
<head>
    <title> Листинг 10-4. Обработка данных формы
        из листинга 10-3 </title></head>
<body>

<?php

$user = $_POST["user"];
$rightAnswers = array("6", "9", "4", "1", "3", "2", "5", "8", "7");
$answersCnt = 0;

for ($i = 1; $i <= 9; $i++) {
    $answer = $_POST["select$i"];

    if ($answer == $rightAnswers[$i - 1]) {
        $answersCnt++;
    }
}

$result = "вообще не знаете географию";
switch ($answersCnt) {
    case 9:
        $result = "великолепно знаете географию";
        break;
    case 8:
        $result = "отлично знаете географию";
        break;
    case 7:
        $result = "очень хорошо знаете географию";
        break;
    case 6:
        $result = "хорошо знаете географию";
        break;
    case 5:
        $result = "удовлетворительно знаете географию";
        break;
    case 4:
        $result = "терпимо знаете географию";
        break;
    case 3:
        $result = "плохо знаете географию";
        break;
    case 2:
        $result = "очень плохо знаете географию";
        break;
}

print "<p>$user, вы $result";
?>
</body>
</html>
