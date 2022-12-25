<?php
    //verificar identitat
    include "../includes/user.php";
    include "../includes/conection.php";
    $idUsuariReceptor=$_GET['id'];
    $idsession=$_SESSION['nombre'];
    $date = date('Y-m-d G:i:s', time());
    $string = $_GET['text'];

    $insert = "INSERT INTO Missatge SET descripcio = '" .$string. "' , dataEnviat = '" .$date. "', idUsuariEmissor = '" .$idsession. "', idUsuariReceptor = '" .$idUsuariReceptor. "';";
    $add = mysqli_query($conexio,$insert);
    header("Location: ../html/chat.php?id=" . $idUsuariReceptor);
    die();
?>