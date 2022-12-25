<?php
    //verificar identitat
    include "../includes/user.php";
    include "../includes/conection.php";
    $idUsuari=$_SESSION['nombre'];
    //num publicacions
    $numPubli="SELECT Publicacio.idPublicacio FROM Publicacio WHERE idUsuari= '".$idUsuari."'";
    $consultapubli=mysqli_query($conexio,$numPubli);
    $numResults = mysqli_num_rows($consultapubli);
?>
<head>
    <!--Contenidor per a visualitzar perfil i els seus paràmetres. -->
<div id="container">
    <div id="fotoPerfil">
        <img src="../images/user-icon.png" width="115" 
        height="115" alt="Snow">
    </div>
    <div id="nomUsuari">
        <p class="p3"><?php echo '@' . $idUsuari?></p>
    </div>
    <div id="numPublicacions">
        <p class="p3"><?php echo $numResults . ' publicacions'?></p>
    </div>
    
</div>
</head>