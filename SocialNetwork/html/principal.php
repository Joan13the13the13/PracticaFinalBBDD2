<?php
    include "../includes/user.php";
    include "../includes/conection.php";
    $idUsuari=$_SESSION['nombre'];
    $consultaHistories="SELECT DISTINCT Historia.idHistoria,Historia.titol,Historia.estat FROM Historia JOIN Publicacio ON Historia.idHistoria=Publicacio.idHistoria WHERE Publicacio.idUsuari= '" .$idUsuari . "';";
    $resultatHist=mysqli_query($conexio,$consultaHistories);
?>

<!DOCTYPE html>
<html>
<head>
<title>Home</title>
    <!-- Importam CSS-->
    <link href="../css/principal.css" rel="stylesheet" media="all">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

   <style type="text/css">
    /*

    */
    * {
        box-sizing: border-box;
      }
      .openBtn {
        display: flex;
        justify-content: left;
      }
      .openButton {
        border: none;
        border-radius: 5px;
        background-color: #1c87c9;
        color: white;
        padding: 14px 20px;
        cursor: pointer;
        position: fixed;
      }
      .loginPopup {
        position: relative;
        text-align: center;
        width: 100%;
      }
      .formPopup {
        display: none;
        position: fixed;
        left: 45%;
        top: 5%;
        transform: translate(-50%, 5%);
        border: 3px solid #999999;
        z-index: 9;
      }
      .formContainer {
        max-width: 300px;
        padding: 20px;
        background-color: #fff;
      }
      .formContainer input[type=text],
      .formContainer input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 20px 0;
        border: none;
        background: #eee;
      }
      .formContainer input[type=text]:focus,
      .formContainer input[type=password]:focus {
        background-color: #ddd;
        outline: none;
      }
      .formContainer .btn {
        padding: 12px 20px;
        border: none;
        background-color: #8ebf42;
        color: #fff;
        cursor: pointer;
        width: 100%;
        margin-bottom: 15px;
        opacity: 0.8;
      }
      .formContainer .cancel {
        background-color: #cc0000;
      }
      .formContainer .btn:hover,
      .openButton:hover {
        opacity: 1;
      }
      .container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
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
  position:relative;
  /*float: left;*/
  top:-50px;
  left:650px;
  color: #999;
}

    /*
    */
 .topcorner{
   position:fixed;
   top:10px;
   right:10px;
  }
  .topcornerMssg{
   position:fixed;
   top:10px;
   right:80px;
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
#userTag{
  position:relative;
  top: 130px;
  left: -500px;
}

