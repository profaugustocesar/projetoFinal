<?php
    
    require_once '../login/verificarSessao.php';
    verificarNivelAcesso(3);
    require_once '../../core/conexao.php';

    if (isset($_GET['buscaImovel'])) {
        $sql = $pdo->prepare('SELECT imovel.*, tipo_imovel.nome AS tipoImovel FROM imovel INNER JOIN tipo_imovel ON imovel.idTipo = tipo_imovel.id WHERE (referencia LIKE :pBusca) OR (bairro LIKE :pBusca) OR (cidade LIKE :pBusca) ORDER BY id DESC');
        $sql->bindValue(':pBusca','%'.$_GET['buscaImovel'].'%');
    } else {
        $sql = $pdo->prepare('SELECT imovel.*, tipo_imovel.nome AS tipoImovel FROM imovel INNER JOIN tipo_imovel ON imovel.idTipo = tipo_imovel.id ORDER BY id DESC');
    }


    $sql->execute();
    $imoveis = $sql->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imóveis</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <?php require_once '../php/header.php'; ?>


    <main class="col-11 col-md-10 col-lg-9 m-auto bg-secondary-subtle mt-5 p-3 rounded">

        <section class="mb-4">
            
            <h3>Imóveis <a href="formCadastro.php" class="btn btn-sm btn-primary">Novo Imóvel</a></h3>
            <hr>
        
            <form action="index.php" method="get">

                <?php

                    if (isset($_GET['buscaImovel'])) {
                        $busca = filter_var($_GET['buscaImovel'],FILTER_SANITIZE_SPECIAL_CHARS);
                    } else {
                        $busca = '';
                    }

                ?>

                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" name="buscaImovel" placeholder="Buscar Imóvel" value="<?php echo $busca; ?>">
                    </div>
                    <div class="col">
                        <button class="btn btn-secondary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>
        </section>

        <a href="mapa.php" class="btn btn-sm btn-outline-secondary mb-3">Ver no mapa</a>
        <table class="table table-striped table-hover">

            <thead>
                <tr>
                    <th>Referência</th>
                    <th>Bairro / Cidade</th>
                    <th>Tipo de Imóvel</th>
                    <th>UF</th>
                    <th>Operações</th>
                </tr>
            </thead>

            <tbody>
                
                <?php foreach ($imoveis as $imovel) { ?>
                    <tr>
                        <td><?php echo $imovel->referencia; ?></td>
                        <td><?php echo $imovel->bairro; ?> / <?php echo $imovel->cidade; ?></td>
                        <td><?php echo $imovel->tipoImovel; ?></td>
                        <td><?php echo $imovel->uf; ?></td>
                        <td>
                            <a href="formEdicao.php?id=<?php echo $imovel->id; ?>" class="btn btn-secondary btn-sm">Editar</a>
                            <a href="delete.php?id=<?php echo $imovel->id; ?>" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
                
            </tbody>

        </table>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>