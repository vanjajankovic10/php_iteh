<?php

require "../../dbBroker.php";
require "../../Model/Purpose.php";

$bool = [];
if (isset($_POST['data'])) {
    $data = $_POST['data'];

    foreach ($data as $item) {
        if (
            isset($item['name']) &&
            isset($item['brand']) &&
            isset($item['user_id']) &&
            isset($item['skincare_id'])
        ) {
            $purpose = new Purpose(
                null,
                $item['name'],
                $item['brand'],
                $item['user_id'],
                $item['skincare_id']
            );

            $status = $purpose->add($conn);

            $bool[] = $status ? true : false;
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
