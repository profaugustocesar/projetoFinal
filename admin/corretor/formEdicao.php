<?php

    require_once '../login/verificarSessao.php';
    verificarNivelAcesso(3);
    require_once '../../core/conexao.php';

    $erros = array();

    if (isset($_GET['id']) and !empty($_GET['id'])) {

        try {
            
            $select = $pdo->prepare('SELECT * FROM corretor WHERE id = :pId');
            $id = filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
            $select->bindValue(':pId',$id);

            $select->execute();

            if ($select->rowCount() > 0) {
                $corretor = $select->fetch();
            } else {
                array_push($erros,'Corretor não encontrado');
            }


        } catch (PDOException $e) {
            array_push($erros,'Erro ao buscar os dados do corretor no Banco de Dados: '.$e->getMessage());
        }

    } else {
        array_push($erros,'Corretor não encontrado');
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Corretor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <?php require_once '../php/header.php'; ?>


    <main class="col-11 col-md-9 col-lg-6 m-auto bg-secondary-subtle mt-5 p-3 rounded">

        <section class="mb-4">

            <h3>Editar Corretor <a href="index.php" class="btn btn-sm btn-secondary">&larr; Voltar</a></h3>
            <hr>

        </section>


        <?php if (count($erros) > 0) { ?>

            <div class="my-5 bg-body-secondary rounded text-danger p-3">
                <h5>Erro:</h5>
                <hr>

                <?php foreach ($erros as $erro) { ?>

                    <p>- <?php echo $erro; ?></p>

                <?php } ?>

                <a href="index.php"><< Voltar para a tela de listagem</a>
                
            </div>

        <?php } else { ?>


            <form action="update.php" method="post">

                <input type="hidden" name="txtId" value="<?php echo $corretor->id; ?>">

                <div class="mb-3">
                    <label for="txtNome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="txtNome" name="txtNome" value="<?php echo $corretor->nome; ?>">
                </div>


                <div class="mb-3">
                    <label for="txtCreci" class="form-label">CRECI</label>
                    <input type="text" class="form-control" id="txtCreci" name="txtCreci" value="<?php echo $corretor->creci; ?>">
                </div>


                <div class="mb-3">
                    <label for="txtTelefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="txtTelefone" name="txtTelefone" value="<?php echo $corretor->telefone; ?>" data-mask="(00) 00000-0000">
                </div>


                <button class="btn btn-primary mt-3">Salvar</button>
            </form>

        <?php } ?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/jquery.mask.min.js"></script>
</body>

</html>