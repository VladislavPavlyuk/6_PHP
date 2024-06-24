<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        span.error {
            color: red;
        }
    </style>
</head>
<body>
<?php
$nameErr = $name = "";

if (($_SERVER["REQUEST_METHOD"] == "POST")&&(isset($_POST["name"]))) {
    $name = test_input($_POST["name"]);
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<div class="container">
    <div class="column">
        <form action="firstPage.php" method="post">
            <div>
                <h3 align="center">Пройдите тест.</h3>
                <h4 align="center">Тест состоит из трех блоков вопросов.</h4>
            </div>
            <div>
                <label>Введите имя</label>
                <label><input type="text" name="name"></label><br>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (empty($_POST["name"])) {
                        $nameErr = "Name is required";
                    } else {
                        $name = test_input($_POST["name"]);
                    }
                }
                ?>
                <span class="error" ><?php echo $nameErr;?></span>
                <br><br>
                <input type="submit" class="btn btn-primary" name="submit" value="Далее" id="first">
            </div>

        </form>
        <?php
        /*if (isset($_POST['submit']) && !empty($_POST["name"]))
        {
            $_SESSION['student'] = $_POST['name'];
            ?>
            <br><button type="button" class="btn btn-primary" onclick="location.href = 'firstPage.php';">Перейти к тесту</button>
    </div>
        <?php }*/
        ?>

    </div>
</body>
</html>






