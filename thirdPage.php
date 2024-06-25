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

function countSimilarElementsInArray($array,$element){
    $result = 0;
    foreach ($array as $e ) {
        foreach ($e as $key => $value) {
            if ($key == $element) $result++;
        }
    }
    return $result;
}

$fileStringSecond = file_get_contents("test2.txt");
if (!$fileStringSecond) echo "Error in readfile";
else {
    $arrSecond = explode('|', trim($fileStringSecond, "[]"));

    foreach ($arrSecond as $i =>  $a)
        if (!$a == "") {
            $arrSecond2[$i] = explode(';', trim($a, "[]"));

            foreach ($arrSecond2[$i] as $j => $b)
                if (!$b == "") {
                    $arrSecond3[$i][$j] = explode(',', trim($b, "[]"));
                }
        }
}


foreach ( $arrSecond3 as $key => $item) {
    $m = $mixedArray[$key];
    $mixedArr[$key] = $arrSecond3[$m];
}
$arrSecond3 = $mixedArr;
//var_dump($arrSecond3);

echo '<br>';
foreach ($mixedArray as $i =>  $a) {
    echo ' '.$a.' ';
}
echo '<br>';

for ($i = $j = $u = 0; $i < count($arrSecond3); $i++) {

    $nameSecond = "question" . strval($i + 1) . "[]";

    $questionArraySecond[] = array($nameSecond => $arrSecond3[$i][$j + 5][$u]);

    if (isset($arrSecond3[$i][$j + 5][$u + 1]))
        $questionArraySecond[] = array($nameSecond => $arrSecond3[$i][$j + 5][$u + 1]);
    if (isset($arrSecond3[$i][$j + 5][$u + 2]))
        $questionArraySecond[] = array($nameSecond => $arrSecond3[$i][$j + 5][$u + 2]);
}

foreach ($questionArraySecond as $nameSecond) {
    foreach ($nameSecond as $question => $correctAnswer) {
        //echo $question." ".$correctAnswer ." countSimilarElementsInArray : ".
        //    countSimilarElementsInArray($questionArray,$question)."<br>";
    }
}

$q = count($arrSecond2);
//echo "<br>Questions: ".$q."<br>";

$a = $aa = $c = $notset = $temp = 0;
$questionOld = "";

foreach ($questionArraySecond as $nameSecond) {
    foreach ($nameSecond as $question => $correctAnswer) {
        $questi = substr($question, 0, -2);

        if ($questionOld != $questi) {
            $aa = 0;
            $questionOld = $questi;
        }

        if (!isset($_POST[$questi])) {
            $temp++;
            //echo $questi . " is not set!" . "<br>";
            $c = countSimilarElementsInArray($questionArraySecond,$question);
            if ($temp == $c) {
                $notset++;
                $temp = 0;
            }
        }
        else if (countSimilarElementsInArray($questionArraySecond,$question) == count($_POST[$questi])){

            foreach ($_POST[$questi] as $key=>$answer) {
                //echo $questi . " is  set!" . "<br>";
                //echo $answer . " " . $correctAnswer . "<br>";
                if ($answer == $correctAnswer) $aa++;
            }

            $c = countSimilarElementsInArray($questionArraySecond,$question);
            //echo "correct : " . $aa . ' count($_POST[$question]) = ' . $c . "<br><br>";
            if ($c > 0) {
                if ($c == $aa) {
                    $rate++;
                    $aa = 0;
                }
            }
        }
    }
    $a = $c = 0;
}

$incorrect = $q - $notset - $rate;

$rate*=3;

if (isset($_SESSION['totalRate']))
    $totalRate = $_SESSION['totalRate'];
else $totalRate = 0;
$totalRate += $rate;
$_SESSION['totalRate']=$totalRate;

//echo "Not set : ".$notset."<br>";
//echo "Correct answers : ".$rate."<br>";
//echo "Incorrect answers : ".$incorrect."<br>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test 3</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <form name="form" action="fourthPage.php" method="post">
            <div><h2 align="center">3. Ответьте на вопросы:</h2></div>

            <?php
            if (isset($_SESSION['student']))
                echo "Студент : ".$_SESSION['student'].".<br>";

            if (isset($_SESSION['totalRate']))
                $totalRate = $_SESSION['totalRate'];
            else $totalRate = 0;
            echo "Total Score : ".$totalRate.".<br>";

            $incorrect = $notset = $rate = 0;

            $fileStringThird = file_get_contents("test3.txt");
            if (!$fileStringThird) echo "Error in readfile";
            else {
                $arrThird = explode('|', trim($fileStringThird, "[]"));

                foreach ($arrThird as $i =>  $a)
                    if (!$a == "") {
                        $arrThird2[$i] = explode(';', trim($a, "[]"));
                    }
            }

            $mixedArray = randomMixArray($arrThird);
            $_SESSION['$mixedArray'] = $mixedArray;

            foreach ( $arrThird2 as $key => $item) {
                $m = $mixedArray[$key];
                $mixedArr[$key] = $arrThird2[$m];
            }
            $arrThird2 = $mixedArr;

            for ($i = $j = $u = 0; $i < count($arrThird2); $i++) {
                echo '<br>';
                echo '<label>'.'<b>'.$arrThird2[$i][$j].'</b>' .".  ".'</label>';   //N
                echo '<label>'.$arrThird2[$i][$j+1] .'</label>'; //question
                echo '<br>';
            if (isset($_SESSION['student'])&&($_SESSION['student']) == 'Admin') {
                echo '<label>' . $arrThird2[$i][$j + 2] . '</label>'; //correct answer
                echo '<br>';
            }
            $name = "question" . strval($i + 1);
            $questionNames[$name] = $arrThird2[$i][$j+2];
                ?>
                <div>
                    <label><?php $arrThird2[$i][$j] ?></label>
                    <label><?php $arrThird2[$i][$j+1] ?></label>
                    <input type="text" name='<?php echo $name ?>'>
                </div><br>
                <?php
            }
            ?>

            <br><input type="submit" class="btn btn-primary" value="Далее" id="third">

        </form>
    </div>
</div>
</body>
</html>

