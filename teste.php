<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=meu_crud;charset=utf8mb4", "root", "");
    echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
