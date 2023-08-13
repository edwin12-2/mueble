<?php 
if (isset($_GET['action'])) {
    if (!empty($_SESSION['carrito'])) {
        foreach ($_POST['cantidad'] as $key => $value) {
            if ($value==0) {
                unset($_SESSION['carrito'][$key]);
            }else {
                $_SESSION['carrito'][$key]['cantidad']=$value;
            }
        }
    }
}
?>
<head>
    <style>
        .flexsearch--input {
        -webkit-box-sizing: content-box;
	    -moz-box-sizing: content-box;
	    box-sizing: content-box;
 	    height: 16px;
        width: 50px;
        padding: 0 46px 0 20px;
	    border-color: #888;
        border-radius: 20px; /* (height/2) + border-width */
        border-style: solid;
        margin-top: 5px;
        color: #333;
	    font-size: 16px;

        }
        .flexsearch--submit {
        position: a;
        right: 0;
        top: 0;
        width: 0px;
        height: 0px;
        padding: 0;
        border: none;
        background: transparent;
        color: white;
        font-size: 16x;
        line-height: 6px;
        }

        .flexsearch--submit:hover {
          color: #333;
          cursor: pointer;
        }

    </style>
</head>
<div class="container">
    <form method="POST" action="buscar-resultado.php" name="buscar">
        <input class="flexsearch--input" type="input" placeholder="Buscar" name="producto" value="">
        <button class="" type="submit" class="flexsearch--submit" style="transform:translate(1px,1px)" name="buscar">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z">
                </path>
            </svg>
        </button>
    </form>

</div>