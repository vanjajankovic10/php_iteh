<?php
session_start();

if (!isset($_SESSION['current_user'])) {
    header('Location: index.php');
    exit();
}

require "dbBroker.php";
require "Model/User.php";
require "Model/Purpose.php";
require "Model/Skincare.php";

$user = User::getUserUsername($_SESSION['current_user'], $conn)[0];
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
    <div class="toolbar" style="background-color: rgb(97, 84, 58, .6);">
        <div class="navigacija d-flex justify-content-between">
            <ul class="nav" id="navigacija-lista">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="skincare.php">Skincare</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="purpose.php">Purpose</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="account.php">Account</a>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                <p class="m-0" style="margin-right: 20px font-size: 1.5em; color: #ffffff; font-family: 'Trebuchet MS'">Active user: <?= $_SESSION['current_user'] ?></p>
                <a class="btn btn-primary" href="logout.php" style="background-color: rgb(226, 178, 82, .8); border:none; margin-left: 20px;">Log out</a>

            </div>

        </div>

    </div>
    <div class="header">
        <div class="naslov">
            <h1>Make your own skincare routine</h1>
        </div>

    </div>


    <div class="content">
        <div class="naslov">
            <h2 style="color: #ffffff;">Purposes</h2>
        </div>
        <div class="forma" style="border-radius:25px">
            <form method="post" id="formPurpose">
                <input type="hidden" name="id" value="">
                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">


                <div class="input-group mb-3 container">
                    <span class="input-group-text">Purpose</span>
                    <input class="form-control" type="text" placeholder="search skincare element" id="search">
                    <button type="submit" id="btnSearch" class="btn btn-success" style="background-color: rgb(226, 178, 82, .8); border: none">Search</button>
                </div>

            </form>

        </div>
        <div class="row row-cols-1 row-cols-sm-4 g-3">
            <?php
            $purposes = Purpose::getAll($conn);

            while (($purpose = $purposes->fetch_assoc()) != null) { ?>

                <div class="col">
                    <div class="card" style="background-color: rgb(226, 178, 82, .8);border-radius:25px">
                        <div class="card-body">
                            <h5 class="card-title"><?= $purpose['name'] ?></h5>
                            <p class="card-text"><?= $purpose['brand'] ?></p>
                        </div>
                    </div>
                </div>
            <?php
            } ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/purpose.js"></script>
        <script src="js/search.js"></script>
</body>

</html>