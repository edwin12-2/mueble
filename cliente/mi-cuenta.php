<?php
session_start();
error_reporting(0);
include('conectar.php');
if (strlen($_SESSION['ingresar'])==0) {
    header('location:index.php');
}else {
    if (isset($_POST['actualizar'])) {
        $nombre=$_POST['nombre'];
        $contacto=$_POST['contacto'];
        $query=mysqli_query($conn,"update usuarios set nombre='$nombre',contacto='$contacto' where id='".$_SESSION['id']."'");
        if ($query) {
            echo "<script>alert('Información actualizada');</script>";
        }
    }
    date_default_timezone_set('America/Lima');
    $tiempoactual=date('d-m-Y h:i:s A',time());
    if (isset($_POST['cambiar'])) {
        $clavea=$_POST['ca'];
        $sql=mysqli_query($conn,"SELECT clave FROM usuarios where clave='$clavea' && id='".$_SESSION['id']."'");
        $num=mysqli_fetch_array($sql);
        if ($num>0) {
            $nclave=$_POST['nc'];
            $con=mysqli_query($con,"update usuarios set clave='$nclave', fechaCambio='$tiempoactual' where id='".$_SESSION['id']."'");
            echo "<script>alert('Contraseña cambiada');</script>";
        }else {
            echo "<script>alert('La contraseña no coincide');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi cuenta</title>
    <link rel="stylesheet" href="bootstrap.min.css">

    <script>
        function validar() {
            if (document.cc.nc.value!= document.cc.fc.value) {
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
                    <li class="active">Verificar</li>
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
                                        <a href="">
                                            <span>1</span>
                                            Mi perfil
                                        </a>
                                    </h4>
                                </div>
                                <div>
                                    <div>
                                        <div>
                                            <h4>Información personal</h4>
                                            <div>
                                                <?php 
                                                    $query=mysqli_query($conn,"select *from usuarios where id='".$_SESSION['id']."'");
                                                    while ($row=mysqli_fetch_array($query)) {
                                                ?>

                                                <form method="post">
                                                    <div>
                                                        <label for="">
                                                            Nombre
                                                            <span>*</span>
                                                        </label>
                                                        <input type="text" name="nombre" id="nombre" value="<?php echo $row['nombre'] ?>" required="required">
                                                    </div>
                                                    <div>
                                                        <label for="">Correo
                                                            <span>*</span>
                                                        </label>
                                                        <input type="email" name="correo" value="<?php echo $row['correo'] ?>" readonly>
                                                    </div>
                                                    <div>
                                                        <label for="">Contacto
                                                            <span>*</span>
                                                        </label>
                                                        <div>
                                                            <input type="text" id="contacto" name="contacto" value="<?php echo $row['contacto'] ?>" required="required" maxlength="10">
                                                        </div>
                                                    </div>
                                                    
                                                    <button class="btn btn-primary" type="submit" name="actualizar">Actualizar</button>
                                                </form>

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <h4>
                                        <a href="">
                                            <span>2</span>
                                            Cambiar contraseña
                                        </a>
                                    </h4>
                                </div>

                                <div>
                                    <div>
                                        <form method="post" name="cc" onSubmit="return validar();">
                                            <div>
                                                <label for="">
                                                    Contraseña actual
                                                    <span>*</span>
                                                </label>
                                                <input type="password" name="ca" id="ca" required="required">
                                            </div>
                                            <div>
                                                <label for="">Nueva contraseña
                                                    <span>*</span>
                                                </label>
                                                <input type="password" name="nc" id="nc">
                                            </div>
                                            <div>
                                                <label for="">Confirmar contraseña 
                                                    <span>*</span>
                                                </label>
                                                <div>
                                                    <input type="password" id="fc" name="fc" required="required">
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit" name="cambiar">Cambiar</button>
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

</body>
</html>

<?php } ?>
