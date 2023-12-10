<?php

    $json = file_get_contents('php://input');
    $dados = json_decode($json);
    $pasta = '../../uploads/imoveis/'.$dados->pasta.'/';

    $fotos = [];

    if (file_exists($pasta)) {
        $arquivos = scandir($pasta);                 
        if ( $arquivos != false ) {
            foreach ( $arquivos as $arq ) {
                if ( $arq != '.' && $arq != '..') {       
                    $obj['name'] = $arq;
                    $obj['size'] = filesize($pasta.$arq);
                    array_push($fotos,$obj);
                }
            }
        }
    }
                
    header('Content-type: application/json');
    echo json_encode($fotos);