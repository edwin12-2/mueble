<?php 
session_start();
include('conectar.php');

if (strlen($_SESSION['adingresar'])==0) {
    header('location:index.php');
}else {
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
                                    Usuarios
                                </h3>
                            </div>
                            <div>
                                <table class="datatable-1 table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Correo</th>
                                            <th>IP</th>
                                            <th>Inicio</th>
                                            <th>Salidas</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>   
                                    <tbody>
                                        <?php
                                        $sql=mysqli_query($conn,"select * from usuariosIngresados");
                                        $cnt=1;
                                        while ($row=mysqli_fetch_array($sql)) {
                                        ?>
                                        <tr>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['usuarioCorreo']);?></td>
                                            <td><?php echo htmlentities($row['usuarioRip']);?></td>
                                            <td><?php echo htmlentities($row['horaInicio']);?></td>
                                            <td><?php echo htmlentities($row['salir']);?></td>
                                            <td><?php $st=$row['estado']; 
                                            
                                            if ($st==1) {
                                                echo "Exitoso";
                                            }else {
                                                echo "Fallido";
                                            }
                                            ?>
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
