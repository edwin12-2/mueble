<?php
//md5() clave post para encriptar
session_start();
error_reporting(0);
include('includes/conectar.php');
if (isset($_POST['enviar'])) {
    $nombre=$_POST['nombre'];
    $correo=$_POST['correo'];
    $contacto=$_POST['contacto'];
    $clave=$_POST['clave'];
    $query=mysqli_query($conn,"insert into usuarios(nombre,correo,contacto,clave) values('$nombre','$correo','$contacto','$clave')");
    if ($query) {
        echo "<script>alert('Registro exitoso');</script>";
    }else {
        echo "<script>alert('No se registro inténtelo de nuevo');</script>";
    }
}
if (isset($_POST['ingresar'])) {
    $correo=$_POST['correo'];
    $clave=$_POST['clave'];
    $query=mysqli_query($conn,"SELECT * FROM usuarios WHERE correo='$correo' and clave='$clave'");
    $num=mysqli_fetch_array($query);
    if ($num>0) {
        $extra="mi-carrito.php";
        $_SESSION['ingresar']=$_POST['correo'];
        $_SESSION['id']=$num['id'];
        $_SESSION['usuario']=$num['nombre'];
        $rip=$_SERVER['REMOTE_ADDR'];
        $estado=1;
        $ingreso=mysqli_query($conn,"insert into usuariosIngresados(usuariocorreo,usuarioRip,estado) values('".$_SESSION['ingresar']."','$rip','$estado')");
        $host=$_SERVER['HTTP_HOST'];
        $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("location:http://$host$uri/$extra");
        exit();
    }else {
        $_SESSION['errmsg']="Cuenta inválido";
        $extra="ingresar.php";
        $correo=$_POST['correo'];
        $host=$_SERVER['HTTP_HOST'];
        $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("location:http://$host$uri/$extra");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar</title>
    <link rel="stylesheet" href="bootstrap.min.css">

    <script>
        function validar() {
            if (document.cc.clave.value!= document.cc.fc.value) {
                alert("No hay coincidencias");
                document.cc.fc.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <header>
        <?php include('includes/encabezado-arriba.php'); ?>
        <?php include('includes/menu-barra.php'); ?>
    </header>
    <div>
    <div class="container">
            <div class="">
                <ul class="list-inline">
                    <li class="">
                        <a class="" href="#">
                            Inicio
                        </a>
                    </li>
                    <li class="active">Ingresar</li>
                </ul>
            </div>
        </div>
    </div>

    <div>
        <div>
            <div>
                <div>
                    <div>
                        <div>

                            <div>
                                <div>
                                    <h4>
                                        Iniciar sesión
                                    </h4>
                                </div>
                                <div>
                                    <div>
                                        <div>
                                            <h4>Información personal</h4>
                                            <div>
                                                <form method="post">
                                                    <span>
                                                        <?php echo htmlentities($_SESSION['errmsg']); ?>
                                                        <?php echo htmlentities($_SESSION['errmsg']=""); ?>
                                                    </span>
                                                    <div>
                                                        <label for="">
                                                            Correo
                                                            <span>*</span>
                                                        </label>
                                                        <input type="email" name="correo" id="" >
                                                    </div>
                                                    <div>
                                                        <label for="">Clave
                                                            <span>*</span>
                                                        </label>
                                                        <input type="password" name="clave">
                                                    </div>
                                                    <div>
                                                        <a href="clave-olvidado.php">
                                                            ¿Has olvidado tu contraseña?
                                                        </a>
                                                    </div>
                                                    
                                                    <button class="btn btn-primary" type="submit" name="ingresar">Ingresar</button>
                                                </form>
                                            </div>
                                            <div>
                                                <h4>Crear una nueva cuenta</h4>
                                                <form method="post" name="cc" onSubmit="return validar();">
                                                    <div>
                                                        <label for="">
                                                            Nombre
                                                            <span>*</span>
                                                        </label>
                                                        <input type="text" name="nombre" id="" required="required">
                                                    </div>
                                                    <div>
                                                        <label for="">
                                                            Correo
                                                            <span>*</span>
                                                        </label>
                                                        <input type="email" name="correo" id="" >
                                                    </div>
                                                    <div>
                                                        <label for="">Contacto
                                                            <span>*</span>
                                                        </label>
                                                        <input type="text" name="contacto" maxlength="11">
                                                    </div>
                                                    <div>
                                                        <label for="">Contraseña
                                                            <span>*</span>
                                                        </label>
                                                        <input type="password" name="clave" >
                                                    </div>
                                                    <div>
                                                        <label for="">Confirmar
                                                            <span>*</span>
                                                        </label>
                                                        <input type="password" name="fc" id="fc">
                                                    </div>
                                                    
                                                    <button class="btn btn-primary" type="submit" name="enviar">Registrarse</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
