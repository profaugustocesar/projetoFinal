<?php

    require_once '../login/verificarSessao.php';
    verificarNivelAcesso(1);

    require_once '../../core/conexao.php';

    if (isset($_GET['buscaImovel']) and ($_GET['buscaImovel'] != 'null')) {
        $select = $pdo->prepare('SELECT imovel.*, imovel.id as idImovel, tipo_imovel.* FROM imovel INNER JOIN tipo_imovel ON imovel.idTipo = tipo_imovel.id WHERE (referencia LIKE :pBusca) OR (bairro LIKE :pBusca) OR (cidade LIKE :pBusca) ORDER BY imovel.id DESC');
        $select->bindValue(':pBusca','%'.$_GET['buscaImovel'].'%');
    } else {
        $select = $pdo->prepare('SELECT imovel.*, imovel.id as idImovel, tipo_imovel.* FROM imovel INNER JOIN tipo_imovel ON imovel.idTipo = tipo_imovel.id ORDER BY imovel.id DESC');
    }

    $select->execute();
    $listaDeImoveis = $select->fetchAll();

    echo json_encode($listaDeImoveis);