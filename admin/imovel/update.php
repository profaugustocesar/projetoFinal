<?php

    require_once '../login/verificarSessao.php';
    verificarNivelAcesso(3);
    require_once '../../core/conexao.php';

    $erros = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        
        if (isset($_POST['txtId']) and !empty($_POST['txtId'])) {

            $txtId = strip_tags($_POST['txtId']);
            $txtId = filter_var($txtId,FILTER_SANITIZE_NUMBER_INT);

        } else {
            array_push($erros,'Id do imóvel faltando');
        }



        if (isset($_POST['txtReferencia']) and !empty($_POST['txtReferencia'])) {

            $txtReferencia = strip_tags($_POST['txtReferencia']);
            $txtReferencia = filter_var($txtReferencia,FILTER_SANITIZE_SPECIAL_CHARS);

        } else {
            array_push($erros,'Preencha o campo REFERÊNCIA!');
        }



        if (isset($_POST['txtEndereco']) and !empty($_POST['txtEndereco'])) {

            $txtEndereco = strip_tags($_POST['txtEndereco']);
            $txtEndereco = filter_var($txtEndereco,FILTER_SANITIZE_SPECIAL_CHARS);

        } else {
            array_push($erros,'Preencha o campo ENDEREÇO!');
        }



        if (isset($_POST['txtBairro']) and !empty($_POST['txtBairro'])) {

            $txtBairro = strip_tags($_POST['txtBairro']);
            $txtBairro = filter_var($txtBairro,FILTER_SANITIZE_SPECIAL_CHARS);

        } else {
            array_push($erros,'Preencha o campo BAIRRO!');
        }



        if (isset($_POST['txtCidade']) and !empty($_POST['txtCidade'])) {

            $txtCidade = strip_tags($_POST['txtCidade']);
            $txtCidade = filter_var($txtCidade,FILTER_SANITIZE_SPECIAL_CHARS);

        } else {
            array_push($erros,'Preencha o campo CIDADE!');
        }



        if (isset($_POST['txtUf']) and !empty($_POST['txtUf'])) {

            $txtUf = strip_tags($_POST['txtUf']);
            $txtUf = filter_var($txtUf,FILTER_SANITIZE_SPECIAL_CHARS);

        } else {
            array_push($erros,'Preencha o campo UF!');
        }



        if (isset($_POST['txtValor']) and !empty($_POST['txtValor'])) {

            $txtValor = strip_tags($_POST['txtValor']);
            $txtValor = filter_var($txtValor,FILTER_SANITIZE_SPECIAL_CHARS);
            $txtValor = str_replace('.','',$txtValor);
            $txtValor = str_replace(',','.',$txtValor);

        } else {
            array_push($erros,'Preencha o campo VALOR!');
        }



        if (isset($_POST['txtIdCorretor']) and !empty($_POST['txtIdCorretor'])) {

            $txtIdCorretor = strip_tags($_POST['txtIdCorretor']);
            $txtIdCorretor = filter_var($txtIdCorretor,FILTER_SANITIZE_SPECIAL_CHARS);

        } else {
            array_push($erros,'Preencha o campo CORRETOR!');
        }



        if (isset($_POST['txtIdTipo']) and !empty($_POST['txtIdTipo'])) {

            $txtIdTipo = strip_tags($_POST['txtIdTipo']);
            $txtIdTipo = filter_var($txtIdTipo,FILTER_SANITIZE_SPECIAL_CHARS);

        } else {
            array_push($erros,'Preencha o campo TIPO DE IMÓVEL!');
        }



        if (isset($_POST['txtLatitude']) and !empty($_POST['txtLatitude'])) {

            $txtLatitude = strip_tags($_POST['txtLatitude']);
            $txtLatitude = filter_var($txtLatitude,FILTER_SANITIZE_SPECIAL_CHARS);

        } else {
            array_push($erros,'Preencha o campo LATITUDE!');
        }



        if (isset($_POST['txtLongitude']) and !empty($_POST['txtLongitude'])) {

            $txtLongitude = strip_tags($_POST['txtLongitude']);
            $txtLongitude = filter_var($txtLongitude,FILTER_SANITIZE_SPECIAL_CHARS);

        } else {
            array_push($erros,'Preencha o campo LONGITUDE!');
        }
        
        
        
        if (isset($_POST['txtDetalhes']) and !empty($_POST['txtDetalhes'])) {

            $txtDetalhes = strip_tags($_POST['txtDetalhes']);
            $txtDetalhes = filter_var($txtDetalhes,FILTER_SANITIZE_SPECIAL_CHARS);

        } else {
            array_push($erros,'Preencha o campo DETALHES!');
        }



       

        if (count($erros) == 0) {

            try {
                
                $update = $pdo->prepare('UPDATE imovel SET referencia=:referencia, endereco=:endereco, bairro=:bairro, 
                cidade=:cidade, uf=:uf, valor=:valor, idCorretor=:idCorretor, detalhes=:detalhes, latitude=:latitude, longitude=:longitude, 
                idTipo=:idTipo WHERE id=:id');
                $update->bindValue(':referencia',$txtReferencia);
                $update->bindValue(':endereco',$txtEndereco);
                $update->bindValue(':bairro',$txtBairro);
                $update->bindValue(':cidade',$txtCidade);
                $update->bindValue(':uf',$txtUf);
                $update->bindValue(':valor',$txtValor);
                $update->bindValue(':idCorretor',$txtIdCorretor);
                $update->bindValue(':detalhes',$txtDetalhes);
                $update->bindValue(':latitude',$txtLatitude);
                $update->bindValue(':longitude',$txtLongitude);
                $update->bindValue(':idTipo',$txtIdTipo);
                $update->bindValue(':id',$txtId);
                
                if ($update->execute()) {
                    header('Location:index.php');
                }

            } catch (PDOException $e) {
                array_push($erros,'Erro ao atualizar os dados no Banco de Dados: '.$e->getMessage());
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
    <title>Editar Imóvel</title>

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