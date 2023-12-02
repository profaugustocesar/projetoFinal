<?php
    
    require_once '../login/verificarSessao.php';
    verificarNivelAcesso(3);
    require_once '../../core/conexao.php';

    if (isset($_GET['buscaCorretor'])) {
        $sql = $pdo->prepare('SELECT * FROM corretor WHERE nome LIKE :pNome');
        $sql->bindValue(':pNome','%'.$_GET['buscaCorretor'].'%');
    } else {
        $sql = $pdo->prepare('SELECT * FROM corretor');
    }


    $sql->execute();
    $corretores = $sql->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corretor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <?php require_once '../php/header.php'; ?>


    <main class="col-11 col-md-10 col-lg-9 m-auto bg-secondary-subtle mt-5 p-3 rounded">

        <section class="mb-4">
            
            <h3>Corretores <a href="formCadastro.php" class="btn btn-sm btn-primary">Novo Corretor</a></h3>
            <hr>
        
            <form action="index.php" method="get">

                <?php

                    if (isset($_GET['buscaCorretor'])) {
                        $busca = filter_var($_GET['buscaCorretor'],FILTER_SANITIZE_SPECIAL_CHARS);
                    } else {
                        $busca = '';
                    }

                ?>

                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" name="buscaCorretor" placeholder="Buscar Corretor" value="<?php echo $busca; ?>">
                    </div>
                    <div class="col">
                        <button class="btn btn-secondary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>
        </section>


        <table class="table table-striped table-hover">

            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Nome</th>
                    <th>CRECI</th>
                    <th>Telefone</th>
                    <th>Operações</th>
                </tr>
            </thead>

            <tbody>
                
                <?php foreach ($corretores as $corretor) { ?>
                    <tr>
                        <td><?php echo $corretor->id; ?></td>
                        <td><?php echo $corretor->nome; ?></td>
                        <td><?php echo $corretor->creci; ?></td>
                        <td><?php echo $corretor->telefone; ?></td>
                        <td>
                            <a href="formEdicao.php?id=<?php echo $corretor->id; ?>" class="btn btn-secondary btn-sm">Editar</a>
                            <a href="delete.php?id=<?php echo $corretor->id; ?>" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
                
            </tbody>

        </table>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>