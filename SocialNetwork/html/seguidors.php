<?php
    include "../includes/user.php";
    include "../includes/conection.php";
    $idUsuari=$_GET['id'];
    $idsession=$_SESSION['nombre'];

    $string="SELECT idUsuariSeguidor FROM Seguidor 
    WHERE idUsuariSeguit = '" . $idUsuari . "'";

    $consulta=mysqli_query($conexio,$string);
    $count=mysqli_num_rows($consulta);
    ?>
    <div id="back">
        <a href=<?php echo "perfilExtern.php?id=".$idUsuari?>><img src="../images/back.png" width="50" 
        height="50" alt="Snow"></a>
    </div>
    <?php
    if ($count>0) {
        ?>
    <div class="container" style="text-align:center;">
        <table border="1" style="margin: 0 auto;">
     <tr>
                <td>Nom Usuari</td>
                <td>Nom</td>
                <td>Cognom</td>
            </tr>
    <?php 
        while($row=mysqli_fetch_array($consulta)){
            $string2 = "SELECT idUsuari,nom, cognom FROM Usuari WHERE idUsuari = '" . $row["idUsuariSeguidor"] . "'";
            $consulta2 = mysqli_query($conexio,$string2);
            $row2 = mysqli_fetch_array($consulta2);
    ?>      
            <tr>
                <?php 
                $cadena="perfilExtern.php?id=" . $row2["idUsuari"]; 
                if($row2["idUsuari"]==$idsession){
                    $cadena="perfil.php";
                }
                ?>
                <td><a href=<?php echo $cadena; ?>><?php echo "@" . $row2["idUsuari"]; ?></a></td>
                <td><?php echo $row2["nom"];?></td>
                <td><?php echo $row2["cognom"];?></td>
             </tr>
            <?php
            }
    ?> 
        </table>
    </div> 
    <?php
    }else{
        echo "Encara no tens seguidors";
    }
        ?>

<html>
    <style>
body {
  font-family: 'lato', sans-serif;
}
.container {
  max-width: 1000px;
  margin-left: auto;
  margin-right: auto;
  padding-left: 10px;
  padding-right: 10px;
}
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}
tr:nth-child(n) {background-color: #C5EFF6;}
tr:nth-child(1) {background-color: #939393;}


    </style>
</html>