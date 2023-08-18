<?php

require "../../dbBroker.php";
require "../../Model/Skincare.php";

if (
    isset($_POST['id']) &&
    isset($_POST['name']) &&
    isset($_POST['skin_type']) &&
    isset($_POST['comment'])
) {
    $skincare = new Skincare(
        $_POST['id'],
        $_POST['name'],
        $_POST['skin_type'],
        $_POST['comment']
    );

    $status = $skincare->update($conn);

    if ($status) {
        echo "Successful. Inserted ID: " . $_POST['id'];
    } else {
        echo $status;
        echo "Unsuccessful";
    }
}
