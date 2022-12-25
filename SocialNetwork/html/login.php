<?php
include "../includes/conection.php";
$userlocal = $_POST['username'];
$passlocal = $_POST['password'];
$string="SELECT idUsuari FROM usuari WHERE idUsuari= '".$userlocal."' AND contrasenya='".$passlocal."'";
//echo $string;
$consulta=mysqli_query($conexio,$string);
$numResults = mysqli_num_rows($consulta);
if ($numResults > 0) {
    //Cas usuari i contrasenya trobats

    //iniciam sessió
    session_start();
    $_SESSION['nombre'] = $userlocal;
    echo "Has iniciat sessió correctament";
    //reconduim a la pestanya principal de la aplicació
    header("Location: principal.php");
}else{
    //retorna a identificacio html
    header("Location: index.html");
}
?>