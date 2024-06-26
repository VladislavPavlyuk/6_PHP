<?php
session_start();

$nameErr = $name = "";
$valid = false;
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
        } else $valid = true;
    }
}

if ($valid) {
    $_SESSION['student'] = $_POST['name'];
    header('location: firstPage.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .error { color: red; }
    </style>
</head>
<body>
<?php

?>
<div class="container">
    <div class="column">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div>
                <h3 align="center">Пройдите тест.</h3>
                <h4 align="center">Тест состоит из трех блоков вопросов.</h4>
            </div>
            <div>
                <label>Введите имя студента</label>
                <label><input type="text" name="name"></label><br>
                <?php

                ?>
                <span class="error" ><?php echo $nameErr;?></span>
                <br><br>
                <input type="submit" class="btn btn-primary" name="submit" value="Далее" id="index">
            </div>
        </form>
    </div>
</body>
</html>






