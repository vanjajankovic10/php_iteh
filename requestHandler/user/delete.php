<?php

require "../../dbBroker.php";
require "../../Model/User.php";

if (isset($_POST['id'])) {

    $user = new User($_POST['id']);

    $status = $user->delete($conn);

    if ($status) {
        echo "Deleted";
    } else {
        echo $status;
        echo "Error";
    }
}
