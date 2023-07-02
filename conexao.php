<?php
// Parâmetros para criar a conexão
$server = "localhost";
$username = "root";
$password = "";
$dbname = "provedora";

// Criando a conexão
$conn = new mysqli($server, $username, $password, $dbname);

// Checando a conexão
if ($conn->connect_error) {
  die("Você se deu mal: " . $conn->connect_error);
}
?>