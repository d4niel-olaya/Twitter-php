

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=s, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <form action="../Controlador/usuariosControlador.php" method="post">
        <h1>Iniciar sesión</h1>
        Ingresa tu nombre de usuario:
        <br>
        <input type="text" name="userlogin" value=<?php if(isset($_COOKIE['recordar'])){echo $_COOKIE['recordar'];}?>>
        <br>
        Ingresa tu contraseña:
        <br>
        <input type="password" name="passlogin">
        <br>
        <input type="radio" name="sesion_cookie" value="recordar">Recordar nombre de usuario
        <br>
        <input type="radio" name="sesion_cookie" value="norecordar">No recodar nombre de usuario
        <br>  
        <button>Enviar</button>
    </form>
</body>
</html>