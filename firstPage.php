<?php
session_start();
if (isset($_POST['name']))
    $_SESSION['student'] = $_POST['name'];
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
        <form action="secondPage.php" method="post">

            <div><h2 align="center">Tест 1</h2></div>

            <?php
            if (isset($_SESSION['student']))
                echo "Студент : ".$_SESSION['student'].".<br>";
            else
                echo "Сессионная переменная не создана!<br />";

            //$rate = $incorrect = 0;
            $fileString = file_get_contents("test1.txt");
            if (!$fileString) echo "Error in readfile";
            else {
                $arr = explode('|', trim($fileString, "[]"));
                foreach ($arr as $i =>  $a)
                    if (!$a=="") {
                        $arr2[$i] = explode(';', trim($a, "[]"));
                    }
            }

            for ($i = $j =0; $i < count($arr2); $i++) {
                //echo '<br>';

              /*  if ($_SESSION['student']=='Admin') {
                    echo '<label>' . '<b>' . $arr2[$i][$j] . '</b>' . ".  " . '</label>';   //N
                    //echo '<label>'.$arr2[$i][$j+1] .'</label>'; //question
                    //echo '<br>';
                    //echo '<label>'.$arr2[$i][$j+2] .'</label>'; //radio1
                    //echo '<label>'.$arr2[$i][$j+3] .'</label>'; //radio2
                    //echo '<label>'.$arr2[$i][$j+4] .'</label>'; //radio3
                    echo '<label>' . 'Правильный ответ : ' . $arr2[$i][$j + 5] . '</label>'; //correct answer

                }*/

                ?>
                <br>
                <label><b><?php echo $arr2[$i][$j] ?></b></label>
                <label><?php echo $arr2[$i][$j+1] ?></label>
                <?php if (isset($_SESSION['student'])&&($_SESSION['student'] == 'Admin')) {
                echo '<br>'.'Правильный ответ : ' . $arr2[$i][$j + 5] . '<br>';
                } ?>


                <?php
                $name="question".strval($i+1);

                $questionNames[$name] = $arr2[$i][$j+5];

                ?>
                <br>
                <input type="radio" name= '<?php echo $name ?>'
                       value="1"><?php echo '  '.$arr2[$i][$j+2] ?><br>

                <input type="radio" name= '<?php echo $name ?>'
                       value="2"><?php echo '  '.$arr2[$i][$j+3] ?><br>

                <input type="radio" name= '<?php echo $name ?>'
                       value="3"><?php echo '  '.$arr2[$i][$j+4] ?><br>

                <?php
            }
            ?>
            <br><input type="submit" class="btn btn-primary" value="Далее" id="second">

        </form>

    </div>
</div>
</body>
</html>