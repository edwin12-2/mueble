<?php 
session_start();
include('conectar.php');

if (strlen($_SESSION['adingresar'])==0) {
    header('location:index.php');
}else {
if (isset($_POST['agregar'])) {
    $categoria=$_POST['categoria'];
    $subcategoria=$_POST['subcategoria'];
    $producto=$_POST['producto'];
    $empresa=$_POST['empresa'];
    $precio=$_POST['precio'];
    $precioAnterior=$_POST['precioAnterior'];
    $describir=$_POST['describir'];
    $costoEnviar=$_POST['costoEnviar'];
    $disponibilidad=$_POST['disponibilidad'];
    $qty=$_POST['cantidad'];
    $imagen1=$_FILES['imagen1']['name'];
    $imagen2=$_FILES['imagen2']['name'];
    $imagen3=$_FILES['imagen3']['name'];
    $dir="productoImagen/$producto";
    @mkdir($dir);
    move_uploaded_file($_FILES["imagen1"]["tmp_name"],"productoImagen/$producto/".$_FILES['imagen1']['name']);
    move_uploaded_file($_FILES["imagen2"]["tmp_name"],"productoImagen/$producto/".$_FILES['imagen2']['name']);
    move_uploaded_file($_FILES["imagen3"]["tmp_name"],"productoImagen/$producto/".$_FILES['imagen3']['name']);
    $sql="insert into productos(categoria,subCategoria,producto,empresa,precio,describir,costoEnviar,disponibilidad,imagen1,imagen2,imagen3,precioAnterior)
    values('{$categoria}','{$subcategoria}','{$producto}','{$empresa}','{$precio}','{$describir}','{$costoEnviar}','{$disponibilidad}','{$imagen1}','{$imagen2}','{$imagen3}','{$precioAnterior}')";
    mysqli_query($conn,$sql);
    $miid=mysqli_insert_id($conn);
    $sql="INSERT INTO `inventario` (`productoId`,`enFecha`,`enExistencia`,restante) VALUES ('$miid',NOW(),'$qty','$qty')";
    mysqli_query($conn,$sql);
    $_SESSION['msg']="Producto añadido";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>

    <script>
        function getSubcat(val) {
            $.ajax({
                type: "POST",
                url: "obtener-subcategoria.php",
                data: 'cat_id='+val,
                success: function(data) {
                    $("#subcategoria").html(data);
                }
            });
        }    
    </script>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/css/admin.css"></head>
<body>
    <?php include("../includes/encabezado.php") ?>
    <div class="">
        <div class="">
            <div class="">
                <?php include("../includes/barralateral.php") ?>
                <div class="container">
                    <div class="col">
                        <div class="">
                            <div class="title">
                                <h3 class="title">
                                    Añadir productos
                                </h3>
                            </div>
                            <div class="">
                                <?php 
                                if (isset($_GET['agregar'])) {
                                ?>
                                    <div class="">
                                        <button type="button">*</button>
                                        <strong>¡Bien hecho!</strong>
                                        <?php echo htmlentities($_SESSION['msg']); ?>
                                        <?php echo htmlentities($_SESSION['msg']=""); ?>
                                    </div>
                                <?php } ?>
                                <form class="form" method="post" enctype="multipart/form-data">
                                    <div class="">
                                        <label for="">Categoría</label>
                                        <div class="">
                                            <select name="categoria" onChange="getSubcat(this.value);" required>
                                                <option value="">Seleccionar</option>
                                                <?php $query=mysqli_query($conn,"select * from categorias");
                                                while ($row=mysqli_fetch_array($query)) {
                                                ?>
                                                    <option value="<?php echo $row['id']; ?>">
                                                        <?php echo $row['categoriaN']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="">
                                        <label for="">Subcategoría</label>
                                        <div class="">
                                            <select name="subcategoria" id="subcategoria" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="">
                                        <label for="">Nombre producto</label>
                                        <div class="">
                                            <input class="form-control" type="text" name="producto" value="" placeholder="Ingrese el nombre" required>
                                        </div>
                                    </div>
                                    <div class="">
                                        <label for="">Empresa</label>
                                        <div class="">
                                            <input type="text" name="empresa" value="" placeholder="Ingrese la empresa" required>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="">
                                        <label for="">Precio anterior</label>
                                        <div class="">
                                            <input type="text" name="precioAnterior" value="" placeholder="Ingrese el precio anterior" required>
                                        </div>
                                    </div>
                                    <div class="">
                                        <label for="">Precio</label>
                                        <div class="">
                                            <input type="text" name="precio" value="" placeholder="Ingrese el precio anterior" required>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="">
                                        <label for="">Descripción</label>
                                        <div class="">
                                            <textarea rows="6" cols="" name="describir" placeholder="Ingrese descripción">
                                                
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="">
                                        <label for="">Costo envío</label>
                                        <div class="">
                                            <input type="text" name="costoEnviar" value="" placeholder="Ingrese el costo de envío" required>
                                        </div>
                                    </div>
                                    <div class="">
                                        <label for="">Cantidad</label>
                                        <div class="">
                                            <input type="text" name="cantidad" value="" placeholder="Ingrese la cantidad" required>
                                        </div>
                                    </div>
                                    <div class="">
                                        <label for="">Disponibilidad</label>
                                        <div class="">
                                            <select name="disponibilidad" id="disponibilidad">
                                                <option value="">Seleccionar</option>
                                                <option value="En stock">En stock</option>
                                                <option value="Agotado">Agotado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="">
                                        <label for="">Imagen 1</label>
                                        <div class="">
                                            <input type="file" name="imagen1" value="" placeholder="Ingrese la clave" required>
                                        </div>
                                    </div>
                                    <div class="">
                                        <label for="">Imagen 2</label>
                                        <div class="">
                                            <input type="file" name="imagen2" value="" placeholder="Ingrese la clave" required>
                                        </div>
                                    </div>
                                    <div class="">
                                        <label for="">Imagen 3</label>
                                        <div class="">
                                            <input type="file" name="imagen3" value="" placeholder="Ingrese la clave" required>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="">
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
    <script src="../assets/js/jquery-1.9.1.min.js" type="text/javascript">
    </script>
</body>
</html>
<?php } ?>
