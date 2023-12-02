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



        if (isset($_POST['txtCreci']) and !empty($_POST['txtCreci'])) {

            $txtCreci = strip_tags($_POST['txtCreci']);
            $txtCreci = filter_var($txtCreci,FILTER_SANITIZE_SPECIAL_CHARS);

        } else {
            array_push($erros,'Preencha o campo CRECI!');
        }
        


        if (isset($_POST['txtTelefone']) and !empty($_POST['txtTelefone'])) {

            $txtTelefone = strip_tags($_POST['txtTelefone']);
            $txtTelefone = filter_var($txtTelefone,FILTER_SANITIZE_SPECIAL_CHARS);

        } else {
            array_push($erros,'Preencha o campo TELEFONE!');
        }




        if (count($erros) == 0) {

            try {
                
                $insert = $pdo->prepare('INSERT INTO corretor(nome, creci, telefone) VALUES (:pNome, :pCreci, :pTelefone)');
                $insert->bindValue(':pNome',$txtNome);
                $insert->bindValue(':pCreci',$txtCreci);
                $insert->bindValue(':pTelefone',$txtTelefone);
                
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
    <title>Salvar Corretor</title>

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