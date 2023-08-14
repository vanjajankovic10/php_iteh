<?php
require "dbBroker.php";
require "Model/Login.php";

$err = "";
session_start();

if (isset($_SESSION['current_user'])) {
    header('Location: mainPage.php');
    exit();
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $response = Login::login($conn, $username, $password);
    if ($response != null && $response->num_rows == 1) {
        $array = $response->fetch_assoc();
        $_SESSION['current_user'] = $array['username'];
        header('Location: mainPage.php');
        exit();
    } else {
        $err = "Wrong username or password!";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Skincare routine </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="icon.png" />
</head>

<body>
    <div class="header">
        <div class="naslov">
            <h1>Make your own skincare routine</h1>
        </div>

    </div>

    <div class="forma" style="margin-top: 20px;border-radius:25px">
        <form method="post">
            <div class="input-group mb-3 container">
                <input class="form-control" type="text" name="username" placeholder="Username" value="">
            </div>
            <div class="input-group mb-3 container">
                <input class="form-control" type="password" name="password" placeholder="Password" value="">
            </div>
            <div class="d-grid gap-2 d-md-block mx-auto">
                <div class="text-center">
                    <button type="submit" id="login" class="btn btn-success" style="background-color: rgba(226, 178, 82, 0.8); border: none;">Log in</button>
                    <button type="button" id="register" onclick="document.location.href='registration.php'" class="btn btn-primary" style="background-color: rgba(226, 178, 82, 0.8); border: none;">Create account</button>
                </div>
            </div>

        </form>
        <br>
        <div style="display: block;">
            <p style="color: black; background-color: white;"><?= $err ?></p>
        </div>
    </div>
</body>

</html>