#charCounter {
  position: absolute;
  top: 0px;
  left: 415px;
}
#selectHist{
  position: absolute;
  top: 10px;/*67px, 500 px */
  left: 750px;
}
#buttonPublica{
  position: absolute;
  top: 5px;
  left: 900px;
}
#btnpubli{
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
#btnpubli:hover {
  background-color: #3e8e41
}
#btnpubli:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
</style>
</head>
 <body>
        <!--CERCADOR -->
        <div class="search-container">
            <input type="text" name="search" id="cercador" placeholder="Search..." class="search-input">
            <a href="javascript:enviaFormulariCerca(this);" class="search-btn">
                <i class="fas fa-search"></i>     
            </a>
        </div>
        <!--FORMULARI AMAGAT CERCADOR -->
        <form action="cerca.php" id="formulariCerca" method="GET">
          <input type="hidden" name="search" id="textEnviat" value="">
        </form>

        <!--SIGNE PERFIL -->
        <div class="topcorner">
            <a href="perfil.php"><img src="../images/user-icon.png" width="50" 
     height="50" alt="Snow"></a>
        </div>
        <!--SIGNE MISSATGES -->
        <div class="topcornerMssg">
            <a href="messages.php"><img src="../images/avionPapel.png" width="50" 
        height="50" alt="Snow"></a>
        </div>
        
        <!--DIV per a realitzar una publicació -->
        <form id="formPublicacio" action="insertPubli.php" method="GET">
        <br>
        <br>
        <br>
        <br>
        <div class="justified">
          <textarea onkeyup="countChar(this);"rows="10" cols="80" id="publicacio" placeholder="En qué estas pensant?"></textarea>
        </div>
        <br>
        <!--DIV per a tot el contenidor d'abaix la publicació.Botó publicar i seleccionar història. -->
        <div id="container">
        <div id="charCounter">0/250</div>
        <div id="buttonPublica" header="perfil.php">
          <form>
            <input name="publicacio" type="hidden" id="publicacioAtribut" value="">
            <input name="titol" type="hidden" id="histPublicacio" value="">
            <input name="estatHistoria" type="hidden" id="estatHistoria" value="">
            <button id="btnpubli" type="submit" form="formPublicacio" onclick="getPublicacio();">PUBLICA</button>
          </form>
        </div>

        <div id="selectHist"><select class="select" onchange="openForm();" id="selecHistoria">
            <option value="NULL">Ninguna</option>
            <option value="new">Nova</option>
            <?php
                while($row=mysqli_fetch_array($resultatHist)){?>
            <?php
                  echo '<option value="'. $row['titol'] . '"> '. $row['titol'] . '</option>';
              }
            ?> 
            </select></div>
        </div>

        <!--FORMULARI AMAGAT -->
      <div class="loginPopup">
      <div class="formPopup" id="popupForm">
        <form action="insertPubli.php" method="GET" class="formContainer">
          <h2>Insereix una nova Història</h2>
          <label for="titol">
            <strong>Títol</strong>
          </label>
          <input type="text" id="titolHistoriaForm" placeholder="Títol Historia" name="titol" required>
          <label for="psw">
            <strong>Estat</strong>
          </label>
          <select id="formEstatHist">
            <option>Selecciona una opción</option>
              <option value="public">Pública</option>
              <option value="privat">Privada</option>
          </select>
          <!--TEXT -->
          <input name="publicacio" type="hidden" id="publicacioForm" value="">
          <!-- ESTAT HISTORIA-->
          <input name="estatHistoria" type="hidden" id="estatHistoriaForm" value="">
          <!-- -->
          <button id=btnpubli type="submit" onclick="publicaHist();">CREAR I PUBLICAR</button>
        </form>
      </div>
      <div style="overflow-y: scroll;">
      <?php    
      $publicacions = "SELECT text, idPublicacio, dataPublicacio, idUsuari, idHistoria FROM Publicacio WHERE idUsuari IN 
      (SELECT idUsuariSeguit FROM Seguidor WHERE idUsuariSeguidor = '" . $idUsuari . "') 
      AND (Publicacio.idHistoria IN (SELECT idHistoria FROM Historia WHERE Historia.estat != \"privat\") OR Publicacio.idHistoria IS NULL) ORDER BY dataPublicacio DESC;";
      
      $consulta = mysqli_query($conexio,$publicacions);  
      
      while($row = mysqli_fetch_array($consulta)){
        $historia="SELECT historia.titol FROM historia WHERE historia.idHistoria='".$row['idHistoria']."';";
        $historia=mysqli_query($conexio,$historia);
        $nomHistoria=$historia->fetch_array()[0] ?? ''; //Convertir a String
      ?>
      
        
        <div class='container'>
        <a href=<?php echo "fil.php?idPubli=".$row['idPublicacio'] ?>>
          <style type="text/css">
            a {
                text-decoration:none;
            }
          </style>
        <img src="../images/contesta.png">
        <a href=<?php echo "reenvia.php?idPubli=" .$row['idPublicacio']?>><img src="../images/enviar.png" width="50" 
     height="50" alt="Snow"></a>
        <p><?php    echo "@". $row["idUsuari"]." : " .$row["text"] ?></p>
        <span class="time-right"><?php echo $row["dataPublicacio"];?></span>
        <?php if(!is_null($row['idHistoria'])){
              $cadena="<span class=time-left>Historia: ". $nomHistoria ."</span>";
              echo $cadena;
          ?>
        
        <?php  
        }
        ?>
      
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
                function getPublicacio(self){
                  var valor = document.getElementById('publicacio').value;
                  var hist  = document.getElementById('selecHistoria').value;
                  var estat = document.getElementById('formEstatHist').value;

                  document.getElementById('publicacioAtribut').value =valor ;
                  document.getElementById('histPublicacio').value =hist ;
                  document.getElementById('estatHistoria').value = estat;
                }
                //Canviar historia
                function publicaHist(self){
                  //obtenir atributs
                  var valor =document.getElementById('publicacio').value;
                  var estatHist=document.getElementById('formEstatHist').value;
                  
                  //assignar atributs
                  document.getElementById('publicacioForm').value = valor;
                  document.getElementById('estatHistoriaForm').value =estatHist ;

                  document.getElementById("popupForm").style.display = "none";
                }
                //obrir formulari
                function openForm(self) {
                  var value=document.getElementById("selecHistoria").value;
                  if(value=='new'){
                      document.getElementById("popupForm").style.display = "block";
                  }
                }
                //tancar formulari
                function closeForm(self) {
                  document.getElementById("popupForm").style.display = "none";
                }
                function enviaFormulariCerca(self){
                  var text=document.getElementById("cercador").value;
                  document.getElementById("textEnviat").value=text;
                  document.getElementById("formulariCerca").submit();
                }
            </script>
        </form>
        
    
        
</body>
</html>