<?php
session_start();

if (isset($_SESSION['current_user'])) {
    header('Location: mainPage.php');
    exit();
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
        <div class="naslov">
            <h2>Create your account</h2>
        </div>
    </div>

    <div class="forma" style="border-radius:25px">
        <form method="post" id="registrationForm">
            <div class="input-group mb-3 container">
                <input class="form-control" type="text" name="username" placeholder="Username" value="">
            </div>
            <div class="input-group mb-3 container">
                <input class="form-control" type="password" name="password" placeholder="Password" value="">
            </div>
            <div class="input-group mb-3 container">
                <input class="form-control" type="text" name="name" placeholder="Name" value="">
            </div>
            <div class="input-group mb-3 container">
                <input class="form-control" type="text" name="surname" placeholder="Surname" value="">
            </div>
            <div class="input-group mb-3 container">
                <input class="form-control" type="date" name="birthday" value="">
            </div>
            <div class="form-check container">
                <input class="form-check-input" type="radio" name="gender" value="M" id="radioM">
                <label class="form-check-label" for="radioM">
                    Male
                </label>
            </div>
            <div class="form-check container">
                <input class="form-check-input" type="radio" name="gender" value="F" id="radioF">
                <label class="form-check-label" for="radioF">
                    Female
                </label>
            </div>

            <div class="d-grid gap-2 d-md-block" , style="margin-top:20px">
                <div class="text-center">
                    <button type="submit" id="register" class="btn btn-success" style="background-color: rgb(226, 178, 82, .8); border: none">Create account</button>
                    <button type="reset" class="btn btn-primary" style="background-color: rgb(226, 178, 82, .8); border: none">Reset form</button>
                    <button type="button" onclick="document.location.href='index.php'" class="btn btn-danger" style="background-color: rgb(226, 178, 82, .8); border: none">Cancel</button>
                </div>
            </div>

        </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script src="js/registration.js"></script>
</body>

</html>