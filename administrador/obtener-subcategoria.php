<?php
include('conectar.php');
if (!empty($_POST['cat_id'])) {
    $id=intval($_POST['cat_id']);
    $query=mysqli_query($conn,"SELECT * FROM subcategorias WHERE categoriaId=$id");
?>
<option value="">
    Seleccionar
</option>
<?php
while ($row=mysqli_fetch_array($query)) {
?>
    <option value="<?php echo htmlentities($row['id']); ?>">
        <?php echo htmlentities($row['subcategoria']); ?>
    </option>
<?php } } ?>
