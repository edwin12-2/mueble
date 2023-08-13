<?php 
session_start();
include('conectar.php');

if (strlen($_SESSION['adingresar'])==0) {
    header('location:index.php');
}else {
    $sql="SELECT *,SUM(cantidad) as 'qty' FROM categorias c, `productos` p, `pedidos` o WHERE c.id=p.categoria AND p.`id`=o.`productoId` GROUP BY p.categoria";
    $result=mysqli_query($conn,$sql);
    $chart_data="";
    while ($row=mysqli_fetch_array($result)) {
        $productonombre[]=$row['categoria'];
        $pedidos[]=$row['qty'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
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
                                    Inventario
                                </h3>
                            </div>
                            <div>
                                <table class="datatable-1 table">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Categoría</th>
                                            <th>Precio</th>
                                            <th>Stock</th>
                                            <th>Vendido</th>
                                            <th>Restante</th>
                                        </tr>
                                    </thead>   
                                    <tbody>
                                        <?php
                                        $sql="SELECT * FROM categorias c,`productos` p,`inventario` i WHERE c.id=categoria AND p.id=`productoId`";
                                        $result=mysqli_query($conn,$sql);
                                        while ($row=mysqli_fetch_array($result)) {
                                            echo '<tr>';
                                            echo '<td>'.$row['producto'].'</td>';
                                            echo '<td>'.$row['categoriaN'].'</td>';
                                            echo '<td>'.$row['precio'].'</td>';
                                            echo '<td>'.$row['enExistencia'].'</td>';
                                            echo '<td>'.$row['salidaExistencia'].'</td>';
                                            echo '<td>'.$row['restante'].'</td>';
                                            echo '</tr>';
                                        } 
                                        ?>
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
