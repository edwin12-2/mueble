<?php 
session_start();
include('conectar.php');

if (strlen($_SESSION['adingresar'])==0) {
    header('location:index.php');
}else {
    date_default_timezone_set('America/Lima');
    $tiempoactual=date('d-m-Y h:i:s A',time());
if (isset($_POST['actualizar'])) {
    $nombre=$_POST['nombre'];
    $describir=$_POST['describir'];
    $id=intval($_GET['id']);
    $sql="update categorias set categoriaN='$nombre',descripcion='$describir', fechaCambio='$tiempoactual' where id='$id'";
    mysqli_query($conn,$sql);
    $_SESSION['msg']="Categoría actualizado";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
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
                                    Editar categoría
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
                                    $query=mysqli_query($conn,"select * from categorias where id='$id'");
                                    while ($row=mysqli_fetch_array($query)) {
                                    ?>
                                    <div>
                                        <label for="">Nombre</label>
                                        <div>
                                            <input type="text" name="nombre" value="<?php echo htmlentities($row['categoriaN']) ?>" placeholder="Ingrese el nombre" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Descripción</label>
                                        <div>
                                            <input type="text" name="describir" value="<?php echo htmlentities($row['descripcion']) ?>" placeholder="Ingrese descripción" required>
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
