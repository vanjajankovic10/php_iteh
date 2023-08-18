<?php

require "../../dbBroker.php";
require "../../Model/Skincare.php";

if(isset($_POST['id'])){

    $skincare = new Skincare($_POST['id']);

    $status = $skincare->delete($conn);

    if($status){
        echo "Successful";
    }else{
        echo $status;
        echo "Unsuccessful";
    }

}
