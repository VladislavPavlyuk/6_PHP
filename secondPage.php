<?php

session_start();

//if (isset($_SESSION['student']))     echo "Студент : ".$_SESSION['student'].".<br>";

if (isset($_SESSION['totalRate']))
    $totalRate = $_SESSION['totalRate'];
else $totalRate = 0;

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
        echo $nameFirst." : ".gettype($_POST[$nameFirst])." : ".$_POST[$nameFirst]."<br>";
        if ($_POST[$nameFirst] == $correctAnswer) $rate++;
        else $incorrect++;
    }
}
$_SESSION['totalRate'] = $rate;
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
        <form action="thirdPage.php" method="post">

            <div><h2 align="center">Tест 2</h2></div>

            <?php
            if (isset($_SESSION['student']))
                echo "Студент : ".$_SESSION['student'].".<br>";

            echo "Total Score : ".$_SESSION['totalRate'].".<br>";

            $fileString = file_get_contents("test2.txt");

            if (!$fileString) echo "Error in readfile";
            else {
                $arr = explode('|', trim($fileString, "[]"));

                foreach ($arr as $i =>  $a)
                    if (!$a == "") {
                        $arr2[$i] = explode(';', trim($a, "[]"));

                        foreach ($arr2[$i] as $j => $b)
                            if (!$b=="") {
                                $arr3[$i][$j] = explode(',', trim($b, "[]"));
                            }
                    }
            }
            $q = count($arr2);
            //echo "<br>Questions: ".$q."<br>";

            for ($i = $j = $u = 0; $i < count($arr2); $i++) {

                echo '<br>';
                echo '<label>'.'<b>'.$arr3[$i][$j][$u].'</b>' .".  ".'</label>';   //N
                echo '<label>'.$arr3[$i][$j+1][$u] .'</label>'; //question

                //echo '<label>'.$arr3[$i][$j+2][$u] .'</label>'; //radio1
                //echo ' , ';
                //echo '<label>'.$arr3[$i][$j+3][$u] .'</label>'; //radio2
                //echo ' , ';
                //echo '<label>'.$arr3[$i][$j+4][$u] .'</label>'; //radio3
                //echo ' , ';
                if (isset($_SESSION['student'])&&($_SESSION['student']) == 'Admin') {
                echo '<br><label>' . 'Правильный ответ' . $arr3[$i][$j + 5][$u] . '</label>'; //correct answer
                echo ' , ';
                if (count($arr3[$i][$j + 5]) > 1)
                    echo '<label>' . $arr3[$i][$j + 5][$u + 1] . '</label>'; //correct answer
                echo ' , ';
                if (count($arr3[$i][$j + 5]) > 2)
                    echo '<label>' . $arr3[$i][$j + 5][$u + 2] . '</label>'; //correct answer
            }
                echo '<br>';

                $name = "question" . strval($i + 1)."[]";

                $questionArray[] = Array ($name => $arr3[$i][$j+5][$u]);

                if (isset($arr3[$i][$j+5][$u+1]))
                    $questionArray[] = Array ($name => $arr3[$i][$j+5][$u+1]);
                if (isset($arr3[$i][$j+5][$u+2]))
                    $questionArray[] = Array ($name => $arr3[$i][$j+5][$u+2]);
                //var_dump($questionArray);
                ?>
                <input type="checkbox" name='<?php echo $name ?>'
                       value="1"><?php echo '  '.$arr3[$i][$j+2][$u] ?><br>

                <input type="checkbox" name='<?php echo $name ?>'
                       value="2"><?php echo '  '.$arr3[$i][$j+3][$u] ?><br>

                <input type="checkbox" name='<?php echo $name ?>'
                       value="3"><?php echo '  '.$arr3[$i][$j+4][$u] ?><br>
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
