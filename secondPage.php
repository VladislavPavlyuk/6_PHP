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
        <form action="" method="post">

            <div><h2 align="center">Tест 2</h2></div>

            <?php
            if (isset($_SESSION['student']))
                echo "Студент : ".$_SESSION['student'].".<br>";

            $rate = $incorrect = 0;

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
            echo "<br>Questions: ".$q."<br>";

            for ($i = $j = $u = 0; $i < count($arr2); $i++) {
                echo '<br>';
                echo '<label>'.'<b>'.$arr3[$i][$j][$u].'</b>' .".  ".'</label>';   //N
                echo '<label>'.$arr3[$i][$j+1][$u] .'</label>'; //question
                echo '<br>';
                echo '<label>'.$arr3[$i][$j+2][$u] .'</label>'; //radio1
                echo ' , ';
                echo '<label>'.$arr3[$i][$j+3][$u] .'</label>'; //radio2
                echo ' , ';
                echo '<label>'.$arr3[$i][$j+4][$u] .'</label>'; //radio3
                echo ' , ';
                echo '<label>'.$arr3[$i][$j+5][$u] .'</label>'; //correct answer
                echo ' , ';
                if (count($arr3[$i][$j+5])>1)
                echo '<label>'.$arr3[$i][$j+5][$u+1] .'</label>'; //correct answer
                echo ' , ';
                if (count($arr3[$i][$j+5])>2)
                echo '<label>'.$arr3[$i][$j+5][$u+2] .'</label>'; //correct answer

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
            <br><input type="submit" class="btn btn-primary" value="Далее" id="second">
        </form>
        <?php
        //var_dump($questionArray);

        if (isset($_POST['submit'])) {
            //var_dump($questionArray);
            foreach ($questionArray as $checkBoxName) {
                foreach ($checkBoxName as $question => $correctAnswer) {
                 //   echo $question." ".$correctAnswer . "<br>";
                }
            }
        }
        ?>

        <strong>
            <?php
               // var_dump($questionArray);
        function countSimilarElementsInArray($array,$element){
            $result = 0;
            foreach ($array as $e ) {
                foreach ($e as $key => $value) {
                    if ($key == $element) $result++;
                }
            }
            return $result;
        }

       foreach ($questionArray as $name) {
           foreach ($name as $question => $correctAnswer) {
                   //echo $question." ".$correctAnswer ." countSimilarElementsInArray : ".
                   //    countSimilarElementsInArray($questionArray,$question)."<br>";
               }
           }

            $a = $aa = $c = $notset = $temp = 0;
            $questionOld = "";

            foreach ($questionArray as $name) {
                foreach ($name as $question => $correctAnswer) {
                    $questi = substr($question, 0, -2);

                    if ($questionOld != $questi) {
                        $aa = 0;
                        $questionOld = $questi;
                    }

                    if (!isset($_POST[$questi])) {
                        $temp++;
                        //echo $questi . " is not set!" . "<br>";
                        $c = countSimilarElementsInArray($questionArray,$question);
                        if ($temp == $c) {
                            $notset++;
                            $temp = 0;
                        }
                    }
                    else if (countSimilarElementsInArray($questionArray,$question)==count($_POST[$questi])){

                        foreach ($_POST[$questi] as $key=>$answer) {
                            //echo $questi . " is  set!" . "<br>";
                            //echo $answer . " " . $correctAnswer . "<br>";
                            if ($answer == $correctAnswer) $aa++;
                        }

                        $c = countSimilarElementsInArray($questionArray,$question);
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

            echo "Not set : ".$notset."<br>";
            echo "Correct answers : ".$rate."<br>";
            echo "Incorrect answers : ".$incorrect."<br>";
            ?>
        </strong>
    </div>
    </div>
</div>
</body>
</html>
