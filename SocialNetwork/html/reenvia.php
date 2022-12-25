<?php
    //verificar identitat
    include "../includes/user.php";
    include "../includes/conection.php";
    $idsession=$_SESSION['nombre'];
    $idPubli=$_GET['idPubli'];
    $date = date('Y-m-d G:i:s ', time());

    $publicacions="SELECT * FROM Publicacio WHERE idPublicacio = '" . $idPubli . "'";
    $consulta1 = mysqli_query($conexio,$publicacions);
    $rowPubli = mysqli_fetch_array($consulta1);

    $text ="Publicació de " .$rowPubli['idUsuari']. "--> " .$rowPubli['text'];

    $string = "INSERT INTO Publicacio SET text = \"$text\", dataPublicacio = \"$date\", idUsuari = '".$idsession."'";
    $insert = mysqli_query($conexio,$string);
    header("Location: /SocialNetwork/html/perfilExtern.php?id=". $idsession);
    die();
?>