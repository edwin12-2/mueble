<div class="header-nav animate-dropdown">
    <div>
        <div>
            <div class="yamm navbar navbar-default" style="background-color: white; border: none">
                <div class="navbar-header">

                </div>
                <div>
                    <div>
                        <div>
                            <ul class="nav navbar-nav" style="width: 2400px">
                                <li>
                                    <a href="index.php">
                                        <img src="group.png" width="20px" alt="">
                                    </a>
                                </li>
                                <?php 
                                    $sql=mysqli_query($conn,"select id,categoriaN from categorias limit 6");
                                    while ($row=mysqli_fetch_array($sql)) {
                                ?>
                                <li>
                                    <a href="categoria.php?cid=<?php echo $row['id']; ?>">
                                        <?php echo $row['categoriaN']; ?>
                                    </a>
                                </li>
                                <?php } ?>
                                <div>
                                    <?php 
                                        if (!empty($_SESSION['carrito'])) {
                                       
                                    ?>
                                    <div style="width: 390px">
                                        <a href="">
                                            <div>
                                                <div>
                                                    <span><i class="sopping-cart"></i></span>
                                                    <span>
                                                        <span>S/.</span>
                                                        <span>
                                                            <?php echo $_SESSION['tp']; ?>
                                                        </span>
                                                    </span>
                                                    <i></i>
                                                </div>
                                                <div></div>
                                                <div>
                                                    <span>
                                                        <?php echo $_SESSION['qnty']; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                        <ul>
                                            <?php
                                                $sql="SELECT * FROM productos WHERE id IN(";
                                                foreach ($_SESSION['carrito'] as $id => $value) {
                                                    $sql .=$id. ",";
                                                }
                                                $sql=substr($sql,0,-1) . ") ORDER BY id ASC";
                                                $query=mysqli_query($_conn,$sql);
                                                $preciototal=0;
                                                $cantidadtotal=0;
                                                if (!empty($query)) {
                                                    while ($row=mysqli_fetch_array($query)) {
                                                        $cantidad=$_SESSION['carrito'][$row['id']]['cantidad'];
                                                        $subtotal=$_SESSION['carrito'][$row['id']]['cantidad']*$row['precio']+$row['enviarCosto'];
                                                        $preciototal+=$subtotal;
                                                        $_SESSION['qnty']=$cantidadtotal+=$cantidad;

                                                    
                                            ?>
                                            <li>
                                                <div>
                                                    <div>
                                                        <div>
                                                            <div>
                                                                <a href="">
                                                                    <img src="../../administrador/productoImagen/<?php echo $row['producto']; ?>/<?php echo htmlentities($row['imagen1']); ?>" width="35" height="35" alt="">
                                                                </a>
                                                            </div>

                                                        </div>
                                                        <div>
                                                            <h3>
                                                                <a href="index.php?page-detail">
                                                                    <?php echo $row['producto']; ?>
                                                                </a>
                                                            </h3>
                                                            <div>
                                                                S/.<?php echo ($row['precio']+$row['enviarCosto']); ?>*<?php echo $_SESSION['carrito'][$row['id']]['cantidad']; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } } ?>
                                                <div></div>
                                                <div>
                                                    <div>
                                                        <span>Total:</span>
                                                        <span>
                                                            S/.<?php echo $_SESSION['tp']-"$preciototal". ".00"; ?>
                                                        </span>
                                                    </div>
                                                    <div>
                                                    </div>
                                                    <a href="mi-carrito.php">
                                                        Mi carrito
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php }else {
                                     ?>
                                    <div style="width: 600px;">
                                        <a href="">
                                            <div>
                                                <div>
                                                    <span><i class="icon fa fa-shopping-cart"></i>:</span>
                                                    <span class="">
                                                        <span>S/.</span>
                                                        <span>00.00</span>
                                                    </span>
                                                    <i></i>

                                                </div>
                                                <div class="basket">
                                                    <div><span class="">0</span></div>
                                                </div>
                                            </div>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <div>
                                                    <div>
                                                        <div>
                                                            Su cesta está vacía
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div></div>
                                                    <a href="index.php">
                                                        Seguir comprando
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php } ?>
                                </div>
                            </ul>
                            <div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>