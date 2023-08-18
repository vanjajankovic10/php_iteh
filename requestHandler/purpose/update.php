<?php

require "../../dbBroker.php";
require "../../Model/Purpose.php";

$bool = [];

if (isset($_POST['data'])) {
    $data = $_POST['data'];

    foreach ($data as $index => $item) {
        if (
            isset($item['name']) &&
            isset($item['brand']) &&
            isset($item['user_id']) &&
            isset($item['skincare_id'])
        ) {
            $purpose = new Purpose();
            $purposeIds = $purpose->getPurposeIdByConditions(
                $conn,
                $item['skincare_id']
            );

            if (isset($purposeIds[$index])) {
                $purposeId = $purposeIds[$index]['id'];
                $purpose = new Purpose(
                    $purposeId,
                    $item['name'],
                    $item['brand'],
                    $item['user_id'],
                    $item['skincare_id']
                );
                $status = $purpose->update($conn);

                $bool[] = $status ? true : false;
            } else {
                echo "No purpose IDs available for skincare_id: " . $item['skincare_id'] . "\n";
            }
        } else {
            echo "Missing data\n";
        }
    }
}
if (in_array(false, $bool)) {
    echo "Unsuccessful";
} else {
    echo "Successful";
}
