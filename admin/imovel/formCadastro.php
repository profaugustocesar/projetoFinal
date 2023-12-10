<?php
    require_once '../login/verificarSessao.php';
    verificarNivelAcesso(3);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Imóvel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <?php require_once '../php/header.php'; ?>


    <main class="col-11 col-md-11 col-lg-10 m-auto bg-secondary-subtle mt-5 p-3 rounded mb-5">

        <section class="mb-4">

            <h3>Cadastro de Imóvel <a href="index.php" class="btn btn-sm btn-secondary">&larr; Voltar</a></h3>
            <hr>

        </section>


            <form action="insert.php" method="post" class="row">
                
                <div class="mb-3 col-12 col-md-6 col-lg-4">
                    <label for="txtReferencia" class="form-label">Referência</label>
                    <input type="text" class="form-control" id="txtReferencia" name="txtReferencia">
                </div>


                <div class="mb-3 col-12 col-md-6 col-lg-4">
                    <label for="txtEndereco" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="txtEndereco" name="txtEndereco">
                </div>

                
                <div class="mb-3 col-12 col-md-6 col-lg-4">
                    <label for="txtBairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="txtBairro" name="txtBairro">
                </div>
                

                <div class="mb-3 col-12 col-md-6 col-lg-4">
                    <label for="txtCidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="txtCidade" name="txtCidade">
                </div>


                <div class="mb-3 col-12 col-md-6 col-lg-4">
                    <label for="txtUf" class="form-label">UF</label>
                    <input type="text" class="form-control" id="txtUf" name="txtUf">
                </div>


                <div class="mb-3 col-12 col-md-6 col-lg-4">
                    <label for="txtValor" class="form-label">Valor</label>
                    <input type="text" class="form-control" id="txtValor" name="txtValor" data-mask="000.000.000.000,00" data-mask-reverse="true">
                </div>


                <div class="mb-3 col-12 col-md-6 col-lg-4">
                    <label for="txtIdCorretor" class="form-label">Corretor</label>

                    <?php
                        require_once '../../core/conexao.php';

                        $selectCorretor = $pdo->prepare('SELECT id, nome FROM corretor ORDER BY nome ASC');
                        $selectCorretor->execute();
                        $corretores = $selectCorretor->fetchAll();
                    ?>
                    <select name="txtIdCorretor" id="txtIdCorretor" class="form-select">
                        <option>Selecione o Corretor</option>

                        <?php foreach ($corretores as $corretor) { ?>
                            <option value="<?php echo $corretor->id; ?>"><?php echo $corretor->nome; ?></option>
                        <?php } ?>
                    </select>
                </div>


                <div class="mb-3 col-12 col-md-6 col-lg-4">
                    <label for="txtIdTipo" class="form-label">Tipo do Imóvel</label>

                    <?php
                        $selectTipoImovel = $pdo->prepare('SELECT id, nome FROM tipo_imovel ORDER BY nome ASC');
                        $selectTipoImovel->execute();
                        $tiposImoveis = $selectTipoImovel->fetchAll();
                    ?>
                    <select name="txtIdTipo" id="txtIdTipo" class="form-select">
                        <option>Selecione o Tipo do Imóvel</option>

                        <?php foreach ($tiposImoveis as $tipo) { ?>
                            <option value="<?php echo $tipo->id; ?>"><?php echo $tipo->nome; ?></option>
                        <?php } ?>
                    </select>
                </div>


                <div class="mb-3 col-12 col-md-6 col-lg-4">
                    <label for="txtLatitude" class="form-label">Latitude</label>
                    <input type="text" class="form-control" id="txtLatitude" name="txtLatitude">
                </div>


                <div class="mb-3 col-12 col-md-6 col-lg-4">
                    <label for="txtLongitude" class="form-label">Longitude</label>
                    <input type="text" class="form-control" id="txtLongitude" name="txtLongitude">
                </div>


                <div class="mb-3 col-12 col-md-6 col-lg-4">
                    <label for="txtDetalhes" class="form-label">Detalhes</label>
                    <textarea class="form-control" name="txtDetalhes" id="txtDetalhes" rows="3"></textarea>
                </div>


                <div class="mb-3 col-12">
                    <button class="btn btn-primary mt-3 w-100">Salvar</button>
                </div>
            </form>

    </main>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/jquery.mask.min.js"></script>
</body>

</html>