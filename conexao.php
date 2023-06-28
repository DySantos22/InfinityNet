<?php

define('HOST', 'localhost');
define('DBNAME', 'provedora');
define('USERNAME', 'root');
define('PASSWORD', ' ');

try{
    $conn = new PDO('mysql:host='.HOST.';dbname='.DBNAME.';user='.USERNAME.';password='.PASSWORD);
}catch (PDOException $e){
    echo 'Erro na conexão:'.$e->getMessage();
}

$conn = NULL;



?>