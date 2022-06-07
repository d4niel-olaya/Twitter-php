<?php
require_once('../Controlador/usuariosControlador.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        div{
            border:1px solid black;
            padding:5px;
            margin-top:10px;
        }
    </style>
</head>
<body>
    <h1>Tweets</h1>
    <?php
    if(isset($_SESSION['usuario']) && isset($_SESSION['clave'])){
        $objeto = new Operaciones($_SESSION['usuario'], $_SESSION['clave']);
        echo '<br>';
        $objeto ->publicaciones();
    }
    ?>
</body>
</html>