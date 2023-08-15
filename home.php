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

    <div class="homeContent">

        <div class="d-flex p-1 justify-content-center align-items-center">
            <div>
                <h3>Find your skincare product</h3>
            </div>
            <div class="w-50 p-3">
                <input class="form-control" type="text" placeholder="search" id="search">
            </div>
            <div>
                <input class="form-control" type="button" id="sortBtn" value="sort">
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 g-3 justify-content-center">
            <?php
            $purposes = Purpose::getAll($conn);
            while (($purpose = $purposes->fetch_assoc()) != null) { ?>

                <form method="post" action="purpose.php" class="col">
                    <div class="card" style="background-color: rgb(255, 122, 127, .8); width: 35vw; margin-left: auto; margin-right: auto;border-radius:25px">
                        <div class="card-body">
                            <input type="hidden" name="id_purpose" value="<?= $purpose['id'] ?>">
                            <h5 class="card-title"><?= $purpose['name'] ?></h5>
                            <?php $skincare = Skincare::getSkincare($purpose['skincare_id'], $conn)[0] ?>
                            <p class="card-text">Skincare: <?= $skincare['name'] . " " . $skincare['skin_type'] ?></p>
                            <p class="card-text">Brand: <?= $purpose['brand'] ?></p>
                            <p class="card-text">Purpose: <?= $purpose['name'] ?></p>
                            <?php $user = User::getUser($purpose['user_id'], $conn)[0] ?>
                            <p class="card-text">User added: <?= $user['username'] ?></p>
                            <button type="submit" class="btn btn-primary" style="background-color: rgb(11, 218, 81); border: none">View</button>
                        </div>
                    </div>
                </form>


            <?php }
            ?>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>