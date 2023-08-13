<?php 
session_start();
include('conectar.php');

if (strlen($_SESSION['adingresar'])==0) {
    header('location:index.php');
}else {
    date_default_timezone_set('America/Lima');
    $tiempoactual=date('d-m-Y h:i:s A',time());
if (isset($_GET['eliminar'])) {
    mysqli_query($conn,"delete from usuarios where id='".$_GET['id']."'");
    $_SESSION['elimsg']="Usuario eliminado";
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
                                    Administrar Usuarios
                                </h3>
                            </div>
                            <div>
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
                                <table class="datatable-1 table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Contacto</th>
                                            <th>Dirección de envío</th>
                                            <th>Dirección permanente</th>
                                            <th>Fecha de registro</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>   
                                    <tbody>
                                        <?php
                                        $sql=mysqli_query($conn,"select * from usuarios");
                                        $cnt=1;
                                        while ($row=mysqli_fetch_array($sql)) {
                                        ?>
                                        <tr>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['nombre']);?></td>
                                            <td><?php echo htmlentities($row['correo']);?></td>
                                            <td><?php echo htmlentities($row['contacto']);?></td>
                                            <td><?php echo htmlentities($row['enviarA']);?></td>
                                            <td><?php echo htmlentities($row['facturarA']);?></td>
                                            <td><?php echo htmlentities($row['fechaRegistro']);?></td>
                                            <td>
                                                <a href="editar-usuario.php?id=
                                                <?php echo $row['id'] ?>">
                                                    <i>editar</i>
                                                </a>
                                                <a href="agregar-usuario.php?id=
                                                <?php echo $row['id'] ?>">
                                                    <i>agregar</i>
                                                </a>
                                                <a href="admi-usuarios.php?id=
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
