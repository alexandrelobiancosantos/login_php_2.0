<?php
session_start();

//PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

/* DOIS MODOS POSSÍVEIS -> local, producao*/
$modo = 'desenvolvimento'; 

if($modo == 'desenvolvimento'){
    $servidor ="localhost";
    $usuario = "root";
    $senha = "GuaraGuarana";
    $banco = "login_php";
}

if($modo =='producao'){
    $servidor ="localhost";
    $usuario = "root";
    $senha = "GuaraGuarana";
    $banco = "login_php";
}

if($modo =='aws'){
    $servidor ="";
    $usuario = "";
    $senha = "";
    $banco = "";
}

try{
   $pdo = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha); 
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
   //echo "Banco conectado com sucesso!"; 
}catch(PDOException $erro){
    echo "Falha ao se conectar com o banco! ";
}

function limparPost($dados){
    $dados = trim($dados);
    $dados = stripslashes($dados);
    $dados = htmlspecialchars($dados);
    return $dados;
}

//FUNÇÃO DE AUTORIZAÇÃO DE PAGINA RESTRITA
function auth($token_session){
    //RECEVBENDO PDO COMO VARIAVEL GLOBA
    global $pdo;
    //VERIFICAR SE TEM AUTORIZAÇÃO
    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE token=? LIMIT 1");
    $sql->execute(array($token_session));
    $usuario = $sql->fetch(PDO::FETCH_ASSOC);
    // SE NÃO NCONTRAR USUARIO
    if(!$usuario){//REDIRECIONA PARA O LOGIN
        //header('location:index.php');
        return false;
    }else{//SE O USUARIO EXISTE ACESSA PAGINA RESTRITA
        return $usuario;
    }
}

