<div class="span3">
    <div class="sidebar">
        <ul class="widget widget-menu unstyled">
            <li>
                <a class="collapsed" data-toggle="collapse" href="#palanca">
                    <i class="menu-icon icon-cog"></i>
                    <i class="icon-chevron-down pull-right"></i>
                    <i class="icon-chevron-up pull-right"></i>
                    <i></i>
                    Gestión de pedidos
                </a>
                <ul id="palanca" class="collapse unstyled">
                    <li>
                        <a href="pedidos-hoy.php">
                            <i></i>
                            Pedidos de hoy
                            <?php
                                $f1="00.00.00";
                                $from=date('Y-m-d')." ".$f1;
                                $t1="23.59.59";
                                $to=date('Y-m-d')." ".$t1;
                                $result=mysqli_query($conn,"SELECT * FROM pedidos where fechaPedido between '$from' and '$to'");
                                $num_rows1=mysqli_num_rows($result);
                                {
                            ?>
                            <b>
                                <?php echo htmlentities($num_rows1); ?>
                            </b>
                            <?php } ?>
                        </a>
                    </li>
                    <li>
                        <a href="pedidos-pendiente.php">
                            <i>

                            </i>
                            Pedidos pendientes
                            <?php
                                $estado="Pendiente";
                                $rt = mysqli_query($conn,"SELECT * FROM pedidos where pedidoEstado='$estado'");
                                $num = mysqli_num_rows($rt);
                                {
                            ?>
                            <b>
                                 <?php echo htmlentities($num); ?>
                            </b>
                            <?php } ?>
                        </a>
                    </li>
                    <li>
                        <a href="pedidos-proceso.php">
                            <i>

                            </i>
                            Pedidos en proceso
                            <?php 
                                $estado="En Proceso";
                                $ret = mysqli_query($conn,"SELECT * FROM pedidos where pedidoEstado='$estado'");
                                $num = mysqli_num_rows($ret);
                                {
                            ?>
                            <b>
                                <?php echo htmlentities($num); ?>
                            </b>
                            <?php } ?>
                        </a>
                    </li>                    
                    <li>
                        <a href="pedidos-entregado.php">
                            <i></i>
                            Pedidos entregados
                        </a>
                    </li>
                    <li>
                        <a href="pedidos-rechazado.php">
                            <i></i>
                            Pedidos rechazados
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="admi-usuarios.php">
                    <i class="menu-icon icon-user"></i>
                    Administrar usuarios
                </a>
            </li>
            <li>
                <a href="agregar-categoria.php">
                    <i class="menu-icon icon-tasks"></i>
                    Crear categoría
                </a>                
            </li>
            <li>
                <a href="agregar-subcat.php">
                    <i class="menu-icon icon-tasks"></i>
                    Subcategoría
                </a>                
            </li>
            <li>
                <a href="agregar-producto.php">
                    <i class="menu-icon icon-paste"></i>
                    Añadir producto
                </a>  
            </li>
            <li>
                <a href="admi-productos.php">
                    <i class="menu-icon icon-table"></i>
                    Administrar productos
                </a>
            </li>
            <li>
                <a class="collapsed" data-toggle="collapse" href="#palanca2">
                    <i class="menu-icon icon-cog"></i>
                    <i class="icon-chevron-down pull-right"></i>
                    <i class="icon-chevron-up pull-right"></i>
                    Reportes
                </a>
                <ul id="palanca2" class="collapse unstyled">
                    <li>
                        <a href="reporte-inventario.php">
                             <i></i>
                            Reporte de inventario
                        </a>
                    </li>
                    <li>
                        <a href="reporte-ventas.php">
                             <i></i>
                            Reporte de ventas
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="usuarios-ingresados.php">
                    <i class="menu-icon icon-tasks"></i>

                    Registro de ingreso de usuarios
                </a>
            </li>
            <li>
                <a href="salir.php">
                    <i class="menu-icon icon-signout"></i>
                    Salir
                </a>  
            </li>
            
    
        </ul>
    </div>
</div>