<?php
require "../../dbBroker.php";
require "../../Model/User.php";

if (
    isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['birthday']) &&
    isset($_POST['gender']) && isset($_POST['username']) && isset($_POST['password'])
) {
    $user = new User(
        null,
        $_POST['name'],
        $_POST['surname'],
        $_POST['birthday'],
        $_POST['gender'],
        $_POST['username'],
        $_POST['password']
    );
    $status = $user->add($conn);

    if ($status) {
        echo "Successful";
    } else {
        echo ("Failed");
    }
}
