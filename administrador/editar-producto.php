<?php 
session_start();
include('conectar.php');

if (strlen($_SESSION['adingresar'])==0) {
    header('location:index.php');
}else {
    $id=intval($_GET['id']);
if (isset($_POST['actualizar'])) {
    $categoria=$_POST['categoria'];
    $subcategoria=$_POST['subcategoria'];
    $producto=$_POST['producto'];
    $empresa=$_POST['empresa'];
    $precio=$_POST['precio'];
    $precioAnterior=$_POST['precioAnterior'];
    $describir=$_POST['describir'];
    $costoEnviar=$_POST['costoEnviar'];
    $disponibilidad=$_POST['disponibilidad'];
    $query=mysqli_query($conn,"select producto from productos where id='$id'");
    $result=mysqli_fetch_row($query);
    $pnombre=$result['producto'];
    @rename("productoImagen/$pnombre","productoImagen/$producto");
    $sql="update productos set categoria='$categoria',subCategoria='$subcategoria',producto='$producto',empresa='$empresa',precio='$precio',describir='$describir',costoEnviar='$costoEnviar',disponibilidad='$disponibilidad',precioAnterior='$precioAnterior' where id='$id'";
    mysqli_query($conn,$sql);
    $_SESSION['msg']="Producto actualizado";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
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
                                    Editar producto
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
                                    $query=mysqli_query($conn,"select productos.*,categorias.categoriaN as catnombre,categorias.id as cid,subcategorias.subcategoria as subcatnombre,subcategorias.id as subcatid from productos
                                        join categorias on categorias.id=productos.categoria
                                        join subcategorias on subcategorias.id=productos.subCategoria
                                        where productos.id='$id'");
                                    $cnt=1;
                                    while ($row=mysqli_fetch_array($query)) {
                                    ?>
                                    <div>
                                        <label for="">Categoría</label>
                                        <div>
                                            <select name="categoria" onChange="getSubcat(this.value);" required>
                                                <option value="<?php echo htmlentities($row['cid']); ?>">
                                                <?php echo htmlentities($row['catnombre']); ?>
                                                </option>
                                                <?php $query=mysqli_query($conn,"select * from categorias");
                                                while ($rw=mysqli_fetch_array($query)) {
                                                    if ($row['catnombre']==$rw['categoriaN']) {
                                                        continue;
                                                    }else {
                                                ?>
                                                    <option value="<?php echo $rw['id']; ?>">
                                                        <?php echo $rw['categoriaN']; ?>
                                                    </option>
                                                <?php } } ?>
                                            </select>                                        
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Subcategoría</label>
                                        <div>
                                            <select name="subcategoria">
                                                <option value="<?php echo htmlentities($row['subcatid']); ?>">
                                                    <?php echo htmlentities($row['subcatnombre']); ?>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Nombre</label>
                                        <div>
                                            <input type="text" name="producto" value="<?php echo htmlentities($row['producto']) ?>" placeholder="Ingrese el nombre" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Empresa</label>
                                        <div>
                                            <input type="text" name="empresa" value="<?php echo htmlentities($row['empresa']) ?>" placeholder="Ingrese la empresa" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Precio anterior</label>
                                        <div>
                                            <input type="text" name="precioAnterior" value="<?php echo htmlentities($row['precioAnterior']) ?>" placeholder="Ingrese el precio anterior" required>
                                        </div>
                                    </div>                                   
                                    <div>
                                        <label for="">Precio</label>
                                        <div>
                                            <input type="text" name="precio" value="<?php echo htmlentities($row['precio']) ?>" placeholder="Ingrese precio" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Descripción</label>
                                        <div>
                                            <textarea name="describir" rows="" cols="" placeholder="Ingrese descripción">
                                                <?php echo htmlentities($row['describir']) ?>
                                            </textarea>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Costo envío</label>
                                        <div>
                                            <input type="text" name="costoEnviar" value="<?php echo htmlentities($row['costoEnviar']) ?>" placeholder="Ingrese la empresa" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Disponibilidad</label>
                                        <div>
                                            <select name="disponibilidad" id="disponibilidad">
                                                <option value="<?php echo htmlentities($row['disponibilidad']) ?>">
                                                    <?php echo htmlentities($row['disponibilidad']) ?>
                                                </option>
                                                <option value="En stock">En stock</option>
                                                <option value="Agotado">Agotado</option>
                                            </select>                                        
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Imagen 1</label>
                                        <div>
                                            <img src="productoImagen/<?php echo htmlentities($row['producto']); ?>/<?php echo htmlentities($row['imagen1']); ?>" alt="" width="200" height="100">
                                            <a href="actualizar-imagen1.php?id=<?php echo $row['id']; ?>">Cambiar</a>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Imagen 2</label>
                                        <div>
                                            <img src="productoImagen/<?php echo htmlentities($row['producto']); ?>/<?php echo htmlentities($row['imagen2']); ?>" alt="" width="200" height="100">
                                            <a href="actualizar-imagen2php?id=<?php echo $row['id']; ?>">Cambiar</a>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Imagen 3</label>
                                        <div>
                                            <img src="productoImagen/<?php echo htmlentities($row['producto']); ?>/<?php echo htmlentities($row['imagen3']); ?>" alt="" width="200" height="100">
                                            <a href="actualizar-imagen3.php?id=<?php echo $row['id']; ?>">Cambiar</a>
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
