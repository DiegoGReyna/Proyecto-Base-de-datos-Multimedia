<?php
include "../classes/navBar-contr.classes.php";
session_start();
 if(isset($_POST["submit"])){
    if(isset($_SESSION["USER_ID"])){
        session_destroy();
        ?>
        <script>window.location.replace("../html/index.php");</script>
        <?php 
    }
 }
 if(isset($_POST["search"])){
    $Id_FechaI = (isset($_POST["Id_FechaI"])) ?  date('Y-m-d', strtotime($_POST["Id_FechaI"])) : '';
    $Id_FechaF = (isset($_POST["Id_FechaF"])) ?  date('Y-m-d', strtotime($_POST["Id_FechaF"])) : '';
    $Titulo = (isset($_POST["Titulo"])) ? $_POST["Titulo"] : '';
    $Id_PalabrasClaves = (isset($_POST["Id_PalabrasClaves"])) ? $_POST["Id_PalabrasClaves"] : '';

    $search = new navBar($Id_FechaI,$Id_FechaF,$Titulo,$Id_PalabrasClaves);
    $search->searching();
    header("location: ../html/NoticiasSearch.php");
 }
?>