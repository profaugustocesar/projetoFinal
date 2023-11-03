<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

    <main class="col-9 col-md-6 col-lg-3 m-auto">
        <form action="logar.php" method="post">
            <h1 class="mt-5 mb-3">Login</h1>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="nome@exemplo.com.br" required>
                <label for="txtEmail">E-mail</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="txtSenha" name="txtSenha" placeholder="Senha" required>
                <label for="txtSenha">Senha</label>
            </div>
            
            <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Logar</button>
            
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2023</p>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>