<?php
    //verificar identitat
    include "../includes/user.php";
    include "../includes/conection.php";
    $idUsuari=$_SESSION['nombre'];
    $selected_boutique=NULL;
    
    //num publicacions
    $numPubli="SELECT DISTINCT Publicacio.idPublicacio FROM Publicacio JOIN Historia ON Publicacio.idHistoria=Historia.idHistoria WHERE Publicacio.idUsuari= '".$idUsuari."' AND Historia.estat='public'";
    $numPubli=$numPubli . "UNION (SELECT DISTINCT Publicacio.idPublicacio FROM Publicacio WHERE Publicacio.idHistoria IS NULL AND Publicacio.idUsuari='" .$idUsuari ."');";
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

    //obtenir opció per a elegir idHistoria
    if(isset ($_GET['idPublicacio'])){
        if($_GET['idPublicacio']!='NULL'){
            $selected_boutique = $_GET['idPublicacio'];
        }else{
            $selected_boutique=NULL;
        }
        }else{
            $selected_boutique=NULL;
        }
?>

<!DOCTYPE html>
<html>

<head>
<title>Perfil</title>
<style>
#container {
    position: relative;
    height: 300px;
    background: rgb(37, 150, 190);
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

#logOut{
    position:absolute;
    top:10px;
    right:10px;
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
.custom-select {
  position: relative;
  font-family: Arial;
}

.custom-select select {
  display: none; /*hide original SELECT element: */
}

.select-selected {
  background-color: DodgerBlue;
}

/* Style the arrow inside the select element: */
.select-selected:after {
  position: absolute;
  content: "";
  top: 14px;
  right: 10px;
  width: 0;
  height: 0;
  border: 6px solid transparent;
  border-color: #fff transparent transparent transparent;
}

/* Point the arrow upwards when the select box is open (active): */
.select-selected.select-arrow-active:after {
  border-color: transparent transparent #fff transparent;
  top: 7px;
}

/* style the items (options), including the selected item: */
.select-items div,.select-selected {
  color: #ffffff;
  padding: 8px 16px;
  border: 1px solid transparent;
  border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
  cursor: pointer;
}

/* Style items (options): */
.select-items {
  position: absolute;
  background-color: DodgerBlue;
  top: 100%;
  left: 0;
  right: 0;
  z-index: 99;
}

/* Hide the items when the select box is closed: */
.select-hide {
  display: none;
}

.select-items div:hover, .same-as-selected {
  background-color: rgba(0, 0, 0, 0.1);
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
    <div id="casahome">
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
    <a href=<?php echo $cadena ?>><div id="numSeguidors">
        <p class="p3"><?php echo $numSeguidors .'  seguidors'?></p>
    </div>
    <?php $cadena2="seguits.php?id=" . $idUsuari ?>
    <a href=<?php echo $cadena2 ?>><div id="numSeguits">
        <p class="p3"><?php echo $numseguits . '  seguits'?></p>
    </div>
    <div id="logOut">
            <a href="index.html"><img src="../images/logOut.png" width="50" 
     height="50" alt="Snow"></a>
    </div>
</div>
<!--Contenidor per a visualitzar publicacions segons història. -->
<div id="containerFeed">
<ul class="nav">
  <li><a><p class="p3">Nom Historia</p></a></li>
  <!--Seleccionar històries -->
  <li> 
  <form action="perfil.php" method ="GET"> 
  <select onchange="this.form.submit()" name="idPublicacio" class="custom-select">
    <option value=NULL>General</option>
        <?php
        if($selected_boutique==NULL){
            $publicacions = "SELECT text, dataPublicacio, idUsuari, idHistoria FROM Publicacio WHERE idUsuari = '" . $idUsuari . "' AND Publicacio.idHistoria IS NULL ORDER BY dataPublicacio DESC;";
          }else{
            $publicacions = "SELECT text, dataPublicacio, idUsuari, idHistoria FROM Publicacio WHERE idUsuari = '" . $idUsuari . "'AND Publicacio.idHistoria='".$selected_boutique."' ORDER BY dataPublicacio DESC;";
          }
          $histories="SELECT DISTINCT Historia.idHistoria,Historia.titol FROM (Historia JOIN Publicacio ON Historia.idHistoria=Publicacio.idHistoria) WHERE Publicacio.idUsuari='".$idUsuari ."';";
          $histories=mysqli_query($conexio,$histories);
        while($row=mysqli_fetch_array($histories)){?>
            <?php
            if($selected_boutique !=$row['idHistoria'] ){
                echo '<option value="'. $row['idHistoria'] . '"> '. $row['titol'] . '</option>';
            }else{
                if($row['idHistoria']!='NULL'){
                    echo '<option selected="selected"value="'. $row['idHistoria'] . '"> '. $row['titol'] . '</option>';
                }else{
                    echo '<option selected="selected"value='. NULL . '> '. $row['titol'] . '</option>';
                    echo "CASO NULL";
                }
            }
        }
            ?> 
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
        $publicacions = "SELECT * FROM Publicacio WHERE idUsuari = '" . $idUsuari . "'AND Publicacio.idHistoria='".$selected_boutique."'ORDER BY dataPublicacio DESC;";
      }
    
      
      $consulta = mysqli_query($conexio,$publicacions);  
      
      while($row = mysqli_fetch_array($consulta)){
        $historia="SELECT historia.titol FROM historia WHERE historia.idHistoria='".$row['idHistoria']."';";
        $historia=mysqli_query($conexio,$historia);
        $nomHistoria=$historia->fetch_array()[0] ?? ''; //Convertir a String
        
      ?>

<div class='container'>
        <a href=<?php echo "fil.php?idPubli=".$row['idPublicacio'] ?> > 
        <img src="https://imgs.search.brave.com/RSJalzuzuGWJ1Go6Niw4RqlpWLyzCRVGQd34z_hVW8g/rs:fit:474:225:1/g:ce/aHR0cHM6Ly90c2Uy/Lm1tLmJpbmcubmV0/L3RoP2lkPU9JUC43/OWFNOTR6eVJMNlF5/b05YMlpLd3dnSGFI/YSZwaWQ9QXBp">
        </a>
          <style type="text/css">
            a {
                text-decoration:none;
            }
          </style>
        
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