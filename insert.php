<?php

// Include the database connection file
include('database.php');

// Get parameters from the URL (if any)
var_dump($_GET);

// Define the values to insert
$nome = 'Ester'; // Example name
$email = '@ester'; // Example email

// Prepare the SQL insert statement
$sqlInsert = "INSERT INTO TB_USUARIO (NOME_US, EMAIL_US) VALUES (?, ?)";
$stmt = $con->prepare($sqlInsert);

// Execute the statement with the provided values
$bool = $stmt->execute([$nome, $email]);

if ($bool) {
    echo "Inserido !!!";
    echo "<br>";
    echo "id " . $con->lastInsertId(); // Get the last inserted ID
} else {
    echo "Estudar mais !!!";
}
