<?php 
include('conectar.php');

if (isset($_POST['enviar'])) {
    $nombre=$_POST['nombre'];
    $clave=$_POST['clave'];
    $sql="insert into administradores(usuario,clave)
    values('{$nombre}','{$clave}')";
    $res=mysqli_query($conn,$sql);
    if ($res) {
        echo "<script>alert('Registro exitoso');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <script>
        function validar() {
            if (document.cc.clave.value!= document.cc.fc.value) {
                alert("No hay coincidencias");
                document.cc.fc.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div>
        <div>
            <div>
                <a href="">
                    <i></i>
                </a>
                <a href="">
                    Registro
                </a>
                <div>
                    <ul>
                        <li>
                            <a href="index.php">
                                Volver
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div>
            <div>
                <div>
                    <div>
                        <div>
                            <div>
                                <h3>
                                    Registro
                                </h3>
                            </div>
                            <div>
                                <h4>Crear una nueva cuenta</h4>
                                <form method="post" name="cc" onSubmit="return validar();">
                                    <div>
                                        <label for="">
                                            Nombre
                                            <span>*</span>
                                        </label>
                                        <input type="text" name="nombre" id="" required="required">
                                    </div>
                                    <div>
                                        <label for="">Contraseña
                                            <span>*</span>
                                        </label>
                                        <input type="password" name="clave" >
                                    </div>
                                    <div>
                                        <label for="">Confirmar
                                            <span>*</span>
                                        </label>
                                        <input type="password" name="fc" id="fc">
                                    </div>
                                    
                                    <button class="btn btn-primary" type="submit" name="enviar">Registrarse</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
