<?php
require('config/conexao.php');


if(isset($_GET['$cod_conf']) && !empty($_GET['$cod_conf'])){
    $cod=limparPost($_GET['$cod_conf']);
    //CONSULTAR SE ALGUM USUARIO TEM O CODIGO DE CONFIRMAÇÃO
    $slq=$pdo->prepare("SELECT * FROM usuarios WHERE cod_conf=? LIMIT 1");
    $sql->execute(array($cod));
    $usuario = $sql->fetch(PDO::FETCH_ASSOC);
    if($usuario){//ATUALIZA STATUS DO USUARIO
        $status="confirmado";
        $slq=$pdo->prepare("UPDATE usuarios SET WHERE cod_conf status=?");
        if($sql->execute(array($status,$cod_conf))){
            header('location: index.php?result=ok');
        }
    }
}

?>