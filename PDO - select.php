<?php
    include('database.php');



    //executar comando sql(select)

    $sql = " SELECT * FROM TB_USUARIO ":

    //$result = $con->query($sql);
    foreach( $con->query($sql) as $value){
      echo $value["ID_US"] ."  " . $value[1]."  " .$value[2] ."<br>";

    }

    //var_dump($result);


?>
