<?php

//Conexão com PDO

$servername = "bookApi";
$username = "root";
$password = "4linux";

try {
    $conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Sucesso!";
    }
     catch(PDOException $e)
     {
    echo "Falha na conexao: " . $e->getMessage();
    }
