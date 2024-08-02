<?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'jul312024_db';

    $conn = mysqli_connect($hostname,$username,$password,$database);

    if($conn) {
         echo "$database is connected successfully";
    }