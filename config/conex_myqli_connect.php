<?php

/* Tipo de banco: Desenvolvimento(local) ou Produção(AWS)*/
$modo = 'desenvolvimento';

/* Ambiente Dev */
if($modo == 'desenvolvimento'){
    $servidor ="localhost1";
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


$link = mysqli_connect($servidor, $usuario, $senha);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';
mysqli_close($link);

/*
try{
    $pdo = new PDO("mysqli:host=$servidor;dbname=$banco",$usuario,$senha); 
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    echo "Banco conectado com sucesso!"; 
 }catch(PDOException $erro){
     echo "Falha ao se conectar com o banco! ";
 }
*/
?>