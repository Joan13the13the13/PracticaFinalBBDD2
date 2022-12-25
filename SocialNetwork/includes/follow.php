<?php
    include "conection.php";
    $idUsuariSessio=$_SESSION['nombre'];
    echo $idUsuariSessio;
    $idUsuariSeguidor=$_GET['idUsuariSeguidor'];
    $idUsuariSeguit=$_GET['idUsuariSeguit'];
    $opcio=$_GET['seguir'];

    if($opcio==1){//Per a seguir
        $cadena="INSERT INTO seguidor SET idUsuariSeguidor='".$idUsuariSeguidor."', idUsuariSeguit='". $idUsuariSeguit ."';";
    }else{//Per a deixar de seguir
        $cadena="DELETE FROM seguidor WHERE idUsuariSeguidor='".$idUsuariSeguidor."' AND idUsuariSeguit='". $idUsuariSeguit ."';";
    }
    $result=mysqli_query($conexio,$cadena);
    header("Location: /SocialNetwork/html/perfilExtern.php?id=".$idUsuariSeguit);
    die();
?>