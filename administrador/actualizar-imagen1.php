<?php 
session_start();
include('conectar.php');

if (strlen($_SESSION['adingresar'])==0) {
    header('location:index.php');
}else {
    $pid=intval($_GET['id']);
if (isset($_POST['actualizar'])) {
    $producto=$_POST['producto'];
    $imagen1=$_FILES["imagen1"]["name"];
    $ret=mysqli_query($conn,"select imagen1 from productos where id='$pid'");
    $result=mysqli_fetch_row($ret);

    move_uploaded_file($_FILES["imagen1"]["tmp_name"],"productoImagen/$producto/".$_FILES['imagen1']['name']);
    $sql = mysqli_query($conn,"update productos set imagen1='$imagen1' where id='$pid'");
    $_SESSION['msg']="Producto imagen actualizado con éxito.";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar imagen</title>
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
                                    Editar imagen 1
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
                                <form class="form" method="post" enctype="multipart/form-data">
                                    <?php 
                                    $query=mysqli_query($conn,"select producto,imagen1 from productos where id='$pid'");
                                    $cnt=1;
                                    while ($row=mysqli_fetch_array($query)) {
                                    ?>
                                    <div>
                                        <label for="">Producto</label>
                                        <div>
                                            <input type="text" name="producto" value="<?php echo htmlentities($row['producto']); ?>" required>                                     
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Imagen 1</label>
                                        <div>
                                            <img src="productoImagen/<?php echo htmlentities($row['producto']); ?>/<?php echo htmlentities($row['imagen1']); ?>" alt="" width="200" height="100">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Nueva imagen</label>
                                        <div>
                                            <input type="file" name="imagen1" id="imagen1"  value="" required>
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
