<?php
    include "../includes/conection.php";
    
    $nom = $_POST['name'];
    $cognom = $_POST['last_name'];
    $dataNaixement = $_POST['birth'];
    $sexe = $_POST['gen'];
    $correu = $_POST['mail'];
    $telefon = $_POST['telf'];
    $userlocal = $_POST['username'];
    $passlocal = $_POST['password'];
    
    $insert="INSERT INTO Usuari SET idUsuari = \"$userlocal\", nom = \"$nom\", cognom = \"$cognom\", dataNaixament = \"$dataNaixement\", 
    telefon = \"$telefon\", email = \"$correu\", contrasenya = \"$passlocal\", sexe = \"$sexe\"";
    
    $insert=mysqli_query($conexio,$insert);  
    header("Location: /SocialNetwork/html/index.html");
    die();   
?>