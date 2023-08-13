<?php
session_start();
$_SESSION['adingresar']=="";
session_unset();
$_SESSION['errmsg']="Ha cerrado la sesión";
?>
<script>
    document.location="index.php";
</script>