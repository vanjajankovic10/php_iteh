<?php
session_start();

if (!isset($_SESSION['current_user'])) {
    header('Location: index.php');
    exit();
}
require "dbBroker.php";
require "Model/User.php";
require "Model/Skincare.php";
require "Model/Purpose.php";
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
    <div class="toolbar" style="background-color: #91753D;">
        <div class="navigacija d-flex justify-content-between">
            <ul class="nav" id="navigacija-lista">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="naslovna.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="predstava.php">Skincare</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="uloga.php">Purpose</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profil.php">Accounts</a>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                <p class="m-0" style="margin-right: 20px font-size: 1.5em; color: #ffffff; font-family: 'Trebuchet MS'">Prijavljen na sistem: <?= $_SESSION['current_user'] ?></p>
                <a class="btn btn-primary" href="logout.php" style="background-color: rgb(226, 178, 82, .8); border:none; margin-left: 20px;">Log out</a>
            </div>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>