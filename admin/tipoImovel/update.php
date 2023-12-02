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
            array_push($erros,'Id do Tipo de Imóvel faltando');
        }




        if (isset($_POST['txtTipo']) and !empty($_POST['txtTipo'])) {

            $txtTipo = strip_tags($_POST['txtTipo']);
            $txtTipo = filter_var($txtTipo,FILTER_SANITIZE_SPECIAL_CHARS);

        } else {
            array_push($erros,'Preencha o campo TIPO DE IMÓVEL!');
        }


        /* Upload *******************/
        $iconeEnviado = $_FILES['txtIcone']['error'];
        // echo $iconeEnviado;
        // exit();
        if ($iconeEnviado == UPLOAD_ERR_OK) {
            $tipoArquivo = $_FILES['txtIcone']['type'];

            if ($tipoArquivo == 'image/png') {
        
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime_type = finfo_file($finfo,$_FILES['txtIcone']['tmp_name']);
                finfo_close($finfo);
        
                if (strpos($mime_type,'image') !== false ) {
        
        
                    $tamanho = $_FILES['txtIcone']['size'];
        
                    if ($tamanho <= (1024*1024)) {
        
                        $extensao = pathinfo($_FILES['txtIcone']['name'],PATHINFO_EXTENSION);
                        $pasta = '../../uploads/icones/';
                        $nomeArquivoIcone = uniqid().'.'.$extensao;
        
                        if ($_FILES['txtIcone']['error'] == UPLOAD_ERR_OK) {

                            move_uploaded_file($_FILES['txtIcone']['tmp_name'],$pasta.$nomeArquivoIcone);
                            
                            $select = $pdo->prepare('SELECT * FROM tipo_imovel WHERE id=:pId');
                            $select->bindValue(':pId',$txtId);
                            $select->execute();
                            $tipoImovel = $select->fetch();
                            @unlink('../../uploads/icones/'.$tipoImovel->icone);
        
                        } else {
                            array_push($erros,'Erro ao enviar o arquivo para o servidor!');
                        }
        
        
                    } else {
                        array_push($erros,'O arquivo deve ter no máximo 1MB!');
                    }
        
                
                } else {
                    array_push($erros,'Tipo de arquivo inválido!');
                }
                
            } else {
                
                array_push($erros,'Extensão do arquivo não permitida!');
        
            }
        } 
        /* FIM Upload ***************/
        

        if (count($erros) == 0) {

            try {
                
                if ($iconeEnviado == UPLOAD_ERR_OK) {
                    $update = $pdo->prepare('UPDATE tipo_imovel SET nome=:pTipo, icone=:pIcone WHERE id=:pId');
                    $update->bindValue(':pTipo',$txtTipo);
                    $update->bindValue(':pIcone',$nomeArquivoIcone);
                    $update->bindValue(':pId',$txtId);
                } else {
                    $update = $pdo->prepare('UPDATE tipo_imovel SET nome=:pTipo WHERE id=:pId');
                    $update->bindValue(':pTipo',$txtTipo);
                    $update->bindValue(':pId',$txtId);
                }
                
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
    <title>Editar Tipo de Imóvel</title>

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