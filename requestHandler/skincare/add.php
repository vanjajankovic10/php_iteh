<?php

require "../../dbBroker.php";
require "../../Model/Skincare.php";

if (
    isset($_POST['name']) &&
    isset($_POST['skin_type']) &&
    isset($_POST['comment'])
) {

    $skincare = new Skincare(
        null,
        $_POST['name'],
        $_POST['skin_type'],
        $_POST['comment']
    );

    $status = $skincare->add($conn);

    if ($status) {
        $insertedId = mysqli_insert_id($conn);
        echo "Successful. Inserted ID: " . $insertedId;
    } else {
        echo "Unsuccessful";
    }
}
