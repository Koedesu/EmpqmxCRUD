<?php

    $servidor = "localhost";
    $db = "empqmxcrud";
    $name = "root";
    $password = "";

    try{
        $conn = new PDO("mysql:host=$servidor;dbname=$db",$name,$password);
    }catch(Exception $ex){
        echo $ex->getMessage(); 
    };

?>     