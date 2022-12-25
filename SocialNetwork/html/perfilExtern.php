<?php
    //verificar identitat
    include "../includes/user.php";
    include "../includes/conection.php";
    $idUsuari=$_GET['id'];
    $idsession=$_SESSION['nombre'];
    
    $selected_boutique=NULL;
    
    //num publicacions PUBLIQUES!!!!
    $numPubli="SELECT Publicacio.idPublicacio FROM Publicacio WHERE idUsuari= '".$idUsuari."'";
    $consultapubli=mysqli_query($conexio,$numPubli);
    $numResults = mysqli_num_rows($consultapubli);
    //num seguits
    $seguits="SELECT Seguidor.idUsuariSeguit FROM Seguidor WHERE idUsuariSeguidor = '".$idUsuari."'";
    $consultaseguits=mysqli_query($conexio,$seguits);
    $numseguits = mysqli_num_rows($consultaseguits);
    //num seguidors
    $seguidors= "SELECT Seguidor.idUsuariSeguidor FROM Seguidor WHERE idUsuariSeguit = '".$idUsuari."'";
    $consultaSeguidor=mysqli_query($conexio,$seguidors);
    $numSeguidors = mysqli_num_rows($consultaSeguidor);

    //num Històries
    $numHistories="SELECT Historia.idHistoria,Historia.titol FROM Historia WHERE Historia.idUsuariHist='".$idUsuari."'AND Historia.estat='public';";
    $resultHistories=mysqli_query($conexio,$numHistories);


    //Obtenir relació usuariSessio<->UsuariPerfil
    $relacion="SELECT Seguidor.idUsuariSeguidor FROM Seguidor WHERE idUsuariSeguit = '".$idUsuari."' AND idUsuariSeguidor = '" . $idsession . "'";
    $relacion=mysqli_query($conexio,$relacion);
    $relacio=mysqli_num_rows($relacion);

    if($idsession==$idUsuari){
        header("Location: perfil.php");
    }

    //obtenir opció per a elegir idHistoria
    if(isset ($_GET['idPublicacio'])){
        $selected_boutique = $_GET['idPublicacio'];
        }else{
            $selected_boutique=NULL;
        }


?>

<!DOCTYPE html>
<html>

<head>
<title>Perfil</title>
<style>
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
#container {
    position: relative;
    height: 300px;
    background: #AC99CB;
}
#containerFeed{
    position: relative;
    height: 500px;
}
#fotoPerfil{
    position: absolute;
    top: 50px;
    left: 415px;
}
#nomUsuari{
    position: absolute;
    top: 165px;
    left: 447px;
}
#numPublicacions{
    position: absolute;
    top: 100px;
    left: 600px;
}
#numSeguidors{
    position: absolute;
    top: 100px;
    left: 750px;
}
#numSeguits{
    position: absolute;
    top: 100px;
    left: 900px;
}
#casaHome{
    position:absolute;
    top:0px;
    left:10px;
}
#follow-button{
    position: absolute;
    padding: 15px 25px;
    top: 193px;
    left: 650px;
    color: #3399FF;
    font-size: 10pt;
    background-color: #ffffff;
    border: none;
    border-radius: 15px;
    box-shadow: 0 9px #999;
    cursor: pointer;
}
#follow-button_on {
padding: 15px 25px;
  color: #fff;
  font-size: 10pt;
  background-color: #2EB82E;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;

  position: absolute;	 
  top: 193px;
  left: 650px;	
  cursor: pointer;		    
}
#btnmsg{
  padding: 15px 25px;
  position: absolute;
  top: 193px;
  left: 800px;
  font-size: 10pt;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: black;
  background-color: white;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}
#btnmsg:hover {
  background-color: #3e8e41;
}
#btnmsg:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
img {  
    object-fit: cover;  
}
.p3 {
  font-family: "Lucida Console", "Courier New", monospace;
}

