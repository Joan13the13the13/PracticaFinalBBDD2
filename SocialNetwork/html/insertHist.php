<?php
    include "../includes/user.php";
    include "../includes/conection.php";

    $idUsuari=$_SESSION['nombre'];

    $titol=$_GET['titol'];
    $estat=$_GET['estat'];
    $text=$_GET['publicacio'];
    $hist=$_GET['historia'];
    $date = date('Y-m-d G:i:s ', time());

    $insert2="INSERT INTO Publicacio SET text = \"$text\", dataPublicacio = \"$date\", idUsuari = \"$idUsuari\"";
    $insert2=mysqli_query($conexio,$insert2);

    if(!is_null($text)){

        $insert1="INSERT INTO Historia SET titol = \"$text\",  estat = \"$estat\"";
        $insert1=mysqli_query($conexio,$insert1);
    
        $string1="SELECT idHistoria FROM Historia WHERE titol = '".$text."' ";
        $consulta1=mysqli_query($conexio,$string1);
    
        $string2="SELECT FROM Publicacio WHERE (dataPublicacio = \"$date\") AND (text = \"$text\")";
        $consulta2=mysqli_query($conexio,$string2);
    
        $insert3="INSERT INTO Publicacio_Historia SET idHistoria = \"$consulta1\", idPublicacio = \"$consulta2\"";
        $insert3=mysqli_query($conexio,$insert3);

    }

    header("principal.php");

?>