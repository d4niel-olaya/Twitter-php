<?php
session_start();
if(isset($_REQUEST['out'])){
    session_destroy();
    header('Location:usuarioslogin.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo 'Bienvenido  ';
    if(isset($_SESSION['usuario'])){
        echo $_SESSION['usuario'];
    }
    ?>
    <form action="../Controlador/usuariosControlador.php" method="post">
        <label for="tweet">Escribe tu tweet</label>
        <br>
        <textarea name="tweet" id="tweet" cols="30" rows="10"></textarea>
        <button>Enviar</button>
    </form>
    <a href="logout.php">Salir de la session</a>
    <a href="tweets.php">Ver tus tweets</a>
</body>
</html>