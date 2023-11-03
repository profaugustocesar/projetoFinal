   
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Imobiliária</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../inicial/index.php">Inicial</a>
                        </li>

                        <?php if ($_SESSION['sessao_nivelAcesso'] == 3) { ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="../usuario/index.php">Usuários</a>
                            </li>
                        <?php } ?>

                        <?php if (($_SESSION['sessao_nivelAcesso'] == 2) or ($_SESSION['sessao_nivelAcesso'] == 3)) { ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="../corretor/index.php">Corretores</a>
                            </li>
                        <?php } ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Imóveis
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../tipoImovel/index.php">Tipos de Imóveis</a></li>
                                <li><a class="dropdown-item" href="../imovel/index.php">Lista de Imóveis</a></li>
                            </ul>
                        </li>
                    </ul>
                    
                    
                    <div>
                        Usuário: <strong><?php echo $_SESSION['sessao_nome'] ;?></strong> | <a href="../login/deslogar.php">Sair</a>
                    </div>

                </div>
            </div>
        </nav>
    </header>