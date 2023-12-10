<?php
        
        /* Upload *******************/
        $resp = '';
        $tipoArquivo = $_FILES['foto']['type'];
        $pasta = '../../uploads/imoveis/'.$_POST['pasta'].'/';

        header('Content-type: application/json');

        if ( ($tipoArquivo == 'image/png') or ($tipoArquivo == 'image/jpeg') ) {

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($finfo,$_FILES['foto']['tmp_name']);
            finfo_close($finfo);

            if (strpos($mime_type,'image') !== false ) {

                $tamanho = $_FILES['foto']['size'];

                if ($tamanho <= (1024*1024)) {

                    $extensao = pathinfo($_FILES['foto']['name'],PATHINFO_EXTENSION);
                    $nomeArquivoFoto = uniqid().'.'.$extensao;

                    if ($_FILES['foto']['error'] == UPLOAD_ERR_OK) {

                        if (!file_exists($pasta)) {
                            mkdir($pasta);
                        }
                        move_uploaded_file($_FILES['foto']['tmp_name'],$pasta.$nomeArquivoFoto); 
                        
                        $resp = [
                            "upload" => [
                                "status" => "OK",
                                "pasta" => "$pasta",
                                "arquivo" => "$nomeArquivoFoto",
                            ],
                        ];

                    } else {
                        $resp = [
                            "upload" => [
                                "status" => "ERRO",
                                "mensagem" => "Erro ao enviar o arquivo para o servidor!",
                            ],
                        ];
                    }


                } else {
                    $resp = [
                        "upload" => [
                            "status" => "ERRO",
                            "mensagem" => "O arquivo deve ter no máximo 1MB!",
                        ],
                    ];
                }

            
            } else {
                $resp = [
                    "upload" => [
                        "status" => "ERRO",
                        "mensagem" => "Tipo de arquivo inválido!",
                    ],
                ];
            }
            
        } else {
            $resp = [
                "upload" => [
                    "status" => "ERRO",
                    "mensagem" => "Extensão do arquivo não permitida!",
                ],
            ];
        }


        echo json_encode($resp);

        /* FIM Upload ***************/

    