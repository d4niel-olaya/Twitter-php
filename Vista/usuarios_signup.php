<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h2{
            color:red;
        }
    </style>
</head>
<body>
    <form action="../Controlador/usuariosControlador.php" method="post">
        <h1>Registrate</h1>
        <?php
            if(isset($_REQUEST['error'])){
                $error = $_REQUEST['error'];
                if($error == 'usuario'){
                    echo '<h2>Usuario vacio</h2>';
                }
                if($error == 'password'){
                    echo '<h2>Contraseña vacia</h2>';
                }
            }
            if(isset($_REQUEST['registro'])){
                if($_REQUEST['registro'] == 'ok'){
                    echo '<h2>Usuario registrado</h2>';
                }
                if($_REQUEST['registro'] == 'error'){
                    echo '<h2>El usuario ya existe</h2>';
                }
            }
        ?>
        Ingresa tu nombre de usuario:
        <br>
        <input type="text" name="user">
        <br>
        Ingresa tu contraseña:
        <br>
        <input type="password" name="pass">
        <button>Enviar</button>
    </form>

    
</body>
</html>