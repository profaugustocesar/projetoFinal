<?php

    require_once '../login/verificarSessao.php';
    verificarNivelAcesso(3);
    require_once '../../core/conexao.php';

    $erros = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        if (isset($_POST['txtNome']) and !empty($_POST['txtNome'])) {

            $txtNome = strip_tags($_POST['txtNome']);
            $txtNome = filter_var($txtNome,FILTER_SANITIZE_SPECIAL_CHARS);

            if (mb_strlen($txtNome) < 3) {
                array_push($erros,'O Nome não pode ser menor que 3 caracteres!');
            }

        } else {
            array_push($erros,'Preencha o campo NOME!');
        }



        if (isset($_POST['txtEmail']) and !empty($_POST['txtEmail'])) {

            $txtEmail = strip_tags($_POST['txtEmail']);
            $txtEmail = filter_var($txtEmail,FILTER_SANITIZE_EMAIL);

            if (!filter_var($txtEmail,FILTER_VALIDATE_EMAIL)) {
                array_push($erros,'E-MAIL inválido!');
            }

            $select = $pdo->prepare('SELECT * FROM usuario WHERE email = :pEmail');
            $select->bindValue(':pEmail',$txtEmail);
            $select->execute();
            
            if ($select->rowCount() > 0) {
                array_push($erros,'Já existe um cadastro com o e-mail: '.$txtEmail);
            }

        } else {
            array_push($erros,'Preencha o campo E-MAIL!');
        }



        if (isset($_POST['txtSenha']) and !empty($_POST['txtSenha'])) {

            $txtSenha = filter_var($_POST['txtSenha'],FILTER_SANITIZE_SPECIAL_CHARS);

            if (mb_strlen($txtSenha) < 6) {
                array_push($erros,'A senha não pode ser menor que 6 caracteres!');
            } else {
                $salt = uniqid();
                $txtSenha = password_hash($txtSenha.$salt,PASSWORD_DEFAULT);
            }

        } else {
            array_push($erros,'Preencha o campo SENHA!');
        }



        if (isset($_POST['txtNivelAcesso']) and !empty($_POST['txtNivelAcesso'])) {

            $txtNivelAcesso = strip_tags($_POST['txtNivelAcesso']);
            $txtNivelAcesso = filter_var($txtNivelAcesso,FILTER_SANITIZE_NUMBER_INT);
            
        } else {
            array_push($erros,'Preencha o campo NÍVEL DE ACESSO!');
        }




        if (count($erros) == 0) {

            try {
                
                $insert = $pdo->prepare('INSERT INTO usuario(nome, email, senha, salt, nivelAcesso) VALUES (:pNome, :pEmail, :pSenha, :pSalt, :pNivelAcesso)');
                $insert->bindValue(':pNome',$txtNome);
                $insert->bindValue(':pEmail',$txtEmail);
                $insert->bindValue(':pSenha',$txtSenha);
                $insert->bindValue(':pSalt',$salt);
                $insert->bindValue(':pNivelAcesso',$txtNivelAcesso);
                
                if ($insert->execute()) {
                    header('Location:index.php');
                }

            } catch (PDOException $e) {
                array_push($erros,'Erro ao inserir os dados no Banco de Dados: '.$e->getMessage());
            }

        }



    } else {
        array_push($erros,'Requisição Inválida!');
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salvar Usuário</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body class="d-flex justify-content-center">

    <div class="col-6 my-5 bg-body-secondary rounded text-danger p-3">
        <h5>Erro:</h5>
        <hr>

        <?php foreach ($erros as $erro) { ?>

            <p>- <?php echo $erro; ?></p>

        <?php } ?>

        <a href="javascript:history.back();"><< Voltar para a tela de cadastro</a>
        
    </div>

</body>
</html>