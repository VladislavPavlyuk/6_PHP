<?php
session_start();

if (isset($_SESSION['$mixedArrayThird']))
    $mixedArrayThird = $_SESSION['$mixedArrayThird'];

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
    $m = $mixedArrayThird[$key];
    $temp[$key] = $arrThird2[$m];
}
$arrThird2 = $temp;

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

if (isset($_SESSION['firstRate'])) $firstRate = $_SESSION['firstRate'];
else $firstRate = 0;
if (isset($_SESSION['secondRate'])) $secondRate = $_SESSION['secondRate'];
else $secondRate = 0;

$totalRate = $firstRate + $secondRate*3 + $rate*5;

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
        strong {color: red; }
    </style>
</head>
<body>
<div class="container">
    <div class="column">
        <form  method="post">
            <div id="result">
                <input type="submit" class="btn btn-primary" name="Result" value="Узнать результат" id="first">
            </div>
        </form>

        <?php
        if(isset($_POST['Result'])) {
            echo ' <style>#result {display: none;}</style>';
            echo '        
            <form action="index.php" method="post">
                <div id="restart">
                    <h3 align="center">Поздравляем!</h3>
                    <label>Ваш результат : </label>
                    <strong>'.$totalRate.'</strong>
                    <br><br>
                    <input type="submit" class="btn btn-primary" name="Restart" value="Пройти заново" id="first">
                </div>
            </form>';
        }

        if(isset($_POST['Restart'])) {
            header('location: index.php');
            exit();
        }
        ?>

    </div>
</body>
</html>
