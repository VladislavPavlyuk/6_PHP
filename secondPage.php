<?php
session_start();
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
        <form action="thirdPage.php" method="get">
            <h3>Правильных ответов: <?php echo $_COOKIE["rate"] ?></h3>
            <div><h2 align="center">Tест 2</h2></div>

            <?php
            if (isset($_SESSION['student']))
                echo "Студент : ".$_SESSION['student'].".<br>";

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

            for ($i = $j = $u = 0; $i < count($arr2); $i++) {
                echo '<br>';
                echo '<label>'.'<b>'.$arr3[$i][$j][$u].'</b>' .".  ".'</label>';   //N
                echo '<label>'.$arr3[$i][$j+1][$u] .'</label>'; //question
                echo '<br>';
                echo '<label>'.$arr3[$i][$j+2][$u] .'</label>'; //radio1
                echo '<br>';
                echo '<label>'.$arr3[$i][$j+3][$u] .'</label>'; //radio2
                echo '<br>';
                echo '<label>'.$arr3[$i][$j+4][$u] .'</label>'; //radio3
                echo '<br>';
                echo '<label>'.$arr3[$i][$j+5][$u] .'</label>'; //correct answer
                echo '<br>';
                if (count($arr3[$i][$j+5])>1)
                echo '<label>'.$arr3[$i][$j+5][$u+1] .'</label>'; //correct answer
                echo '<br>';
                if (count($arr3[$i][$j+5])>2)
                echo '<label>'.$arr3[$i][$j+5][$u+2] .'</label>'; //correct answer

                echo '<br>';

                ?>
                <input type="checkbox" name="question"
                <?php if (isset($question) && $question=="1") echo "checked";?>
                       value="1"><?php echo '  '.$arr3[$i][$j+2][$u] ?><br>
                <input type="checkbox" name="question"
                <?php if (isset($question) && $question=="2") echo "checked";?>
                       value="2"><?php echo '  '.$arr3[$i][$j+3][$u] ?><br>
                <input type="checkbox" name="question"
                <?php if (isset($question) && $question=="3") echo "checked";?>
                       value="3"><?php echo '  '.$arr3[$i][$j+4][$u] ?><br>
                <?php
            }
            ?>

            <button align="center" type="button" class="btn btn-primary" onclick="history.back()">Back</button>
            <button type="button" class="btn btn-primary" onclick="location.href = 'thirdPage.php';">Next</button>
            <input type="submit" value="Сохранить" id="third">

            <?php
            print_r($_SESSION);
            ?>
        </form>
    </div>
</div>
</body>
</html>
