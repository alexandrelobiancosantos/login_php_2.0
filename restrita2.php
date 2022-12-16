<?php
require('config/conexao.php');

//VERIFICAÇÃO DE ATENTICAÇÃO
$usuario_aut=auth($_SESSION['TOKEN']);
if($usuario_aut){//SE O USUARIO FOR AUTENTICADO
    echo "<h1> Seja Bem Vindo, <b style='color:red'>".$usuario_aut['nome']. "</b>, à pagina restrita 2! </h1>";
    //print_r($_SESSION);
    echo "<br><br><a style='background:green; color:white; border-radius:5px; text-decoration:none; padding: 20px; ' href='logout.php'>Logout</a>";
}else{//SE O USUARIO NAO FOR AUTENTICADO
    header('location: index.php');
}



/*
//VERIFICAR SE TEM AUTORIZAÇÃO
$sql = $pdo->prepare("SELECT * FROM usuarios WHERE token=? LIMIT 1");
$sql->execute(array($_SESSION['TOKEN']));
$usuario = $sql->fetch(PDO::FETCH_ASSOC);
// SE NÃO NCONTRAR USUARIO
if(!$usuario){//REDIRECIONA PARA O LOGIN
    header('location:index.php');
}else{//SE O USUARIO EXISTE ACESSA PAGINA RESTRITA
    echo "<h1> Seja Bem Vindo, <b style='color:red'>".$usuario['nome']. "</b>, à pagina restrita! </h1>";
    //print_r($_SESSION);
    echo "<br><br><a style='background:green; color:white; border-radius:5px; text-decoration:none; padding: 20px; ' href='logout.php'>Logout</a>";
    //echo "<br><br><a style='background:green; color:white; border-radius:5px; text-decoration:none; padding: 20px; ' href='logout.php'>Sair do sistema</a>";
}
*/
?>