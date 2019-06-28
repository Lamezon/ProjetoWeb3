<!DOCTYPE html>
<html>
<head>
    <title><?= APLICACAO_NOME ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= URL_CSS . 'bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= URL_CSS . 'geral.css' ?>"
    <script src="<?= URL_JS . 'jquery-3.1.1.min.js' ?>"></script>
    <script src="<?= URL_JS . 'bootstrap.min.js' ?>"></script>
</head>
<body>


<?php $this->imprimirConteudo() ?>
<style>
    body{
        color: white;

        background-image: linear-gradient(#2a5d84, green);
        background-repeat: no-repeat;
        background-size: 2000px 1000px;
    }
    a{
        color: white;
    }
    a:hover{
        color: yellow;
    }
    .control-label:hover{
        color: yellow;
    }
    form{
        color: white;
    }
    .campo-grande{
        background-color: lightgoldenrodyellow;
    }
    .campo-medio{
        background-color: lightgreen;
    }


</style>
</body>
</html>
