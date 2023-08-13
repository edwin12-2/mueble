<?php 
session_start();
include('conectar.php');

if (strlen($_SESSION['adingresar'])==0) {
    header('location:index.php');
}else {
if (isset($_POST['agregar'])) {
    $nombre=$_POST['nombre'];
    $correo=$_POST['correo'];
    $contacto=$_POST['contacto'];
    $clave=$_POST['clave'];
    $sql="insert into usuarios(nombre,correo,contacto,clave)
    values('{$nombre}','{$correo}','{$contacto}','{$clave}')";
    mysqli_query($conn,$sql);
    $_SESSION['msg']="Usuario añadido";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/theme.css">
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
                                    Añadir Usuarios
                                </h3>
                            </div>
                            <div>
                                <?php 
                                if (isset($_GET['agregar'])) {
                                ?>
                                    <div>
                                        <button type="button">*</button>
                                        <strong>¡Bien hecho!</strong>
                                        <?php echo htmlentities($_SESSION['msg']); ?>
                                        <?php echo htmlentities($_SESSION['msg']=""); ?>
                                    </div>
                                <?php } ?>
                                <form method="post">
                                    <div>
                                        <label for="">Nombre</label>
                                        <div>
                                            <input type="text" name="nombre" value="" placeholder="Ingrese el nombre" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Correo</label>
                                        <div>
                                            <input type="email" name="correo" value="" placeholder="Ingrese el correo" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Contacto</label>
                                        <div>
                                            <input type="text" name="contacto" value="" placeholder="Ingrese el contacto" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Clave</label>
                                        <div>
                                            <input type="text" name="clave" value="" placeholder="Ingrese la clave" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <button class="btn btn-primary" type="submit" name="agregar">Añadir</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/jquery-1.9.1.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

</body>
</html>

<?php } ?>
