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

$user = User::getUserUsername($_SESSION['current_user'], $conn)[0];
$user_id = $user['id'];
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

    <div class="accountContent">
        <div class="naslov" style="color: #ffffff; margin: top 20px;">
            <h2>Add your skincare routine</h2>
        </div>
        <div class="naslov">
            <h2 style="color: #ffffff; font-size: 1.5em">Tell us something about it!</h2>
        </div>

        <div class="forma" style="border-radius:25px">
            <form method="post" id="formSkincareInfo">
                <input type="hidden" name="id" value="">

                <div class="input-group mb-3 container">
                    <input class="form-control" type="text" name="name" placeholder="Name" value="">
                </div>
                <div class="input-group mb-3 container">
                    <input class="form-control" type="text" name="skin_type" placeholder="Skin type" value="">
                </div>
                <div class="input-group mb-3 container">
                    <input class="form-control" type="text" name="comment" placeholder="Comment" value="">
                </div>
            </form>
            <form method="post" id="formPurposeInfo">
                <div class="input-group mb-3 container">
                    <input class="form-control custom-input" type="text" name="cleanser" placeholder="Cleanser" value="">
                </div>
                <div class="input-group mb-3 container">
                    <input class="form-control custom-input" type="text" name="toner" placeholder="Toner" value="">
                </div>
                <div class="input-group mb-3 container">
                    <input class="form-control custom-input" type="text" name="moisturizer" placeholder="Moisturizer" value="">
                </div>
                <div class="input-group mb-3 container">
                    <input class="form-control custom-input" type="text" name="spf" placeholder="Sun protection" value="">
                </div>
            </form>
            <div class="d-grid gap-2 d-md-block">
                <div class="text-center">
                    <button type="submit" id="btnSaveSkincare" class="btn btn-success" style="background-color: rgb(226, 178, 82, .8); border: none">Save</button>
                    <button type="reset" id="resetSkincare" class="btn btn-primary" style="background-color: rgb(226, 178, 82, .8); border: none; margin-top:20px">Reset form</button>
                    <button type="button" id="deleteSkincare" class="btn btn-danger" style="background-color: rgb(226, 178, 82, .8); border: none; margin-top:20px">Delete</button>
                </div>
            </div>

        </div>

        <div class="skincareListing" style="padding: 20px;border-radius:25px">
            <div class="d-flex p-1 justify-content-center align-items-center">
                <div>
                    <h2 style="color: #ffffff;">Other skincares</h2>
                </div>
                <div class="w-50 p-3">
                    <input class="form-control" type="text" placeholder="search" id="search">
                </div>
                <div>
                    <input class="form-control" type="button" id="sortBtn" value="sort">
                </div>
            </div>

            <div class="row row-cols-1 row-cols-sm-3 g-3">
                <?php

                $skincares = Skincare::getAll($conn);
                $purposes = Purpose::getAll($conn);

                while (($skincare = $skincares->fetch_assoc()) != null) { ?>

                    <div class="col">
                        <div class="card" style="background-color: rgb(226, 178, 82, .8);border-radius:25px">
                            <div class="card-body">
                                <h5 class="card-title"><?= $skincare['name'] ?></h5>
                                <p class="card-text"><?= $skincare['skin_type'] ?></p>
                                <p class="card-text"><?= $skincare['comment'] ?></p>

                                <?php
                                $skincare_purposes = [];
                                $purposes->data_seek(0);
                                while (($purpose = $purposes->fetch_assoc()) != null) {
                                    if ($skincare['id'] == $purpose['skincare_id']) {
                                        $skincare_purposes[] = $purpose;
                                    }
                                }
                                foreach ($skincare_purposes as $purpose) {
                                    echo "<p class='card-text'>" . "-" . $purpose['name'] . ": " . $purpose['brand'] . "</p>";
                                }
                                ?>

                                <button type="submit" id="btnViewSkincare <?= $skincare['id'] ?>" class="btn btn-success btnViewSkincare" style="background-color: #91753D; border: none">View</button>
                            </div>
                        </div>
                    </div>
                <?php
                } ?>
            </div>



        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        var user_id_js = <?php echo json_encode($user_id); ?>;
    </script>
    <script src="js/skincare.js"></script>
    <script src="js/purpose.js"></script>
    <?php
    if (isset($_POST['id'])) {
        echo '<script type="text/javascript">
                    fill(' . $_POST["id"] . ');
                </script>';
    }
    ?>
</body>

</html>