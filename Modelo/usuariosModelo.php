<?php
// Importo la conexion a la bd
require('conexion.php');
class Usuarios{
    private $nombre;
    private $clave;
    private $conexion;
    public function __construct($nombreUser, $claveUser){
        $this -> nombre = $nombreUser;
        $this -> conexion = Conexion::conectar();
        $this -> clave = $claveUser;
    }
    // metodo para validar el resgitro de un usuario
    private function validarRegistro($usuario){
        if($sentencia = mysqli_prepare($this -> conexion,"SELECT id from usuarios WHERE nombre = '$usuario';")){
            mysqli_stmt_execute($sentencia);
            mysqli_stmt_bind_result($sentencia, $id);
            $indicador = mysqli_stmt_fetch($sentencia);
            return $indicador;
            mysqli_stmt_close($sentencia);
        }
    }
    // Metodo para validar el inicio de sesión
    private function validarSesion($usuario, $pass){
        $consultaSession = "SELECT id FROM usuarios WHERE nombre = '$usuario' AND clave = '$pass';";
        if($sentenciaSession = mysqli_prepare($this -> conexion, $consultaSession)){
            mysqli_stmt_execute($sentenciaSession);
            mysqli_stmt_bind_result($sentenciaSession, $id);
            $indicadorSession = mysqli_stmt_fetch($sentenciaSession);
            return $indicadorSession;
            mysqli_stmt_close($indicadorSession);
        }
    }
    // metodo para registrarse
    public function Registrar(){
        $name = $this -> nombre;
        $pass = $this -> clave;
        $consulta = "INSERT INTO usuarios(nombre, clave) VALUES('$name', '$pass');";
        if($this -> validarRegistro($name)){
            return false;
        }else{
            $resultado = mysqli_query($this -> conexion, $consulta);
            return $resultado;
        }
    }
    public function SacarId($nombre){
        $consultaId = "SELECT id FROM usuarios WHERE nombre = '$nombre'";
        if($result = mysqli_query($this -> conexion, $consultaId)){
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['id'];
            }
        }
        return $id;
        mysqli_free_result($result);
    }
    // Metodo para iniciar sesion
    public function IniciarSesion(){
        $name = $this -> nombre;
        $pass = $this -> clave;
        return $this -> validarSesion($name, $pass);
        
    }
    // metodo para guardar un tweet
    public function GuardarTweet($texto, $idUser){
        $fecha = date('Y-m-d');
        $consultaT = "INSERT INTO publicaciones(id_user, texto, fecha) VALUES('$idUser', '$texto', '$fecha');";
        $result = mysqli_query($this -> conexion, $consultaT);
        return $result;
    }
    // metodo para ver las publicaciones
    public function publicaciones(){
        $id = $this -> SacarId($this -> nombre);
        $consultaTweets = "SELECT usuarios.nombre, publicaciones.texto, publicaciones.fecha
        FROM usuarios INNER JOIN publicaciones ON usuarios.id = publicaciones.id_user where publicaciones.id_user = '$id' ORDER BY publicaciones.id desc";
        if($resultado = mysqli_query($this -> conexion, $consultaTweets)){
            while($row = mysqli_fetch_assoc($resultado)){
                echo '<div>';
                    echo $row['nombre'].'- Fecha : '.$row['fecha'];
                    echo '<hr>';
                    echo '<br>';
                    echo $row['texto'];
                    echo '<br>';
                echo '</div>';
            }
            mysqli_free_result($resultado);
        }
    }
}

?>