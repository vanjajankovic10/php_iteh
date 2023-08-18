<?php

require "../../dbBroker.php";
require "../../Model/Purpose.php";
$bool = [];
if (isset($_POST['skincare_id'])) {
    $skincare_id = $_POST['skincare_id'];
    $purposes = Purpose::getPurposesBySkincareID($skincare_id, $conn);
    $purposeObjects = [];
    foreach ($purposes as $purposeData) {
        $purposeObjects[] = new Purpose(
            $purposeData['id'],
            $purposeData['name'],
            $purposeData['brand'],
            $purposeData['user_id'],
            $purposeData['skincare_id']
        );
    }

    foreach ($purposeObjects as $purpose) {
        $status = $purpose->delete($conn);
        $bool[] = $status ? true : false;
    }
}
if (in_array(false, $bool)) {
    echo "Unsuccessful";
} else {
    echo "Successful";
}
