<div class="side">
    <div class="head">
        <i></i>
        Categorías
    </div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">
            <li>
                <?php
                $sql=mysqli_query($conn,"select id,categoriaN from categorias");
                while ($row=mysqli_fetch_array($sql)) {
                ?>
                <a href="categoria.php?cid=<?php echo $row['id']; ?>">
                    <i></i>
                    <?php echo $row['categoriaN']; ?>
                </a>
                <?php } ?>
            </li>
        </ul>
    </nav>
</div>