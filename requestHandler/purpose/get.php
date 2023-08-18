<?php

require "../../dbBroker.php";
require "../../Model/Purpose.php";

if (isset($_POST['skincare_id'])) {
    $skincare_id = $_POST['skincare_id'];
    $purposes = Purpose::getPurposesBySkincareID($skincare_id, $conn);
    header('Content-Type: application/json');
    echo json_encode($purposes);
}
