<?php
    //verificar identitat
    include "../includes/user.php";
    include "../includes/conection.php";
    $idUsuari=$_SESSION['nombre'];
    $selected_boutique=NULL;
    
    //num publicacions
    $numPubli=" (SELECT DISTINCT idUsuariReceptor FROM Missatge WHERE idUsuariEmissor= '".$idUsuari."') 
                UNION (SELECT DISTINCT idUsuariEmissor FROM Missatge WHERE idUsuariReceptor= '".$idUsuari."')";
    $consultapubli=mysqli_query($conexio,$numPubli);
   
    
    $numResults = mysqli_num_rows($consultapubli);

    if ($numResults>0) {
        ?>
    <div id="back">
            <a href="principal.php"><img src="../images/back.png" width="50" 
        height="50" alt="Snow"></a>
        </div>
    <div class="container" style="text-align:center;">
        <table border="1" style="margin: 0 auto;">
     <tr>
        <td>Xats OBERTS</td>
        <td>Darrer Missatge Rebut</td>
    </tr>
    <?php 
        while($row=mysqli_fetch_array($consultapubli)){
            $string2 = "SELECT idUsuari,nom, cognom FROM Usuari WHERE idUsuari = '" . $row["idUsuariReceptor"] . "'";
            $darrerMissatge = "SELECT descripcio FROM Missatge WHERE Missatge.idUsuariReceptor = '" . $idUsuari . "' AND Missatge.idUsuariEmissor = '" . $row["idUsuariReceptor"] . "' ORDER BY dataEnviat ASC LIMIT 1;";
            $darrerMissatge = mysqli_query($conexio,$darrerMissatge);
            $row3 = mysqli_fetch_array($darrerMissatge);
            $consulta2 = mysqli_query($conexio,$string2);
            $row2 = mysqli_fetch_array($consulta2);
    ?>      
            <tr>
                <?php 
                $cadena="chat.php?id=" . $row2["idUsuari"]; 
                ?>
                
                    <td><a href=<?php echo $cadena; ?>><?php echo "@" . $row2["idUsuari"]; ?></a></td>
                    <td><?php if(mysqli_num_rows($darrerMissatge)){ echo $row3['descripcio'];}else{echo "No t'ha contestat";} ?></td>
                
             </tr>
            <?php
            }
    ?> 
        </table>
    </div> 
    <?php
    }else{
        echo "Encara no tens missatges";
    }
        ?>

<html>
    <style>
body {
  font-family: 'lato', sans-serif;
}
.back{
   position:relative;
   top:36px;
   left:10px;
  }

.container {
    max-width: 1000px;
    margin-left: auto;
    margin-right: auto;
    padding-left: 10px;
    padding-right: 10px;
}
#subcontainer{
    position: absolute;
    top:100px;
    width:1000px;
    height:50px;
    margin-left: auto;
    margin-right: auto;
    padding-left: 10px;
    padding-right: 10px;
    border: 1px solid blue;
}
#row{
    position: absolute;
    top:15px;
    left:500px;
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