<?php
    session_start();
    if (isset($_SESSION['nombre']))
        echo " ";
    else
        echo "Error";
?>