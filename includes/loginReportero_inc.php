<?php
include "../classes/loginReportero-contr.classes.php";
    if(isset($_POST["ajax_pending_news"])){
        $id = $_POST["IDReportero"];

        $pendingNews = Reportero::_News()->pendingNews($id);
        echo json_encode($pendingNews);
    }

    if(isset($_POST["ajax_rejected_news"])){
        $id = $_POST["IDReportero"];

        $rejectedNews = Reportero::_News()->rejectedNews($id);
        echo json_encode($rejectedNews);
    }
    if(isset($_POST["edit"])){
        $id = $_POST["ID_News"];
        Reportero::_News()->getNews($id);
        header("location: ../html/editNews.php");
    }
    if(isset($_POST["ajax_eliminarNews"])){
        $id = $_POST["ID_News"];
        Reportero::_News()->deleteNews($id);
    }
    if(isset($_POST["revisar"])){
        $ID_News = $_POST["ID_News"];
        Reportero::_News()->reviewNews($ID_News);
        header("location: ../html/RevisionNoticia.php");
    }
?>