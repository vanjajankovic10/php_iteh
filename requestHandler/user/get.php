<?php

require "../../dbBroker.php";
require "../../Model/User.php";

if(isset($_POST['username'])){

    $obj = User::getUser($_POST['username'],$conn);

    echo json_encode($obj);

}
