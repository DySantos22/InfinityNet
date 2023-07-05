<?php
session_start();

/*Verificando se os campos foram preenchidos */
if(empty($_POST['senha'])||empty($_POST['confirma_sennha'])){
    echo 'Preencha todos os campos para continuar!';
}

/*Verificando se as senhas são iguais */
$senha = $_POST['senha'];
$confirma_senha = $_POST['confirma_senha'];

if($senha != $confirma_senha){
    echo 'As senhas não são iguais!';
}

/*Recebendo email via URL */
$email = $_GET['email'];


















?>