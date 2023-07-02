<?php
session_start();

require_once __DIR__. '/lib/vendor/autoload.php';
require_once __DIR__. '/lib/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once __DIR__. '/lib/vendor/phpmailer/phpmailer/src/SMTP.php';
require_once __DIR__. '/lib/vendor/phpmailer/phpmailer/src/Exception.php';
require 'conexao.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    if(empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['assunto'])){
        echo 'Preencha todos os campos!!';
        header('refresh:2;url=atendimento.html');
    }else{

$nome = $_POST['nome'];
$email = $_POST['email'];
$assunto = $_POST['assunto'];

//Instanciando a váriavel do email  
$mail = new PHPMailer(true);     //Instancia do PHPmailer

//Fazendo a ligação do email
try {
    //Configurações do servidor (gmail)
    
    $mail->isSMTP();      
    $mail->SMTPSecure = 'tls';                                  //Enviar usando TLS
    $mail->Host       = 'smtp.gmail.com';                     //Servidor usado
    $mail->SMTPAuth   = true;                                   //Ativando autenticacao SMTP
    $mail->Username   = 'testeprojeto40@gmail.com';                     //Usuario SMTP
    $mail->Password   = 'mzacqpqnulwnuyrr';                               //Senha SMTP     
    $mail->Port       = 587;        //Porta usada para TLS

    //Aqui ele tira o erro do SSL e da conexão com o Host
    $mail->SMTPOptions = array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
    );
    
    //quem envia e recebe
    $mail->setFrom($email,$nome);  //Usuario SMTP e Nome aleatório
    $mail->addAddress('testeprojeto40@gmail.com');     //Email do Destinatario
    $mail->isHTML(true);                                  //Habilitando o uso do HTML
    $mail->charset = 'UTF-8';
    $mail->Subject = "SUPORTE $email";    //Titulo
    $mail->Body    = "Nome: $nome<br>Email: $email<br>Mensagem: $assunto";
    $mail->AltBody =  "Nome: $nome<br>Email: $email<br>Mensagem: $assunto";
    $mail->send();
    header('refresh:2;url=atendimento.html');
    
} catch (Exception $e) {
    echo "Mensagem não foi enviada. ERRO: {$mail->ErrorInfo}";   //Mensagem de erro, depois envia para o
    header('refresh:2;url=atendimento.html');
}
}
?>