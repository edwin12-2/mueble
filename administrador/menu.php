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
        $productonombre[]=$row['categoriaN'];
        $pedidos[]=$row['qty'];
        $puntoDatos[] = array("label" => $row['categoriaN'], "y" => $row['qty']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/css/admin.css">

</head>
<body>
    <?php include("../includes/encabezado.php") ?>
    <div>
        <div class="">
            <div class="panel menu col-lg-4 col-xs-12">
                <?php include("../includes/barralateral.php") ?>
                <div class="row">
                    <div>
                        <div class="container">
                            <div>
                                <h2>Estadísticas</h2>
                                <div class="row">
                                    <div class="container" id="contenidoC"></div>

                                    <div class="container">
                                        <section class="module-body">
                                            <div class="">
                                                <div class="col-lg-3 col-xs-6 ">
                                                    <div class=" small-box bg-aqua">
                                                        <div class=" inner">                                                    
                                                            <h3>
                                                            <?php
                                                                $montototal=0;
                                                                $preciototal=0;
                                                                $cantidadtotal=0;
                                                                $sql="SELECT *,(precio*cantidad) as 'total' FROM categorias c,`productos` p,`pedidos` o WHERE c.id=p.categoria AND p.id=`productoId` AND pedidoEstado='Entregado'";
                                                                $result=mysqli_query($conn,$sql);
                                                                while ($row=mysqli_fetch_array($result)) {
                                                                    $preciototal += $row['precio'];
                                                                    $cantidadtotal += $row['cantidad'];
                                                                    $montototal += $row['total'];
                                                                } 
                                                                echo $montototal;
                                                            ?>
                                                            </h3>
                                                            <p>Cantidad de ventas</p>
                                                        </div>
                                                        <div class="icon" style="transform:translate(0px,25px);">
                                                            <i style="font-size: 0.6em;" class="menu icon-money"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="col-lg-3 col-xs-6 ">
                                                    <div class=" small-box bg-yellow">
                                                        <div class=" inner">                                                    
                                                            <h3>
                                                                <?php 
                                                                    $sql="SELECT * FROM pedidos";
                                                                    $query=$conn->query($sql);
                                                                    echo "$query->num_rows";
                                                                ?>
                                                            </h3>
                                                            <p>Pedidos totales</p>
                                                        </div>
                                                        <div class="icon" style="transform:translate(0px,25px);">
                                                            <i style="font-size: 0.6em;" class="menu icon-list-alt"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-xs-6 ">
                                                    <div class=" small-box bg-primary">
                                                        <div class=" inner">
                                                            <h3>
                                                                <?php 
                                                                    $sql="SELECT * FROM pedidos where pedidoEstado='Pendiente'";
                                                                    $query=$conn->query($sql);
                                                                    echo "$query->num_rows";
                                                                ?>
                                                            </h3>
                                                            <p>Pedidos pendientes</p>
                                                        </div>
                                                        <div class="icon" style="transform:translate(0px,25px);">
                                                            <i style="font-size: 0.6em;" class="menu icon-list-alt"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-xs-6 ">
                                                    <div class=" small-box bg-primary">
                                                        <div class=" inner">                                                   
                                                            <h3>
                                                                <?php 
                                                                    $sql="SELECT * FROM pedidos where pedidoEstado='En proceso'";
                                                                    $query=$conn->query($sql);
                                                                    echo "$query->num_rows";
                                                                ?>
                                                            </h3>
                                                            <p>Pedidos en proceso</p>
                                                        </div>
                                                        <div class="icon" style="transform:translate(0px,25px);">
                                                            <i style="font-size: 0.6em;" class="menu icon-list-alt"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-xs-6 ">
                                                    <div class=" small-box bg-green">
                                                        <div class=" inner">                                                   
                                                            <h3>
                                                                <?php 
                                                                $sql="SELECT * FROM pedidos where pedidoEstado='Entregado'";
                                                                $query=$conn->query($sql);
                                                                echo "$query->num_rows";
                                                            ?>
                                                            </h3>
                                                            <p>Pedidos entregados</p>
                                                        </div>
                                                        <div class="icon" style="transform:translate(0px,25px);">
                                                            <i style="font-size: 0.6em;" class="menu icon-list-alt"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-xs-6 ">
                                                    <div class=" small-box bg-green">
                                                        <div class=" inner">                                                   
                                                            <h3>
                                                                <?php 
                                                                    $sql="SELECT * FROM pedidos where pedidoEstado='Rechazado'";
                                                                    $query=$conn->query($sql);
                                                                    echo "$query->num_rows";
                                                                ?>
                                                            </h3>
                                                            <p>Pedidos rechazados</p>
                                                        </div>
                                                        <div class="icon" style="transform:translate(0px,25px);">
                                                            <i style="font-size: 0.6em;" class="menu icon-list-alt"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-xs-6 ">
                                                    <div class=" small-box bg-lime">
                                                        <div class=" inner">                                                   
                                                            <h3>
                                                                <?php 
                                                                    $sql="SELECT * FROM usuarios";
                                                                    $query=$conn->query($sql);
                                                                    echo "$query->num_rows";
                                                                ?>
                                                            </h3>
                                                            <p>Clientes totales</p>
                                                        </div>
                                                        <div class="icon" style="transform:translate(0px,25px);">
                                                            <i style="font-size: 0.6em;" class="menu icon-group"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-xs-6 ">
                                                    <div class=" small-box bg-orange">
                                                        <div class=" inner">                                                   
                                                            <h3>
                                                                <?php 
                                                                    $sql="SELECT * FROM productos";
                                                                    $query=$conn->query($sql);
                                                                    echo "$query->num_rows";
                                                                ?>
                                                            </h3>
                                                            <p>Productos totales</p>
                                                        </div>
                                                        <div class="icon" style="transform:translate(0px,25px);">
                                                            <i style="font-size: 0.6em;" class="menu icon-suitcase"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/jquery-1.9.1.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.canvasjs.min.js"></script>
    <script>
        window.onload = function(){
            var cuadro = new CanvasJS.Chart("contenidoC", {
                animationEnabled: true,
                exportEnabled: true,
                title:{
                    text: "Ventas"
                },
                subtitles: [{
                    text: "Figura"
                }],
                data: [{
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    showInLegend: "true",
                    legendText: "{label}",
                    indexLabelFontSize: 16,
                    indexLabel: "porcentaje",
                    dataPoints: <?php echo json_encode($puntoDatos, JSON_NUMERIC_CHECK); ?>
                }]
            });
            cuadro.render();
        }
    </script>

</body>
</html>

<?php } ?>
