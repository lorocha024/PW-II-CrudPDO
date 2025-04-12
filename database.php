<?php
  $host = "localhost";
  $username = "root";
  $password = "";
  $database = "projetopdo";

    try {
    $con = new PDO("mysql:host=$host;dbname=$database",$username,$projetopdo);
    $con->setAtribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    echo "Conectado";
    }
    catch(PDOExcepition $e){
        echo "FALHA " . $E->getMessage();
    }
