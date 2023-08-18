<?php

require "../../dbBroker.php";
require "../../Model/Skincare.php";

if(isset($_POST['id'])){

    $obj = Skincare::getSkincare($_POST['id'],$conn);

    echo json_encode($obj);

}
