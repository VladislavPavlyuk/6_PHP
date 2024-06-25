<?php
session_start();

if (isset($_SESSION['$mixedArray']))
    $mixedArray = $_SESSION['$mixedArray'];

if (isset($_SESSION['totalRate']))
    $totalRate = $_SESSION['totalRate'];
else $totalRate = 0;

function randomMixArray($array)
{
    $mixedArr[0] = $r = 0;
    for ($i = 0; $i < count($array) - 1; $i++) {
        do {
            $r = rand(0, count($array)-2);
        } while (array_search($r, $mixedArr) > -1);
        $mixedArr[$i] = $r;
    }
    return $mixedArr;
}

$incorrect = $notset = $rate = 0;

$fileString3 = file_get_contents("test3.txt");
if (!$fileString3) echo "Error in readfile";
else {
    $arrThird = explode('|', trim($fileString3, "[]"));

    foreach ($arrThird as $i =>  $a)
        if (!$a == "") {
            $arrThird2[$i] = explode(';', trim($a, "[]"));
        }
}

foreach ( $arrThird2 as $key => $item) {
    $m = $mixedArray[$key];
    $mixedArr[$key] = $arrThird2[$m];
}
$arrThird2 = $mixedArr;

for ($i = $j = $u = 0; $i < count($arrThird2); $i++) {
    $nameThird = "question" . strval($i + 1);
    $questionNamesThird[$nameThird] = $arrThird2[$i][$j + 2];
}
foreach ($questionNamesThird as $nameThird => $correctAnswer) {
    if (!isset($_POST[$nameThird])) {
        $notset++;
    }
    else if (isset($_POST[$nameThird])) {
        $clearString = trim(str_replace(" ", "", $_POST[$nameThird]));
        if ($clearString == $correctAnswer) $rate++;
        else if ($clearString == "") $notset++;
        else $incorrect++;
    }
}

$rate*=5;

if (isset($_SESSION['totalRate']))
    $totalRate = $_SESSION['totalRate'];
else $totalRate = 0;
$totalRate += $rate;
$_SESSION['totalRate'] = $totalRate;

echo "<br>";
//echo "Not set : ".$notset."<br>";
//echo "Correct answers : ".$rate."<br>";
//echo "Incorrect answers : ".$incorrect."<br>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Result</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        strong {
            color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="column">
        <form action="index.php" method="post">
            <div>
                <h3 align="center">Поздравляем!</h3>
            </div>
            <div>
                <label>Ваш результат : </label>
                <strong><?php echo $totalRate;?></strong>
                <br><br>
                <input type="submit" class="btn btn-primary" name="Restart" value="Пройти заново" id="first">
            </div>
        </form>


    </div>
</body>
</html>
