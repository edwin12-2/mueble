<?php 
session_start();
include('conectar.php');

if (strlen($_SESSION['adingresar'])==0) {
    header('location:index.php');
}else {
    $id=intval($_GET['id']);
if (isset($_POST['actualizar'])) {
    $nombre=$_POST['nombre'];
    $correo=$_POST['correo'];
    $contacto=$_POST['contacto'];
    $clave=$_POST['clave'];
    $sql="update usuarios set nombre='$nombre',correo='$correo',contacto='$contacto',clave='$clave' where id='$id'";
    mysqli_query($conn,$sql);
    $_SESSION['msg']="Usuario actualizado";
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
                                    Editar Usuario
                                </h3>
                            </div>
                            <div>
                                <?php 
                                if (isset($_GET['actualizar'])) {
                                ?>
                                    <div>
                                        <button type="button">*</button>
                                        <strong>¡Bien hecho!</strong>
                                        <?php echo htmlentities($_SESSION['msg']); ?>
                                        <?php echo htmlentities($_SESSION['msg']=""); ?>
                                    </div>
                                <?php } ?>
                                <form method="post">
                                    <?php 
                                    $id=intval($_GET['id']);
                                    $query=mysqli_query($conn,"select * from usuarios where id='$id'");
                                    while ($row=mysqli_fetch_array($query)) {
                                    ?>
                                    <div>
                                        <label for="">Nombre</label>
                                        <div>
                                            <input type="text" name="nombre" value="<?php echo htmlentities($row['nombre']) ?>" placeholder="Ingrese el nombre" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Correo</label>
                                        <div>
                                            <input type="text" name="correo" value="<?php echo htmlentities($row['correo']) ?>" placeholder="Ingrese el correo" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Contacto</label>
                                        <div>
                                            <input type="text" name="contacto" value="<?php echo htmlentities($row['contacto']) ?>" placeholder="Ingrese el contacto" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Clave</label>
                                        <div>
                                            <input type="text" name="clave" value="<?php echo htmlentities($row['clave']) ?>" placeholder="Ingrese la clave" required>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div>
                                        <div>
                                            <button class="btn btn-primary" type="submit" name="actualizar">Actualizar</button>
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
