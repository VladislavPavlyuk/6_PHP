<?php
session_start();

if (isset($_SESSION['student']))
    echo "Студент : ".$_SESSION['student'].".<br>";

if (isset($_SESSION['rate']))
    $rate = $_SESSION['rate'];
else $rate = 0;

$incorrect = 0;

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
                if (!$b=="") {
                    $arrSecond3[$i][$j] = explode(',', trim($b, "[]"));
                }
        }
}

for ($i = $j = $u = 0; $i < count($arrSecond2); $i++) {

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
echo "<br>Questions: ".$q."<br>";

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

$_SESSION['rate'] = $rate;

echo "Not set : ".$notset."<br>";
echo "Correct answers : ".$rate."<br>";
echo "Incorrect answers : ".$incorrect."<br>";
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

            if (isset($_SESSION['rate']))
                $rate = $_SESSION['rate'];
            else $rate = 0;
            echo "Correct : ".$rate.".<br>";

            $incorrect = $notset = 0;

            $fileString = file_get_contents("test3.txt");
            if (!$fileString) echo "Error in readfile";
            else {
                $arr = explode('|', trim($fileString, "[]"));

                foreach ($arr as $i =>  $a)
                    if (!$a == "") {
                        $arr2[$i] = explode(';', trim($a, "[]"));

                    }
            }

            for ($i = $j = $u = 0; $i < count($arr2); $i++) {
                echo '<br>';
                echo '<label>'.'<b>'.$arr2[$i][$j].'</b>' .".  ".'</label>';   //N
                echo '<label>'.$arr2[$i][$j+1] .'</label>'; //question
                echo '<br>';
                echo '<label>'.$arr2[$i][$j+2] .'</label>'; //correct answer
                echo '<br>';

            $name = "question" . strval($i + 1);
            $questionNames[$name] = $arr2[$i][$j+2];
                ?>
                <div>
                    <label><?php $arr2[$i][$j] ?></label>
                    <label><?php $arr2[$i][$j+1] ?></label>
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

