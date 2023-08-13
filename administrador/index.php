<?php 
session_start();
error_reporting(0);
include("conectar.php");

if (isset($_POST['ingresar'])) {
    $usuario=$_POST['usuario'];
    $clave=$_POST['clave'];
    $ret=mysqli_query($conn,"SELECT * FROM administradores where usuario='$usuario' and clave='$clave'");
    $num=mysqli_fetch_array($ret);
    if ($num>0) {
        $entrar="menu.php";
        $_SESSION['adingresar']=$_POST['usuario'];
        $_SESSION['id']=$num['id'];
        $_SESSION['usuario']=$num['usuario'];
        $host=$_SERVER['HTTP_HOST'];
        $self=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("location:http://$host$self/$entrar");
        exit();
    }else {
        $_SESSION['errmsg']="Datos inválidos";
        $entrar="index.php";
        $host=$_SERVER['HTTP_HOST'];
        $self=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("location:http://$host$self/$entrar");
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
    <title>Inicio de sesión del administrador</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body style="text-align: center;">
    <div class="navbar ">
        <div class="navbar-inner">
            <div class="">
                <a class="btn btn-navbar" href="">
                    <i class="icon"></i>
                </a>
                <a class="brand" href="index.php">
				    Inicio de sesión del administrador
                </a>
                <div class="nav-collapse">
                    <ul class="nav pull-right">
                        <li>
                            <a href="../cliente/index.php">
                                Volver
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div>
            <div>
                <div>
                    <div>
                        <div>
                            <form method="POST">
                                <div class="control-group">
                                    <h3>
                                        Iniciar sesión
                                    </h3>
                                    <img src="https://visualpharm.com/assets/314/Admin-595b40b65ba036ed117d36fe.svg" width="100" height="120" alt="">
                                </div>
                                <span>
                                    <?php echo htmlentities($_SESSION['errmsg']);?>
                                    <?php ?>
                                </span>
                                <div class="module-body">
                                    <div class="control-group">
                                        <div>
                                            <input type="text" name="usuario" placeholder="usuario" value="">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div>
                                            <input type="password" name="clave" placeholder="contraseña" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div>
                                        <div>
                                            <button class="btn btn-primary" type="submit" name="ingresar">Ingresar</button>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            ¿No tienes una cuenta?
                                            <a href="registro.php">Registrarse aquí</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>