.nav{
    border:1px solid #ccc;
    border-width:1px 0;
    list-style:none;
    margin:0;
    padding:0;
    text-align:center;
}
.nav li{
    display:inline;
}
.nav a{
    display:inline-block;
    padding:10px;
}
.home{
   position:fixed;
   top:36px;
   left:10px;
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

</style>

</head>

<body>

<!--Contenidor per a visualitzar perfil i els seus paràmetres. -->
<div id="container">
    <div id="fotoPerfil">
        <img src="../images/user-icon.png" width="115" 
        height="115" alt="Snow">
    </div>
    <div id="casaHome">
            <a href="principal.php"><img src="../images/home.png" width="50" 
     height="50" alt="Snow"></a>
    </div>
    <div id="nomUsuari">
        <p class="p3"><?php echo '@' . $idUsuari?></p>
    </div>
    <div id="numPublicacions">
        <p class="p3"><?php echo $numResults . ' publicacions'?></p>
    </div>
    <?php $cadena="seguidors.php?id=" . $idUsuari ?>
    <a href=<?php echo $cadena?>><div id="numSeguidors">
        <p class="p3"><?php echo $numSeguidors .'  seguidors'?></p>
    </div>
    <?php $cadena2="seguits.php?id=" .$idUsuari?>
    <a href=<?php echo $cadena2?>><div id="numSeguits">
        <p class="p3"><?php echo $numseguits . '  seguits'?></p>
    </div>
    <!--BOTO PER A SEGUIR -->
    <form action="../includes/follow.php"  method="get">
            <input name="idUsuariSeguidor" type="hidden" value=<?php echo $idsession ?>>
            <input name="idUsuariSeguit" type="hidden" value=<?php echo $idUsuari ?>>
        <?php if($relacio==0){
            echo "<input name='seguir' type='hidden' value='1'>"; 
            $cadena ="<button id='follow-button'>+ FOLLOW</button>";
         }else{
            echo "<input name='seguir' type='hidden' value='0'>";  
            $cadena ="<button id='follow-button_on'>FOLLOWING</button>";
        } 
        echo $cadena;
        ?>
    <a class="button" href= <?php echo "chat.php?id=" . $idUsuari;?> id="btnmsg" type="submit">ENVIA MISSATGE</a>
    <!--header("Location: principal.php");-->
    </form>


</div>
<!--Contenidor per a visualitzar publicacions segons història. -->
<div id="containerFeed">
<ul class="nav">
  <li><a><p class="p3">Història</p></a></li>
  <!--Seleccionar històries -->
  <li> 
  <form action="perfilExtern.php" method ="GET"> 
  <select onchange="this.form.submit()" name="idPublicacio" id="idPublicacio">
    
    <option value='null'>General</option>
        <?php
        while($row=mysqli_fetch_array($resultHistories)){?>
            <?php
            if($selected_boutique !=$row['idHistoria'] ){
                echo '<option value="'. $row['idHistoria'] . '"> '. $row['titol'] . '</option>';
            }
        }
            ?> 
        <input type="hidden" name="id" id="id" value=<?php echo $idUsuari ?>>
</select>
    </form></li>
</ul>
<?php
    $textPubli="SELECT * FROM Publicacio WHERE idUsuari= '".$idUsuari."'";
    $consulta=mysqli_query($conexio,$textPubli);
?>

    <div style="overflow-y: scroll;">
      <?php
      if($selected_boutique==NULL){
        $publicacions = "SELECT * FROM Publicacio WHERE idUsuari = '" . $idUsuari . "' AND Publicacio.idHistoria IS NULL ORDER BY dataPublicacio DESC;";
      }else{
        $publicacions = "SELECT * FROM Publicacio WHERE idUsuari = '" . $idUsuari . "'AND Publicacio.idHistoria='".$selected_boutique."' ORDER BY dataPublicacio DESC;";
      }
    
      
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
        <img src="https://imgs.search.brave.com/RSJalzuzuGWJ1Go6Niw4RqlpWLyzCRVGQd34z_hVW8g/rs:fit:474:225:1/g:ce/aHR0cHM6Ly90c2Uy/Lm1tLmJpbmcubmV0/L3RoP2lkPU9JUC43/OWFNOTR6eVJMNlF5/b05YMlpLd3dnSGFI/YSZwaWQ9QXBp">
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

<?php
    if(isset($row["idHistoria"])){

        $idHist="SELECT idHistoria FROM Publicacio WHERE text= '".$row['text']."'";
        $consulta2=mysqli_query($conexio,$idHist);
        //$rowhist=mysqli_fetch_array($consulta);

        $titolHist="SELECT titol FROM Historia WHERE idHistoria= '".$row['idHistoria']."'";
        $consulta3=mysqli_query($conexio,$titolHist);
        $rowtitol=mysqli_fetch_array($consulta3);
?>

<?php 
    } 
?>
</div>


</body>

</html>
