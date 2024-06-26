<?php
/*if ((isset($_POST['name']))&&($_POST['name']=="")){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();

}*/

session_start();

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
                echo "Студент : ".$_SESSION['student']."<br>";
            else
                echo "Сессионная переменная не создана!<br />";

            //$rate = $incorrect = 0;
            $fileStringFirst = file_get_contents("test1.txt");
            if (!$fileStringFirst) echo "Error in readfile";
            else {
                $arrFirst = explode('|', trim($fileStringFirst, "[]"));
                foreach ($arrFirst as $i =>  $a)
                    if (!$a=="") {
                        $arrFirst2[$i] = explode(';', trim($a, "[]"));
                    }
            }

            $mixedArrayFirst = randomMixArray($arrFirst);

            $_SESSION['$mixedArrayFirst'] = $mixedArrayFirst;

            foreach ( $arrFirst2 as $key => $item) {
                $m = $mixedArrayFirst[$key];
                $tempArrFirst[$key] = $arrFirst2[$m];
            }
            $arrFirst2 = $tempArrFirst;

            for ($i = $j = 0; $i < count($arrFirst2); $i++) {
            if (isset($_SESSION['student'])&&($_SESSION['student'] == 'Admin')) {
                echo '<br><label><b>';
                echo $arrFirst2[$i][$j];
                echo '</b></label>';
            }   else
                echo '<br><label><b>'.($i+1).'</b>';
                echo '<label>'.'.'.$arrFirst2[$i][$j+1].'</label>';
                if (isset($_SESSION['student'])&&($_SESSION['student'] == 'Admin')) {
                echo '<br><b>'.'Правильный ответ : ' . $arrFirst2[$i][$j + 5] . '</b><br>';
                }

                $name="question".strval($i+1);

                $questionNames[$name] = $arrFirst2[$i][$j+5];

                ?>
                <br>
                <input type="radio" name= '<?php echo $name ?>'
                       value="1"><?php echo '  '.$arrFirst2[$i][$j+2] ?><br>

                <input type="radio" name= '<?php echo $name ?>'
                       value="2"><?php echo '  '.$arrFirst2[$i][$j+3] ?><br>

                <input type="radio" name= '<?php echo $name ?>'
                       value="3"><?php echo '  '.$arrFirst2[$i][$j+4] ?><br>

                <?php
                if (empty($_POST['<?php echo $name ?>'])) {
                    $answerErr = "Answer is required";
                } else {
                    $answer = test_input($_POST['<?php echo $name ?>']);
                }
            }
            ?>
            <br><input type="submit" class="btn btn-primary" value="Далее" id="second">

        </form>

    </div>
</div>
</body>
</html>