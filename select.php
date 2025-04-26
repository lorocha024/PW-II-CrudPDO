<?php

// Include the database connection file
include('database.php');

// Prepare the SQL select statement
$sql = "SELECT * FROM TB_USUARIO";
$stmt = $con->prepare($sql);

// Execute the statement
$stmt->execute();

// Fetch the first row
$linha = $stmt->fetch(PDO::FETCH_ASSOC);
print_r($linha);

// Fetch all rows and display them
while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $linha["ID_US"] . " " . $linha["NOME_US"] . " " . $linha["EMAIL_US"] . "<br>";
}
