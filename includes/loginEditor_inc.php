<?php
include "../classes/loginEditor-contr.classes.php";
    if(isset($_POST["ajax_edit_color"])){
        $catID = $_POST["catID"];
        $catColor = $_POST["catColor"];

        $color = LoginContr::cats()->editColorCat($catID,$catColor);
        echo json_encode($color);
    }
    if(isset($_POST["ajax_add_cat"])){
        $catName = $_POST["catName"];
        $catDesc = $_POST["catDesc"];
        $catColor = $_POST["catColor"];
        $catOrder = $_POST["ordenSec"];

        $cat = LoginContr::cats()->addCat($catName,$catDesc,$catColor,$catOrder);
        echo json_encode($cat);
    }
    if(isset($_POST["ajax_edit_order_cat"])){
        $catName = $_POST["catName"];
        $catOrder = $_POST["ordenSec"];

        $order = LoginContr::cats()->editOrderCat($catName,$catOrder);
        echo json_encode($order);
    }
    if(isset($_POST["ajax_pending_news"])){
        $pending_news = LoginContr::cats()->pending_news();
        echo json_encode($pending_news);
    }
    if(isset($_POST["ajax_sumbit_rep"])){
        $opc = $_POST["opc"];
        $reporteros = LoginContr::cats()->reporteros($opc);
        echo json_encode($reporteros);
    }
    if(isset($_POST["ajax_sumbit_edit_rep"])){
        $opc = $_POST["opc"];
        $ID = $_POST["ID"];
        $reporteros = LoginContr::cats()->reporteros($ID,$opc);
        echo json_encode($reporteros);
    }
    if(isset($_POST["updateReportero"])){
        $ID = $_POST["ID"];
        $opc = $_POST["OPC"];
        
        $reporteros = LoginContr::cats()->updatereporteros($ID,$opc);
        echo json_encode($reporteros);
    }
    if(isset($_POST["revisar"])){
        $ID_News = $_POST["ID_News"];
        LoginContr::cats()->reviewNews($ID_News);
        
        header("location: ../html/RevisionNoticia.php");
    }
    if(isset($_POST["rejectNews"])){
        $ID_News = $_POST["ID_News"];
        return LoginContr::cats()->rejectNews($ID_News);
    }
    if(isset($_POST["approvetNews"])){
        $ID_News = $_POST["ID_News"];
        LoginContr::cats()->approvetNews($ID_News);
        header("location: ../html/InicioEditor.php");
    }

?>