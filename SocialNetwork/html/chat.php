<?php
    //verificar identitat
    include "../includes/user.php";
    include "../includes/conection.php";
    $idUsuari=$_GET['id'];
    $idsession=$_SESSION['nombre'];

    $mensajes = "SELECT * FROM Missatge WHERE 
    (missatge.idUsuariEmissor = '".$idUsuari."' AND missatge.idUsuariReceptor='".$idsession."')
    UNION
    (SELECT * FROM Missatge WHERE 
    (missatge.idUsuariReceptor = '".$idUsuari."'  AND missatge.idUsuariEmissor= '".$idsession."'))
    ORDER BY dataEnviat DESC;";
    $consulta = mysqli_query($conexio,$mensajes);
    ?>
        <div id="back">
            <a href="messages.php"><img src="../images/back.png" width="50" 
        height="50" alt="Snow"></a>  
        </div> 
        
        <h1 align = "center"><?php echo "Xat amb " .$idUsuari. ":";?></h1>
    
    <?php 

    while ($row= mysqli_fetch_array($consulta)) {
    
    if ($row['idUsuariEmissor']==$idsession) {
        $tipo = "container";
        $time = "time-right";
        $img = "right";
        $escritor = "TU";
        
    }else{
        $tipo = "container darker";
        $time = "time-left";
        $img = "left";
        $escritor = "@".$row['idUsuariEmissor'];
    }
    
    ?>

        <div class=<?php echo $tipo ?>>
        <img src="../images/user-icon.png" alt="Avatar" class=<?php echo $img; ?>>
        <p><?php echo $escritor.":      ".$row["descripcio"];?></p>
        <span class=<?php echo $time;?>><?php echo $row["dataEnviat"];?></span>
        </div>

    <?php
    }
?>
<div id = 'contenidor1' class = 'containerEnviaMissatge'>
  <form action="../includes/enviaMissatge.php" method="GET">
  <textarea id="publicacio" name="text"placeholder="Escriu un missatge"></textarea>
  <input type="hidden" name="id" value=<?php echo $idUsuari ?>></input>
  <button class="button button1">Enviar</button>
  </form>
</div>

<style>
textarea { height: auto; }
/* Chat containers */
.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}
.containerEnviaMissatge{
  position: fixed;
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  width: 1465px;
  height: 500px;
  left: 50%;
  top: 95%;
  margin-left: -735px; 
 
}
.containerEnviaMissatge2{
  position: fixed;
  width: 750px;
  height: 900px;
  left: 50%;
  top: 95%;
  margin-left: -725px; 
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
}
/* Darker chat container */
.darker {
  border-color: #ccc;
  background-color: #ddd;
}

/* Clear floats */
.container::after {
  content: "";
  clear: both;
  display: table;
}

/* Style images */
.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

/* Style the right image */
.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

/* Style time text */
.time-right {
  float: right;
  color: #aaa;
}

/* Style time text */
.time-left {
  float: left;
  color: #999;
}

textarea {
  resize: none;
  height: 30px;
  float: left;width:90%;
}

.button1 {
  background-color: lightGreen;
  float: right;
  width:10%;
  height: 30;
  cursor: pointer;

}



</style>
<META http-equiv=refresh
      content=<?php echo "'30; URL=chat.php?id=". $idUsuari. "'"?>>