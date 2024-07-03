<?php

session_start();

if (isset($_SESSION['$mixedArrayFirst']))
    $mixedArrayFirst = $_SESSION['$mixedArrayFirst'];

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

$fileStringFirst = file_get_contents("test1.txt");

if (!$fileStringFirst) echo "Error in readfile";
else {
    $arrFirst = explode('|', trim($fileStringFirst, "[]"));

    foreach ($arrFirst as $i =>  $a)
        if (!$a=="") {
            $arrFirst2[$i] = explode(';', trim($a, "[]"));
        }
}

foreach ( $arrFirst2 as $key => $item) {
    $m = $mixedArrayFirst[$key];
    $temp[$key] = $arrFirst2[$m];
}
$arrFirst2 = $temp;

for ($i = $j =0; $i < count($arrFirst2); $i++) {
    $nameFirst = "question" . strval($i + 1);

    $questionNamesFirst[$nameFirst] = $arrFirst2[$i][$j + 5];
}

foreach ($questionNamesFirst as $nameFirst => $correctAnswer) {
    if (!isset($_POST[$nameFirst])) {
        //echo $nameFirst." is not set!".gettype($correctAnswer)." : ".$correctAnswer."<br>";
        //echo "Array length = ".count($questionNames)."<br>";
    }
    else if (isset($_POST[$nameFirst])) {
       // echo $nameFirst." : ".gettype($_POST[$nameFirst])." : ".$_POST[$nameFirst]."<br>";
        if ($_POST[$nameFirst] == $correctAnswer) $rate++;
        else $incorrect++;
    }
}
$_SESSION['firstRate'] = $rate;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <form action="thirdPage.php" method="post" >

            <div><h2 align="center">Tест 2</h2></div>

            <?php
            if (isset($_SESSION['student']))
                echo "Студент : ".$_SESSION['student'].".<br>";

            if (isset($_SESSION['student'])&&($_SESSION['student'] == 'Admin')) {
            echo "Score : ".$rate.".<br>";}

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

            $mixedArraySecond = randomMixArray($arrSecond);

            $_SESSION['$mixedArraySecond'] = $mixedArraySecond;

            foreach ( $arrSecond3 as $key => $item) {
                $m = $mixedArraySecond[$key];
                $tempArrSecond[$key] = $arrSecond3[$m];
            }

            $arrSecond3 = $tempArrSecond;

            $q = count($arrSecond2);

            for ($i = $j = $u = 0; $i < count($arrSecond2); $i++) {
                if (isset($_SESSION['student'])&&($_SESSION['student'] == 'Admin')) {
                    echo '<br><label><b>';
                    echo $arrSecond3[$i][$j][$u];                                           //N
                    echo '</b></label>';
                }   else
                    echo '<br><label><b>'.($i+1).'</b>';

                echo '<label>'.'.'.$arrSecond3[$i][$j+1][$u] .'</label>'; //question

                if (isset($_SESSION['student'])&&($_SESSION['student']) == 'Admin') {
                echo '<br><label><b>' . 'Правильный ответ : ' . $arrSecond3[$i][$j + 5][$u] . '</b></label>'; //correct answer
                echo ' , ';
                if (count($arrSecond3[$i][$j + 5]) > 1)
                    echo '<label><b>' . $arrSecond3[$i][$j + 5][$u + 1] . '</b></label>'; //correct answer
                echo ' , ';
                if (count($arrSecond3[$i][$j + 5]) > 2)
                    echo '<label><b>' . $arrSecond3[$i][$j + 5][$u + 2] . '</b></label>'; //correct answer
            }
                echo '<br>';

                $nameSecond = "question" . strval($i + 1)."[]";

                $questionArraySecond[] = Array ($nameSecond => $arrSecond3[$i][$j+5][$u]);

                if (isset($arrSecond3[$i][$j+5][$u+1]))
                    $questionArraySecond[] = Array ($nameSecond => $arrSecond3[$i][$j+5][$u+1]);
                if (isset($arr3[$i][$j+5][$u+2]))
                    $questionArraySecond[] = Array ($nameSecond => $arrSecond3[$i][$j+5][$u+2]);

                ?>

                <input type="checkbox" name='<?php echo $nameSecond ?>'
                       value="1"><?php echo '  '.$arrSecond3[$i][$j+2][$u] ?><br>

                <input type="checkbox" name='<?php echo $nameSecond ?>'
                       value="2"><?php echo '  '.$arrSecond3[$i][$j+3][$u] ?><br>

                <input type="checkbox" name='<?php echo $nameSecond ?>'
                       value="3"><?php echo '  '.$arrSecond3[$i][$j+4][$u] ?><br>
                <?php
            }

            ?>
            <br><input type="submit" class="btn btn-primary" value="Далее" >
        </form>

    </div>
</div>
</div>
</body>
</html>
