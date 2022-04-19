<?php

    //Establishing a connection

    $hostname = "localhost";
    $username = "root";
    $password1 = "";
    $dbname = "test_database";

    //die() drops the connection immediately to prevent hackers, or in other fatal cases
    //making the connection to mysql
    $dbc = mysqli_connect($hostname, $username, $password1, $dbname) OR die("Cannot Connect, ERROR: ".mysqli_connect());

    //Set encoding
    mysqli_set_charset($dbc, "utf8");

    // echo "You are now connected to ".$dbname;
?>