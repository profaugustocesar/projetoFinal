<?php
    require_once '../login/verificarSessao.php';
    verificarNivelAcesso(3);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <?php require_once '../php/header.php'; ?>


    <main class="col-11 col-md-9 col-lg-6 m-auto bg-secondary-subtle mt-5 p-3 rounded">

        <section class="mb-4">

            <h3>Cadastro de Usuário <a href="index.php" class="btn btn-sm btn-secondary">&larr; Voltar</a></h3>
            <hr>

        </section>


        <form action="insert.php" method="post">
            <div class="mb-3">
                <label for="txtNome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="txtNome" name="txtNome">
            </div>


            <div class="mb-3">
                <label for="txtEmail" class="form-label">E-mail</label>
                <input type="text" class="form-control" id="txtEmail" name="txtEmail">
            </div>


            <div class="mb-3">
                <label for="txtSenha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="txtSenha" name="txtSenha">
            </div>


            <div class="mb-3">
                <label for="txtNivelAcesso" class="form-label">Nível de Acesso</label>
                <select class="form-select" id="txtNivelAcesso" name="txtNivelAcesso">
                    <option value="1">Corretor</option>
                    <option value="2">Gerente</option>
                    <option value="3">Administrador</option>
                </select>
            </div>

            <button class="btn btn-primary mt-3">Salvar</button>
        </form>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>