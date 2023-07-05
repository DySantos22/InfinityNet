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

/*Verifica se o campo está preenchido corretamente */

if(empty($_POST['email'])){
    echo 'Preencha o campo!';
    header('refresh:2;url=recuperar.html');
}

/* Aqui recebe o email digitado pelo usuário */
$email = $_POST['email'];

/* Selecionando o usuario com o email */
$sql = "SELECT * FROM usuario WHERE Email='$email'";

/* Executa o SQL */
$result = $conn->query($sql);

/*Criando matriz para a consulta */
$row = $result->fetch_assoc();

/*Se ele achar o email no BD, ele executa o procedimento */
if($result->num_rows > 0){
    
    $mail = new PHPMailer(true);

    try{
        $mail->isSMTP();      
        $mail->SMTPSecure = 'tls';                                  //Enviar usando TLS
        $mail->Host       = 'smtp.gmail.com';                     //Servidor usado
        $mail->SMTPAuth   = true;                                   //Ativando autenticacao SMTP
        $mail->Username   = 'testeprojeto40@gmail.com';                     //Usuario SMTP
        $mail->Password   = '';                               //Senha SMTP     
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
        $mail->setFrom('testeprojeto40@gmail.com','INFINITY NET');  //Usuario SMTP e Nome aleatório
        $mail->addAddress($email);     //Email do Destinatario
        $mail->isHTML(true);                                  //Habilitando o uso do HTML
        $mail->charset = 'UTF-8';
        $mail->Subject = "Redefinir Senha";    //Titulo
        $mail->Body    = "Olá!<br><br>Caso queira redefinir sua senha, <a href='http://localhost/recuperando.html?email=$email' target='_blank'>Clique aqui!</a><br><br>Caso não queira, desconsidere este email.";
        $mail->AltBody =  "Olá!<br><br>Caso queira redefinir sua senha, <a href='http://localhost/recuperando.html?email=$email' target='_blank'>Clique aqui!</a><br><br>Caso não queira, desconsidere este email.";
        $mail->send();
    header('refresh:2;url=recuperar.html');

    }catch (Exception $e){
        echo "Mensagem não foi enviada. ERRO: {$mail->ErrorInfo}";
        mysqli_close($sql);
    }

}else{
    echo 'Email não existe!';
    mysqli_close($sql);
}
?>