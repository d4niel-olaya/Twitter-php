<?php
session_start();
require('../Modelo/usuariosModelo.php');
// Se crea un error
//$error = 'empty';

// Se valida si existen los campos del formulario de registro
if(isset($_REQUEST['user']) && isset($_REQUEST['pass'])){
    // Si esta vacio el campo de usuario se modifica el error
    if(empty($_REQUEST['user'])){
        $error = 'usuario';
    }
    if(empty($_REQUEST['pass'])){
        $error = 'password';
    }
    // Si hay un error se redirreciona a la vista del registro de usuario
    if(isset($error)){
        header('Location:../Vista/usuarios_signup.php?error='.$error);
    }
    /*
    if($error != 'empty'){
        header('Location:../Vista/usuarios_signup.php?error='.$error);
    }
    */
    // Sino es el caso se procede a registrar el usuario
    else{
        $nombre = $_REQUEST['user'];
        $clave = $_REQUEST['pass'];
        // Se instancia una clase usuarios
        $usuarios = new Usuarios($nombre, $clave);
        // se llama al metodo registrar
        if($usuarios -> Registrar()){
            // esto sucede si todo esta correcto
            header('Location:../Vista/usuarios_signup.php?registro=ok');
        }
        // Si el usuario ya esta registrado se envia el error por url
        else{
            header('Location:../Vista/usuarios_signup.php?registro=error');
        }
    }
}

// Se verifica si los campos del formulario de inicio de session existen
if(isset($_REQUEST['userlogin']) && isset($_REQUEST['passlogin'])){
    // si lo campos no estan vacios
    if(!empty($_REQUEST['userlogin']) && !empty($_REQUEST['passlogin'])){
        $nombre = $_REQUEST['userlogin'];
        $clave = $_REQUEST['passlogin'];
        // se instancia un objeto de la clase usuarios
        $usuarios = new Usuarios($nombre, $clave);
        // se llama al metodo de inicio de sesión
        if($usuarios -> IniciarSesion()){
             // si el usuario y el password coindicen
            $_SESSION['usuario'] = $nombre;
            $_SESSION['clave'] = $clave;
            header('Location:../Vista/session.php');
        }else{
            // Si no coinciden
            header('Location:../Vista/usuarioslogin.php');
        }
    }
    else{
        header('Location:../Vista/usuarioslogin.php');
    }
}
// si exiten los campos del formulario para crear un tweet
if(isset($_REQUEST['tweet'])){
    $nuevoTweet = new Operaciones($_SESSION['usuario'], $_SESSION['clave']);
    // Se llama al metodo para guardar un tweet de la clase usuarios
    $id = $nuevoTweet -> SacarId($_SESSION['usuario']);
    $nuevoTweet -> GuardarTweet($_REQUEST['tweet'], $id);
    header('Location:../Vista/session.php?state=1');
}
require_once('../Vista/tweets.php');

?>