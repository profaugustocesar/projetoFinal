<?php
    require_once '../login/verificarSessao.php';
    verificarNivelAcesso(3);
    require_once '../../core/conexao.php';

    $erros = array();

    if (isset($_GET['id']) and !empty($_GET['id'])) {

        try {
            
            $select = $pdo->prepare('SELECT * FROM imovel WHERE id = :pId');
            $id = filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
            $select->bindValue(':pId',$id);

            $select->execute();

            if ($select->rowCount() > 0) {
                $imovel = $select->fetch();
            } else {
                array_push($erros,'Imóvel não encontrado');
            }


        } catch (PDOException $e) {
            array_push($erros,'Erro ao buscar os dados do Imóvel no Banco de Dados: '.$e->getMessage());
        }

    } else {
        array_push($erros,'Imóvel não encontrado');
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Imóvel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    <style>
        .dropzone .dz-preview.dz-image-preview {
            background: none !important;
            border: none !important;
        }
    </style>
</head>

<body>

    <?php require_once '../php/header.php'; ?>


    <main class="col-11 col-md-11 col-lg-10 m-auto bg-secondary-subtle mt-5 p-3 rounded mb-5">

        <section class="mb-4">

            <h3>Editar Imóvel <a href="index.php" class="btn btn-sm btn-secondary">&larr; Voltar</a></h3>
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

            <form action="update.php" method="post" class="row">

                <div class="mb-3 mt-3 col-12 col-md-12 col-lg-12">
                    <div id="fotosUploader" class="dropzone"></div>
                </div>
                
                <input type="hidden" id="txtId" name="txtId" value="<?php echo $imovel->id; ?>">
                <input type="hidden" id="txtPasta" name="txtPasta" value="<?php echo $imovel->pasta; ?>">

                <div class="mb-3 col-12 col-md-6 col-lg-4">
                    <label for="txtReferencia" class="form-label">Referência</label>
                    <input type="text" class="form-control" id="txtReferencia" name="txtReferencia" value="<?php echo $imovel->referencia; ?>">
                </div>


                <div class="mb-3 col-12 col-md-6 col-lg-4">
                    <label for="txtEndereco" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="txtEndereco" name="txtEndereco" value="<?php echo $imovel->endereco; ?>">
                </div>

                
                <div class="mb-3 col-12 col-md-6 col-lg-4">
                    <label for="txtBairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="txtBairro" name="txtBairro" value="<?php echo $imovel->bairro; ?>">
                </div>
                

                <div class="mb-3 col-12 col-md-6 col-lg-4">
                    <label for="txtCidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="txtCidade" name="txtCidade" value="<?php echo $imovel->cidade; ?>">
                </div>


                <div class="mb-3 col-12 col-md-6 col-lg-4">
                    <label for="txtUf" class="form-label">UF</label>
                    <input type="text" class="form-control" id="txtUf" name="txtUf" value="<?php echo $imovel->uf; ?>">
                </div>


                <div class="mb-3 col-12 col-md-6 col-lg-4">
                    <label for="txtValor" class="form-label">Valor</label>
                    <input type="text" class="form-control" id="txtValor" name="txtValor" data-mask="000.000.000.000,00" data-mask-reverse="true" value="<?php echo $imovel->valor; ?>">
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
                        <option value="">Selecione o Corretor</option>

                        <?php foreach ($corretores as $corretor) { ?>
                            <option <?php if ($imovel->idCorretor == $corretor->id) { echo 'selected'; } ?> value="<?php echo $corretor->id; ?>"><?php echo $corretor->nome; ?></option>
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
                        <option value="">Selecione o Tipo do Imóvel</option>

                        <?php foreach ($tiposImoveis as $tipo) { ?>
                            <option <?php if ($imovel->idTipo == $tipo->id) { echo 'selected'; } ?> value="<?php echo $tipo->id; ?>"><?php echo $tipo->nome; ?></option>
                        <?php } ?>
                    </select>
                </div>


                <div class="mb-3 col-12 col-md-6 col-lg-4">
                    <label for="txtLatitude" class="form-label">Latitude</label>
                    <input type="text" class="form-control" id="txtLatitude" name="txtLatitude" value="<?php echo $imovel->latitude; ?>">
                </div>


                <div class="mb-3 col-12 col-md-6 col-lg-4">
                    <label for="txtLongitude" class="form-label">Longitude</label>
                    <input type="text" class="form-control" id="txtLongitude" name="txtLongitude" value="<?php echo $imovel->longitude; ?>">
                </div>


                <div class="mb-3 col-12 col-md-6 col-lg-4">
                    <label for="txtDetalhes" class="form-label">Detalhes</label>
                    <textarea class="form-control" name="txtDetalhes" id="txtDetalhes" rows="3"><?php echo $imovel->detalhes; ?></textarea>
                </div>


                <div class="mb-3 col-12">
                    <button class="btn btn-primary mt-3 w-100">Salvar</button>
                </div>
            </form>

        <?php } ?>

    </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/jquery.mask.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
        const pasta = document.getElementById('txtPasta').value;

        Dropzone.options.fotosUploader = {
            paramName: "foto",
            maxFilesize: 2,
            url: "upload.php",
            params: {pasta: pasta},
            acceptedFiles: "image/*",
            addRemoveLinks: true,
            dictCancelUpload: "Cancelar Envio",
            dictCancelUploadConfirmation: "Tem certeza que deseja cancelar?",
            dictRemoveFile: "Deletar Foto",
            dictDefaultMessage: "Clique ou solte fotos do imóvel aqui para enviar",
            init: function() {

                let meuDropzone = this;
                fetch('listaFotos.php', { 
                    method: 'POST', 
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({pasta: pasta}),
                })
                .then((fotos) => {
                    return fotos.json();
                })
                .then((fotos) => {
                    fotos.map((foto) => {
                        var arquivo = { name: foto.name, size: foto.size };
                        meuDropzone.displayExistingFile(arquivo, '../../uploads/imoveis/'+pasta+'/'+foto.name);
                        
                        const linksDeletar = document.getElementsByClassName('dz-remove');
                        
                        for (var i = 0; i < linksDeletar.length; i++) {
                            linksDeletar[i].addEventListener('click',() => {
                                document.getElementById('fotosUploader').classList.add('dz-started');
                                const linksDeletarRestantes = document.getElementsByClassName('dz-remove');
                                if (linksDeletarRestantes.length == 0) {
                                    document.getElementById('fotosUploader').classList.remove('dz-started');
                                }
                            });
                        }
                    
                    });
                });

                this.on("removedfile", file => {

                    let dados;
                    let foto;

                    if (file.hasOwnProperty('xhr')) {
                        dados = JSON.parse(file.xhr.response);
                        foto = {foto: dados.upload.pasta + dados.upload.arquivo};
                    } else {
                        foto = {foto: file.dataURL};
                    }
                    
                    fetch('deleteFoto.php', { 
                        method: 'POST', 
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify(foto),
                    });
                });
            }
        };
    </script>
</body>

</html>