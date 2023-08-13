<?php
session_start();
$_SESSION['ingresar']=="";
session_unset();
$_SESSION['errmsg']="Ha cerrado la sesión";
?>
<script>
    document.location="index.php";
</script>