<?php 
session_start();
include('conectar.php');

if (strlen($_SESSION['adingresar'])==0) {
    header('location:index.php');
}else {
if (isset($_POST['agregar'])) {
    $categoria=$_POST['categoria'];
    $subcategoria=$_POST['subcategoria'];
    $sql="insert into subcategorias(categoriaId,subcategoria)
    values('{$categoria}','{$subcategoria}')";
    mysqli_query($conn,$sql);
    $_SESSION['msg']="SubCategoría añadido";
}
if (isset($_GET['eliminar'])) {
    mysqli_query($conn,"delete from subcategorias where id='".$_GET['id']."'");
    $_SESSION['elimsg']="SubCategoría eliminado";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SubCategorías</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/css/admin.css"></head>
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
                                    Añadir Subcategorías
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
                                <?php 
                                if (isset($_GET['eliminar'])) {
                                ?>
                                    <div>
                                        <button type="button">*</button>
                                        <strong>!</strong>
                                        <?php echo htmlentities($_SESSION['elimsg']); ?>
                                        <?php echo htmlentities($_SESSION['elimsg']=""); ?>
                                    </div>
                                <?php } ?>
                                <form method="post">
                                    <div>
                                        <label for="">Categoría</label>
                                        <div>
                                            <select name="categoria" required>
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
                                    <div>
                                        <label for="">Nombre subcategoría</label>
                                        <div>
                                            <input type="text" name="subcategoria" value="" placeholder="Ingrese nombre" required>
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
                        <div>
                            <div>
                                <h3>
                                    Administrar subcategorías
                                </h3>
                            </div>
                            <div>
                                <table class="datatable-1 table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Categoría</th>
                                            <th>Subcategoría</th>
                                            <th>Fecha de registro</th>
                                            <th>Ultima actualización</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>   
                                    <tbody>
                                        <?php
                                        $sql=mysqli_query($conn,"select subcategorias.id,categorias.categoriaN,subcategorias.subcategoria,subcategorias.fechaCreado,subcategorias.fechaCambio from subcategorias join categorias on categorias.id=subcategorias.categoriaId");
                                        $cnt=1;
                                        while ($row=mysqli_fetch_array($sql)) {
                                        ?>
                                        <tr>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['categoriaN']);?></td>
                                            <td><?php echo htmlentities($row['subcategoria']);?></td>
                                            <td><?php echo htmlentities($row['fechaCreado']);?></td>
                                            <td><?php echo htmlentities($row['fechaCambio']);?></td>
                                            <td>
                                                <a href="editar-subcat.php?id=
                                                <?php echo $row['id'] ?>">
                                                    <i>editar</i>
                                                </a>
                                                <a href="agregar-subcat.php?id=
                                                <?php echo $row['id'] ?>&eliminar=delete" onclick="return confirm('¿Quieres eliminarlo?')">
                                                    <i>eliminar</i>
                                                </a>
                                            </td>
                                            <?php $cnt=$cnt+1; } ?>
                                        </tr>
                                    </tbody>                                
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/jquery-1.9.1.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.dataTables.js">
    </script>
    <script>
        $(document).ready(function(){
            $('.datatable-1').dataTable({
                language:{
                    url:'//cdn.datatables.net/plug-ins/1.12.0/i18n/es-ES.json'
                }
            });
            $('.dataTables_paginate').addClass("btn-group datatable-pagination");
            $('.dataTables_paginate > a').wrapInner('<span />');
            $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
            $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
        });
    </script>
</body>
</html>

<?php } ?>
