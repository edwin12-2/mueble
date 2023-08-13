<?php 
include('conectar.php');
?>
<head></head>
<div class="navbar">
    <div class="navbar-inner">
        <div>
            <a class="btn" data-toggle="collapse" href="" data-target=".navbar-inverse-collapse">
                <i class="icon">

                </i>
            </a>
            <div class="nav-collapse navbar-inverse-collapse">
                <ul class="nav pull-left">
                    <?php 
                        if (strlen($_SESSION['ingresar'])) {
                    ?>
                    <a class="brand" href="">
                        <i>
                        </i>
                        Bienvenido:
                        <?php echo htmlentities($_SESSION['usuario']); ?>
                    </a>
                    <?php } ?>
                    <li>
                        <a class="nav-link" href="mi-cuenta.php">
                            <i></i>
                            Mi cuenta
                        </a>
                        
                    </li>
                    <li>
                        <a class="nav-link" href="mi-carrito.php">
                            <i class="icon fa fa-shopping-cart"></i>
                            Mi carrito
                        </a>

                    </li>
                    <li>
                        <a class="nav-link" href="pago-metodo.php">
                            <i></i>
                            Verificar
                        </a>
                    </li>
                    <?php 
                        if (strlen($_SESSION['ingresar'])==0) {
                    ?>
                    <li>
                        <a class="nav-link" href="ingresar.php">
                            <i></i>
                            Ingresar
                        </a>
                    </li>
                    <?php }else {
                    ?>
                    <li>
                        <a class="nav-link" href="salir.php">
                            <i></i>
                            Salir
                        </a>
                    </li>
                    <?php } ?>
                    <li>
                        <a class="nav-link" href="seguir-pedidos.php">
                            <span>Pedidos</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="../administrador/index.php">
                            <i></i>
                            Administrador
                        </a>
                    </li>
                    <li>
                        <p> </p>
                    </li>
                </ul> 
                <ul class="nav pull-right">
                    <li>
                        <?php include("menu-encabezado.php"); ?>
                    </li>
                </ul>
            </div>
            <div>
                <div>
                    <a class="brand" href="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
