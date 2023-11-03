<?php

    session_start();

    if ( !isset($_SESSION['sessao_id']) ) {
        header('Location: ../login/');
    }


    function verificarNivelAcesso($nivel) {
        
        if ($_SESSION['sessao_nivelAcesso'] < $nivel) {
            header('Location: ../inicial/index.php');
        }

    } 