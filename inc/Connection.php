<?php
//Home Connection
    // try {
    // $DB = new PDO("mysql:host=127.0.0.1;dbname=to_do;port=8889","root","root");
    // $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // } catch (Exception $e) {
    //   echo "Unable to Connect";
    //   //echo $e->getMessage();
    //   exit;
    // } // native exception class

// Home Connection #2
    // $server = 'mysql:host=localhost:8889;dbname=to_do';
    // $username = 'root';
    // $password = 'root';
    // $DB = new PDO($server, $username, $password);


//Epicodus Connection
    $server = 'mysql:host=localhost;dbname=to_do';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
