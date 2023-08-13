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
    <title>Proceso</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/theme.css">    
    <link rel="stylesheet" href="../assets/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <script>
        var popUpWin=0;
        function popUpWindow(URLStr,left,top,width,height) {
            if (popUpWin) {
                if (!popUpWin.closed) popUpWin.close();
            }
            popUpWin=open(URLStr,'popUpWin','toolbar=no,location,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+',top='+top+',screenX='+left+',screenY='+top+'');
        }
    </script>
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
                                    Pedidos proceso
                                </h3>
                            </div>
                            <div>
                                <table class="datatable-1 table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Correo/Contacto</th>
                                            <th>Dir. envío</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Monto</th>
                                            <th>Fecha de orden</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>   
                                    <tbody>
                                        <?php
                                        $sql="SELECT *,o.id as pedidosid from `productos` p, `pedidos` o, `usuarios` u where p.id=productoId and usuarioId=u.id and pedidoEstado in ('En Proceso', null)";
                                        $query=mysqli_query($conn,$sql);
                                        $cnt=1;
                                        while ($row=mysqli_fetch_array($query)) {
                                        ?>
                                        <tr>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['nombre']);?></td>
                                            <td><?php echo htmlentities($row['correo']);?>/<?php echo htmlentities($row['contacto']);?></td>
                                            <td><?php echo htmlentities($row['enviarA'].",".$row['enviarCiudad'].",".$row['enviarEstado'].",".$row['enviarPostal']);?></td>
                                            <td><?php echo htmlentities($row['producto']);?></td>
                                            <td><?php echo htmlentities($row['cantidad']);?></td>
                                            <td><?php echo htmlentities($row['cantidad']*$row['precio']+$row['costoEnviar']);?></td>
                                            <td><?php echo htmlentities($row['fechaPedido']);?></td>
                                            <td>
                                                <a href="javascript:void(0);" onclick="popUpWindow('actualizar-pedido.php?oid=<?php echo htmlentities($row['pedidosid']); ?>');">
                                                    <i>Editar
                                                    </i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $cnt=$cnt+1; } ?>
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
