<?php
    include "../includes/user.php";
    include "../includes/conection.php";
    $prova = $_GET["search"];
    $idsession = $_SESSION['nombre'];

    $string="SELECT Usuari.idUsuari,Usuari.nom,Usuari.cognom FROM Usuari WHERE idUsuari LIKE '" . $prova . "%'";
    $consulta=mysqli_query($conexio,$string);
    $count=mysqli_num_rows($consulta);
    
    if ($count>0) {
        ?>
    <div style="text-align:center;">
        <table border="1" style="margin: 0 auto;">
     <tr>
                <td>Nom Usuari</td>
                <td>Nom</td>
                <td>Cognom</td>
            </tr>
    <?php 
        while($row=mysqli_fetch_array($consulta)){
    ?>      
            <tr>
            <?php 
                $cadena="perfilExtern.php?id=" . $row["idUsuari"]; 
                if($row["idUsuari"]==$idsession){
                    $cadena="perfil.php";
                }
                ?>
                <td><a href=<?php echo $cadena; ?>><?php echo "@" . $row["idUsuari"]; ?></a></td>
                <td><?php echo $row["nom"];?></td>
                <td><?php echo $row["cognom"];?></td>
             </tr>
            <?php
            }
    ?> 
        </table>
    </div> 
    <?php
    }else{
        echo "No s'ha trobat res";
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