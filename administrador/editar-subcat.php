<?php 
session_start();
include('conectar.php');

if (strlen($_SESSION['adingresar'])==0) {
    header('location:index.php');
}else {
    date_default_timezone_set('America/Lima');
    $tiempoactual=date('d-m-Y h:i:s A',time());
if (isset($_POST['actualizar'])) {
    $categoria=$_POST['categoria'];
    $subcategoria=$_POST['subcategoria'];
    $id=intval($_GET['id']);
    $sql="update subcategorias set categoriaId='$categoria',subcategoria='$subcategoria', fechaCambio='$tiempoactual' where id='$id'";
    mysqli_query($conn,$sql);
    $_SESSION['msg']="Subcategoría actualizado";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subcategorías</title>
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
                                    Editar Subcategoría
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
                                    $query=mysqli_query($conn,"select categorias.id,categorias.categoriaN,subcategorias.subcategoria from subcategorias join categorias on categorias.id=subcategorias.categoriaId where subcategorias.id='$id'");
                                    while ($row=mysqli_fetch_array($query)) {
                                    ?>
                                    <div>
                                        <label for="">Categoría</label>
                                        <div>
                                            <select name="categoria" required>
                                                <option value="<?php echo htmlentities($row['id']); ?>">
                                                    <?php echo htmlentities($catnombre=$row['categoriaN']); ?>
                                                </option>
                                                <?php $query=mysqli_query($conn,"select * from categorias"); 
                                                while ($rows=mysqli_fetch_array($query)) {
                                                    $cat=$rows['categoriaN'];
                                                    if ($catnombre=$cat) {
                                                        continue;
                                                    }else {
                                                ?>
                                                <option value="<?php echo $row['id']; ?>">
                                                    <?php echo $row['categoriaN']; ?>
                                                </option>
                                                <?php } } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Subcategoría</label>
                                        <div>
                                            <input type="text" name="subcategoria" value="<?php echo htmlentities($row['subcategoria']) ?>" placeholder="Ingrese subcategoría" required>
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
