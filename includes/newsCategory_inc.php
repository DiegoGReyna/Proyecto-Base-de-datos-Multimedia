<?php
include "../classes/newsCategory-contr.classes.php";
    if(isset($_POST["ajax_sumbit_all"])){ 
        $categories = newsCategory::cats()->getAllCategories();
        echo json_encode($categories);
    }
    if(isset($_POST["ajax_sumbit"])){ 
        $categories = newsCategory::cats()->getCategories();
        echo json_encode($categories);
    }
    if(isset($_POST["ajax_sumbit_five"])){ 
        $categories = newsCategory::cats()->getFiveCategories();
        echo json_encode($categories);
    }
    if(isset($_POST["category"])){
        $catID = $_POST["id_Category"];
        echo $catID;
        $categories = newsCategory::cats()->selectSingleCategpry($catID);
        header("location: ../html/Noticias.php");
    }
?>