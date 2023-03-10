<?php
require('config/conexao.php');

//1-AUTENTICAÇÃO DEO LOGIN
if(isset($_POST['email']) && isset($_POST['senha']) && !empty($_POST['email']) && !empty($_POST['senha'])){//SE EXISTE EMAIL E SENHA E NÃO SÃO VAZIOS:
    //TRATAMENTO DE SEGURANÇA- ATISQL INJECTION
    $email=limparPost($_POST['email']);
    $senha=limparPost($_POST['senha']);
    $senha_cript = sha1($senha);
    //VERIFICA SE EXISTE USUARIO NO BANCO DE DADOS ATRAVES DE PDO
    $sql=$pdo->prepare("SELECT * FROM usuarios WHERE email=? AND senha=? LIMIT 1");
    $sql->execute(array($email,$senha_cript));
    //RECEBER DADOS DO BANCO COMO MATRIZ ASSOCIATIVA CHAVE:COLUNA
    $usuario=$sql->fetch(PDO::FETCH_ASSOC);
    if($usuario){//SE EXISTE USUARIO:
        //VERIFICAR SE O CADATRO FOI CONFIRMADO
        if($usuario['status']=='confirmado'){//SE O STATUS É CONFIRMADO:
            //CRIA TOKEN
            $token=sha1(uniqid().date('d-m-Y-H-i-s'));
            //ATUALIZA O TOKEN DO USUARIO NO BANCO - não estava acontecendo, pois o banco não aceitava UPDATE
            $sql=$pdo->prepare("UPDATE usuarios SET token=? WHERE email=? AND senha=?");
            if($sql->execute(array($token,$email,$senha_cript))){//SE O BANCO FOR ATUALIZADO
                //ARMAZENA O TOKEN NA SESSÃO (SESSION)
                $_SESSION['TOKEN']=$token;
                header('location: restrita.php');
            }
        }else{// SE O STATUS É NOVO:
            $erro_login = "Por favor, confirme seu cadastro no seu e-mail.";
        }

    }else{//SE NÃO EXISTE USUARIO:
        $erro_login = "Usuário ou senha incorretos!";
    }

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/estilo.css" rel="stylesheet">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <title>Login</title>
</head>
<body>
    <form method="post">
        <h1>Login</h1>

        <?php if(isset($erro_login)){ ?>
            <div class="erro-geral animate__animated animate__rubberBand">
            <?php  echo $erro_login; ?>
            </div>
        <?php } ?>

       <?php if (isset($_GET['result']) && ($_GET['result']=="ok")){ ?>
                <div class="sucesso animate__animated animate__rubberBand">
                Cadastrado com sucesso!
               </div>               
       <?php }?>
         

        <div class="input-group">
            <img class="input-icon" src="img/user.png">
            <input type="email" name="email" placeholder="Digite seu email" required>
        </div>
        
        <div class="input-group">
            <img class="input-icon" src="img/lock.png">
            <input type="password" name="senha" placeholder="Digite sua senha" required>
        </div>
        
        <button class="btn-blue" type="submit">Fazer Login</button>
        <a href="cadastrar.php">Ainda não tenho cadastro</a>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
    
    <?php if (isset($_GET['result']) && ($_GET['result']=="ok")){ ?>
    <script>
    setTimeout(() => {
           $('.sucesso').hide();            
     }, 3000);
    </script>
   <?php }?>

</body>
</html>