<?php

    date_default_timezone_set('America/Sao_Paulo');

    $servidor = 'localhost';
    $bancoDados = 'projeto';
    $usuario = 'root';
    $senha = '';

    try {
     
        $pdo = new PDO("mysql:host=$servidor;dbname=$bancoDados",$usuario,$senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

    } catch (PDOException $erro) {
       
        echo 'Erro ao conectar ao Banco de Dados: '.$erro->getMessage();
        
    }