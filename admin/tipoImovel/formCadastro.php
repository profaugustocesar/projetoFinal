<?php
    require_once '../login/verificarSessao.php';
    verificarNivelAcesso(3);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Tipo de Imóvel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <?php require_once '../php/header.php'; ?>


    <main class="col-11 col-md-9 col-lg-6 m-auto bg-secondary-subtle mt-5 p-3 rounded">

        <section class="mb-4">

            <h3>Cadastro de Tipo de Imóvel <a href="index.php" class="btn btn-sm btn-secondary">&larr; Voltar</a></h3>
            <hr>

        </section>


        <form action="insert.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="txtTipo" class="form-label">Tipo de Imóvel</label>
                <input type="text" class="form-control" id="txtTipo" name="txtTipo">
            </div>


            <div class="mb-3">
                <label for="txtIcone" class="form-label">Ícone</label>
                <input type="file" class="form-control" id="txtIcone" name="txtIcone" accept="image/png">
            </div>

            
            <button class="btn btn-primary mt-3">Salvar</button>
        </form>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>