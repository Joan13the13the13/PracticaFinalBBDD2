<?php
    //verificar identitat
    include "../includes/user.php";
    include "../includes/conection.php";
    $idUsuari=$_SESSION['nombre'];
    $idPubli=$_GET['idPubli'];

    $publicacions="SELECT * FROM Publicacio WHERE idPublicacio = '" . $idPubli . "'";
    $consulta1 = mysqli_query($conexio,$publicacions);
    $rowPubli = mysqli_fetch_array($consulta1);
        
?>
<style>
  .container {
    border: 2px solid #dedede;
    background-color: #f1f1f1;
    border-radius: 5px;
    padding: 10px;
    margin: 10px 0;
  
}

.darker {
  border-color: #ccc;
  background-color: #5E9CB0;
  color: white;

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


textarea{
    width: auto;
  }

  div.justified {
        display: flex;
        justify-content: center;
        
}
#container {
  position: relative;
  /*border: 1px solid red;*/
  height: 100px;
}
#charCounter {
  position: absolute;
  top: 16px;
  left: 650px;
}

#buttonResposta{
  position: absolute;
  top: 5px;
  left: 750px;
}
#btnres{
  padding: 15px 25px;
  font-size: 16px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #fff;
  background-color: #04AA6D;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}
#btnres:hover {
  background-color: #3e8e41
}
#btnres:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

/* Style time text */
.time-right {
  float: right;
  color: white;
}

/* Style time text */
.time {
  float: right;
  color: black;
}

</style>

<div id="back">
            <a href="principal.php" ?><img src="../images/back.png" width="50" 
        height="50" alt="Snow"></a>
        </div>
    <div class='container darker'>
        <p><?php    echo "@". $rowPubli["idUsuari"]." : " .$rowPubli["text"] ?></p>
        <span class="time-right"><?php echo $rowPubli["dataPublicacio"];?></span>
    </div>

    <!--DIV per a realitzar una publicació -->
    <form id="formPublicacio" action=<?php echo "insertResposta.php" ?> method="GET">
        <br>
        <br>
        
        <div class="justified">
          <textarea onkeyup="countChar(this);"rows="10" cols="80" id="resposta" placeholder="Respon a la publicació"></textarea>
        </div>
        <br>
        <!--DIV per a tot el contenidor d'abaix la publicació.Botó publicar i seleccionar història. --> 
        <div id="container">
        <div id="charCounter">0/250</div>
        <div id="buttonResposta" >
          <form>
            <input name="resposta" type="hidden" id="textResposta" value="">
            <input name="publicacio" type="hidden" id="idPublicacio" value="<?php echo $rowPubli['idPublicacio'] ?>">
            <button id="btnres" type="submit" form="formPublicacio" onclick="getResposta();">RESPON</button>
          </form>
        </div>
        
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <div style="overflow-y: scroll;">
      <?php    
      $respostes = "SELECT * FROM Resposta WHERE idPublicacioRenviada = '" . $idPubli . "' ORDER BY dataResposta DESC";
      
      $consulta = mysqli_query($conexio,$respostes);  
      
      while($row = mysqli_fetch_array($consulta)){
      ?>
        <div class='container'>
          <style type="text/css">
            a {
                text-decoration:none;
            }
          </style>
        <img src="../images/user-icon.png" >
        <p><?php    echo "@". $row["idUsuari"]." : " .$row["textResposta"] ?></p>
        <span class="time"><?php echo $row["dataResposta"];?></span>
        </div>
        <?php  
        }
        ?>
      </div>


<!--Script per a contar els caràcters de la publicació  -->
<script>
                function countChar(self){
                    var spaces = self.value.length

                    document.getElementById("charCounter").innerHTML=spaces+"/250"
                }

                //Script per a obtenir informació de components exteriors al form.
                function getResposta(self){
                  var valor = document.getElementById('resposta').value;

                  document.getElementById('textResposta').value =valor ;
                }
</script>
</form>