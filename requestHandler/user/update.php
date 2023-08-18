<?php

require "../../dbBroker.php";
require "../../Model/User.php";

if (
    isset($_POST['id']) &&
    isset($_POST['name']) &&
    isset($_POST['surname']) &&
    isset($_POST['birthday']) &&
    isset($_POST['gender']) &&
    isset($_POST['username']) &&
    isset($_POST['password'])
) {

    $user = new User(
        $_POST['id'],
        $_POST['name'],
        $_POST['surname'],
        $_POST['birthday'],
        $_POST['gender'],
        $_POST['username'],
        $_POST['password']
    );

    $status = $user->update($conn);

    if ($status) {
        echo "Edited";
    } else {
        echo $status;
        echo "Error";
    }
}
