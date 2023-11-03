<?php

    session_start();

    require_once '../../core/conexao.php';

    $erros = array();

    try {
        
        $select = $pdo->prepare('SELECT * FROM usuario WHERE email = :email');
        $select->bindValue(':email',$_POST['txtEmail']);
        $select->execute();
        $usuario = $select->fetch();

        $qtdUsuariosEncontrados = $select->rowCount();

        if ($qtdUsuariosEncontrados > 0) {

            $senhaCorreta = password_verify($_POST['txtSenha'].$usuario->salt, $usuario->senha);

            if ($senhaCorreta) {

                $_SESSION['sessao_id'] = $usuario->id;
                $_SESSION['sessao_nome'] = $usuario->nome;
                $_SESSION['sessao_nivelAcesso'] = $usuario->nivelAcesso;

                header('Location: ../inicial/');
            } else {
               array_push($erros,'Senha incorreta!'); 
            }

        } else {
            array_push($erros,'Nenhum usuário encontrado!');
            session_destroy();
        }


    } catch (PDOException $e) {
        array_push($erros,'Erro ao buscar dados do USUÁRIO no Banco de Dados: '.$e->getMessage());
        session_destroy();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logando no Sistema...</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body class="d-flex justify-content-center">

    <div class="col-6 my-5 bg-body-secondary rounded text-danger p-3">
        <h5>Erro:</h5>
        <hr>

        <?php foreach ($erros as $erro) { ?>

            <p>- <?php echo $erro; ?></p>

        <?php } ?>

        <a href="javascript:history.back();"><< Voltar para a tela de Login</a>
        
    </div>

</body>
</html>