<div class="navbar">
    <div class="navbar-inner">
        <div class="">
            <a class="btn" data-toggle="collapse" href="" data-target=".navbar-inverse-collapse">
                <i class="icon">

                </i>
            </a>
            <div class="nav-collapse navbar-inverse-collapse">
                <ul class="nav pull-right">
                    <li>
                        <?php if ($_SESSION['adingresar']) {
                         ?>
                        <a class="brand" href="">
                            Bienvenido:
                            <?php echo htmlentities($_SESSION['usuario']); ?>
                        </a>
                        <?php } ?>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="cambiar-clave.php">Cambiar clave</a>
                            </li>
                            <li></li>
                            <li>
                                <a href="salir.php">Salir</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div>
                <div>
                    <a class="brand" href="menu.php">
                        Menu
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>