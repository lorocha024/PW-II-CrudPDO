<?php
  $host = "localhost";
  $username = "root";
  $password = "";
  $database = "PROJETOPDO";


    try {
     // conexão
    //  $con = new PDO("mysql:host=$server;dbname=$db",$user,$pas);
    $con = new PDO("mysql:host=$host;dbname=$database",$username,$password); 
    // atributos de condiz o tipo da mensagem(static);
     
     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     echo "Conectado!";

    }
    catch(PDOExcepition $er){
        echo "erro " . $er->getMessage();
    }

?>
