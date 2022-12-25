<?php
    include "../includes/user.php";
    include "../includes/conection.php";

    $idUsuari=$_SESSION['nombre'];
    $tweet=$_GET['publicacio'];
    $date = date('Y-m-d G:i:s ', time());


    $insert2="INSERT INTO Publicacio SET text = \"$tweet\", dataPublicacio = \"$date\", idUsuari = '".$idUsuari."'";
    $insert2=mysqli_query($conexio,$insert2);

    if(isset($_GET['titol'])){
        //Obtenir paràmetres insert
        $text=$_GET['titol'];
        $estat=$_GET['estatHistoria'];
        
        //EXISTEIX LA HISTÒRIA?
        $string1="SELECT Historia.idHistoria FROM Historia WHERE titol = '".$text."' ";
        $consulta1=mysqli_query($conexio,$string1);
        $idHistoria=$consulta1->fetch_array()[0] ?? ''; //Convertir a String
        
        //CAS NOVA HISTÒRIA
        if((mysqli_num_rows($consulta1)==0) && ($text!='NULL')){
            $insert1="INSERT INTO Historia SET titol = '".$text."',  estat = '".$estat."',idUsuariHist='".$idUsuari."';";
            $insert1=mysqli_query($conexio,$insert1);

            $string1="SELECT Historia.idHistoria FROM Historia WHERE titol = '".$text."' ";
            $consulta1=mysqli_query($conexio,$string1);
            $idHistoria=$consulta1->fetch_array()[0] ?? '';
            echo 'nova historia';
        }

        $updatePubli="UPDATE Publicacio SET idHistoria='".$idHistoria."' WHERE Publicacio.text='".$tweet."' AND Publicacio.dataPublicacio='".$date."';";
        $updatePubli=mysqli_query($conexio,$updatePubli);
    }

    header("Location: principal.php");
    die();

?>