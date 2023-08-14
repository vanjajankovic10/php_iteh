<?php
    $user = 'root';
    $password = '';
    $server = 'localhost';
    $database = 'skincare';

    $conn = new mysqli($server, $user, $password, $database);

    if($conn->connect_errno){
        exit('Konekcija sa bazom neuspesna! '. $conn->connect_error);
    }
