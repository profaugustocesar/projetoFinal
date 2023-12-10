<?php

    $json = file_get_contents('php://input');
    $dados = json_decode($json);
    $caminhoCompletoDaFoto = '../../uploads/imoveis/'.$dados->foto;

    header('Content-type: application/json');

    if (file_exists($caminhoCompletoDaFoto)) {
        if (unlink($caminhoCompletoDaFoto)) {
            $resp = ['status'=>'Foto excluída!'];            
        } else {
            $resp = ['status'=>'Erro ao excluir a foto!'];
        }
    } else {
        $resp = ['status'=>'Foto não encontrada no servidor!'];
    }

    echo json_encode($resp);