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
            <div><h2 align="center">3. Ответьте на вопросы:</h2></div>

            <?php
            if (isset($_SESSION['student']))
                echo "Студент : ".$_SESSION['student'].".<br>";

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


                ?>
                <div>
                    <label><?php $arr2[$i][$j] ?></label>
                    <label><?php $arr2[$i][$j+1] ?></label>
                    <input type="text" name="question">
                </div><br>
                <?php
            }
            ?>

            <button align="center" type="button" class="btn btn-primary" onclick="history.back()">Back</button>
            <button type="button" class="btn btn-primary" onclick="location.href = 'thirdPage.php';">Next</button>
            <input type="submit" value="Сохранить" id="third">

        </form>
    </div>
</div>
</body>
</html>

