<?php
//INICIALIZAÇÃO DE SESSÃO
session_start();

/* Tipo de banco: Desenvolvimento(local) ou Produção(AWS)*/
$modo = 'desenvolvimento';

/* Ambiente Dev */
if($modo == 'desenvolvimento'){
    $servidor ="localhost";
    $usuario = "root";
    $senha = "GuaraGuarana";
    $banco = "login_php";
}
/* Ambiente produção */
if($modo == 'producao'){
    $servidor = "AWS";
    $usuario = "AWS";
    $senha = "AWS";
    $banco = "login_php";
}

try{
    $pdo = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    //echo "Banco conectado com sucesso!"; 
 }catch(PDOException $erro){
    echo "Falha ao se conectar com o banco! ";
    //echo "Erro: ".$erro->getMessage()
 }

//Função limpa post

function limpaPost($dados){
    $dados = trim($dados);
    $dados = stripslashes($dados);
    $dados = htmlspecialchars($dados);
    return $dados;
}

?>