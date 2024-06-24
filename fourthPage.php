<?php
session_start();
if (isset($_SESSION['rate']))
    $rate = $_SESSION['rate'];
else $rate = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Result</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        strong {
            color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="column">
        <form action="index.php" method="post">
            <div>
                <h3 align="center">Поздравляем!</h3>
            </div>
            <div>
                <label>Ваш результат : </label>
                <strong><?php echo $rate;?></strong>
                <br><br>
                <input type="submit" class="btn btn-primary" name="Restart" value="Пройти заново" id="first">
            </div>
        </form>


    </div>
</body>
</html>
