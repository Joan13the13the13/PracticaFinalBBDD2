<?php
    include "../includes/user.php";
    include "../includes/conection.php";

    $idUsuari=$_SESSION['nombre'];
    $resp=$_GET['resposta'];
    $date = date('Y-m-d G:i:s ', time());
    $idPubliRes = $_GET['publicacio'];

    $insert="INSERT INTO Resposta SET textResposta = \"$resp\", idPublicacioRenviada  = \"$idPubliRes\", dataResposta = \"$date\", idUsuari = '".$idUsuari."';";
    $insert=mysqli_query($conexio,$insert);
        
    header("Location: fil.php?idPubli=".$idPubliRes);
    die();   
?>
