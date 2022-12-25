<?php
$conexio=mysqli_connect("localhost","root","")
or die("Fatal error 404: Localhost conection error");
$bd=mysqli_select_db($conexio,"SocialNetwork")
or die("Fatal error 015: DB error");
?>

    