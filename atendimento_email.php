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


$nome = $_POST['nome'];
$email = $_POST['email'];
$assunto = $_POST['assunto'];

    // Verifica se o botão foi pressionado
    if(!empty($_POST['submit'])){
        echo 'Por favor, preencha os campos!!';
    }

    $mail = new PHPMailer(true); // Instancia do PHPMailer

    try{
        $mail = isSMTP();
        $mail->SMTPSecure = 'tls';                                  //Enviar usando TLS
        $mail->Host       = 'smtp.gmail.com';                     //Servidor usado
        $mail->SMTPAuth   = true;                                   //Ativando autenticacao SMTP
        $mail->Username   = 'testeprojeto40@gmail.com';                     //Usuario SMTP
        $mail->Password   = 'mzacqpqnulwnuyrr';                           //Senha SMTP     
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
        $mail->setFrom($email);  //Usuario SMTP e Nome aleatório
        $mail->addAddress('testeprojeto40@gmail.com');     //Email do Destinatario
        $mail->isHTML(true);  //Habilitando o uso do HTML
        $mail->charset = 'UTF-8';
        $mail->Subject = $nome;    //Titulo
        $mail->Body    = $assunto;   //Corpo
        $mail->AltBody = $assunto;
        $mail->send();
    
    } catch (Exception $e) {
        echo 'Erro: '.$e->getMessage();
        header('Location: index.html');
    }

?>