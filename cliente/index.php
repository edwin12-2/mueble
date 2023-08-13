<?php
session_start();
error_reporting(0);
include('conectar.php');
if (isset($_GET['action']) && $_GET['action']=="add") {
    $id=intval($_GET['id']);
    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id]['cantidad']++;
    }else {
        $sql_p="SELECT * FROM productos WHERE id={$id}";
        $query_p=mysqli_query($conn,$sql_p);
        if (mysqli_num_rows($query_p)!=0) {
            $row_p=mysqli_fetch_array($query_p);
            $_SESSION['carrito'][$row_p['id']]=array("cantidad" => $row_p['precioAnterior']);
            header('location:index.php');
        }else {
            $mensaje="El id no es válido";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
          .price-before-discount {
    text-decoration: line-through;
    color: red;
  }
  .price{
    color: darkblue;
    font-size: 16px;
  }
  .boton{
    position: relative;
    
  }
    </style>
</head>
<body>
    <div>
        <header class="header-style-1">
        <div class="logo-place"><a href="index.php"><img src="../assets/imagen/descarga.png" width="100%"></a></div>
            <div class="">
                <div class="">
                    <?php include('includes/encabezado-arriba.php'); ?>
                </div>
            </div>
            <?php include('includes/menu-barra.php'); ?>
        </header>
        <div class="body-content outer-top-xs">
            <div class="container">
                <div class="furniture-container homepage-container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
                            <?php include('includes/menu-lateral.php'); ?>
                        </div>
			            <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                            <div class="tab-pane in active" id="all">			
                                <section class="owl-inner-nav owl-ui-sm"> 
                                    <div class="full-width-slider">
                                        <div class="outer-top-xs">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="row">
                                                        <?php 
                                                            $ret=mysqli_query($conn,"select * from productos");
                                                            while ($row=mysqli_fetch_array($ret)) {
                                                        ?>
                                                            <div class='col-md-4 mb-2'>
                                                                <div class='card' style='width: 18rem; height:auto'>
                                                                    <div class="product-list">
                                                                        <div class="product-image">
                                                                            <div class="image">
                                                                                <a href="producto-detalles.php?pid=<?php echo htmlentities($row['id']); ?>">
                                                                                    <img src="../administrador/productoImagen/<?php echo htmlentities($row['producto']); ?>/<?php echo htmlentities($row['imagen1']); ?>" data-echo="../administrador/productoImagen/<?php echo htmlentities($row['producto']); ?>/<?php echo htmlentities($row['imagen1']); ?>" width="180" height="180" alt="">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="product-info text-left">
                                                                            <div class="card-body">
                                                                                <h3 class="name card-title">
                                                                                    <a href="producto-detalles.php?pid=<?php echo htmlentities($row['id']); ?>">
                                                                                    <?php echo htmlentities($row['producto']); ?>
                                                                                    </a>
                                                                                </h3>
                                                                                <div class="rating rateit-small"></div>
                                                                                <div class="description card-text">
                                                                                    <h4 class="card-text">
                                                                                        <?php echo htmlentities($row['describir']); ?>
                                                                                    </h4>
                                                                                </div>
                                                                                <div class="product-price">
                                                                                    <span class="price">
                                                                                        S/.<?php echo htmlentities($row['precio']); ?>
                                                                                    </span>                                                                                
                                                                                    <span class="price-before-discount">
                                                                                        S/.<?php echo htmlentities($row['precioAnterior']); ?>
                                                                                    </span>                                                                                
                                                                                </div>
                                                                            </div>
                                                                            <div class="action text-center">
                                                                                <a class="btn btn-primary"
                                                                                href="index.php?page=producto&action=add&id=<?php echo $row['id']; ?>">
                                                                                    Añadir al carrito
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                <div div="row">
                    <ul class="pagination pagination-lg justify-content-end">
                    <?php  
                    
                    $anterior = $data['pagina'] - 1;
                    $siguiente = $data['pagina'] + 1;
                    if ($data['pagina'] > 1) {
                        echo '<li class="page-item">
                        <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0" href="'.$anterior.'"
                            >Anterior</a>
                    </li>';
                    }
                    if ($data['total'] >= $siguiente) {
                        echo '<li class="page-item">
                        <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-white"
                            href="'.$siguiente.'">Siguiente</a>
                    </li>';
                    }

                    ?>
                        
                        
                    </ul>
                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('includes/footer.php');
    ?>
    <script src="../assets/js/jquery-1.9.1.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.canvasjs.min.js"></script>

</body>
</html>
