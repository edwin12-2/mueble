<?php 
session_start();
error_reporting(0);
include('conectar.php');

if (strlen($_SESSION['adingresar'])==0) {
    header('location:index.php');
}else {
    date_default_timezone_set('America/Lima');
    $tiempoactual=date('d-m-Y h:i:s A',time());
if (isset($_POST['cambiar'])) {
    $clave=$_POST['ca'];
    $sql=mysqli_query($conn,"SELECT clave FROM administradores where clave='$clave' && id='".$_SESSION['id']."'");
    $num=mysqli_fetch_array($sql);
    if ($num>0) {
        $clave=$_POST['nc'];
        $con=mysqli_query($conn,"update administradores set clave='$clave', fechaCambio='$tiempoactual' where id='".$_SESSION['id']."'");
        echo "<script>alert('cambio realizado');</script>";
    }else {
        echo "<script>alert('No coincide');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar clave</title>
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
    <?php include("../includes/encabezado.php") ?>
    <div>
        <div>
            <div>
                <?php include("../includes/barralateral.php") ?>
                <div>
                    <div>
                        <div>
                            <div>
                                <h3>
                                    Cambiar
                                </h3>
                            </div>
                            <div>
                                <?php if (isset($_POST['cambiar'])) 
                                { ?>
                                <div>
                                    <button type="button" ></button>
                                    <?php echo htmlentities($_SESSION['msg']); ?>
                                    <?php echo htmlentities($_SESSION['msg']=""); ?>
                                </div>
                                <?php } ?>
                                <form action="" role="form" method="post" name="cc" onsubmit="return validar();">
                                    <div>
                                        <label for="">
                                            Contraseña actual
                                            <span></span>
                                        </label>
                                        <input type="password" id="ca" name="ca" value="" required="required">
                                    </div>
                                    <div>
                                        <label for="">
                                            Nueva contraseña
                                            <span></span>
                                        </label>
                                        <input type="password" id="nc" name="nc" value="">
                                    </div>
                                    <div>
                                        <label for="">
                                            Confirmar contraseña
                                            <span></span>
                                        </label>
                                        <input type="password" id="fc" name="fc" value="" required="required">
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


</body>
</html>

<?php } ?>
