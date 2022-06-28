<?php
include "../classes/news-contr.classes.php";
    if(isset($_POST["ajax_Create_News"])){
        $userID = $_POST["ID_User"];
        $TituloNoticia = $_POST["ID_Titulo_Noticia"];
        $DescNoticia = $_POST["idDescNoticia"];
        $TextNoticia = $_POST["idTextNoticia"];
        $Pais = $_POST["ID_Pais"];
        $Estado = $_POST["ID_Estado"];
        $Municipio = $_POST["ID_Municipio"];
        $Colonia = $_POST["ID_Colonia"];
        $listPalabrasClave = $_POST["ListKeyWord"];
        $listPalabrasClave = explode(',', $listPalabrasClave);
        $listCategories = $_POST["ListCategories"];
        $listCategories = explode(',', $listCategories);
        $date = $_POST["idDate"];

        if(!empty($_FILES["image"]["name"] )){

            $fileName = basename($_FILES["image"]["name"]);
            $imageType = strtolower( pathinfo($fileName,PATHINFO_EXTENSION));
            $allowedTypes = array('png','jpg','gif','jpeg');
 
            if( in_array($imageType,$allowedTypes) ){
 
                 $imageName = $_FILES["image"]["tmp_name"];
                 $base64Image = base64_encode(file_get_contents($imageName));
                 $realImage = 'data:image/'.$imageType.';base64,'.$base64Image;       
            }
            $news = new NewsContr($userID,$TituloNoticia, $realImage, $DescNoticia, $TextNoticia, $Pais,
        $Estado, $Municipio, $Colonia, $listPalabrasClave, $listCategories, $date);
        $news->news_Creation();
        echo json_encode('"{"sucess":true}"');
        }
    }
    if(isset($_POST["ajax_Edit_News"])){
        $newsID = $_POST["newsID"];
        $userID = $_POST["ID_User"];
        $TituloNoticia = $_POST["ID_Titulo_Noticia"];
        $DescNoticia = $_POST["idDescNoticia"];
        $TextNoticia = $_POST["idTextNoticia"];
        $Pais = $_POST["ID_Pais"];
        $Estado = $_POST["ID_Estado"];
        $Municipio = $_POST["ID_Municipio"];
        $Colonia = $_POST["ID_Colonia"];
        $listPalabrasClave = $_POST["ListKeyWord"];
        $listPalabrasClave = explode(',', $listPalabrasClave);
        $listCategories = $_POST["ListCategories"];
        $listCategories = explode(',', $listCategories);
        $date = $_POST["idDate"];

        if(!empty($_FILES["image"]["name"] )){

            $fileName = basename($_FILES["image"]["name"]);
            $imageType = strtolower( pathinfo($fileName,PATHINFO_EXTENSION));
            $allowedTypes = array('png','jpg','gif','jpeg');
 
            if( in_array($imageType,$allowedTypes) ){
 
                 $imageName = $_FILES["image"]["tmp_name"];
                 $base64Image = base64_encode(file_get_contents($imageName));
                 $realImage = 'data:image/'.$imageType.';base64,'.$base64Image;       
            }
        }
        else{
            $realImage = '';
        }
        $news = new NewsContr($userID, $TituloNoticia, $realImage, $DescNoticia, $TextNoticia, $Pais,
        $Estado, $Municipio, $Colonia, $listPalabrasClave, $listCategories, $date);
        $news->news_Edit($newsID);
        echo json_encode('"{"sucess":true}"');
    }
    if(isset($_POST["ajaxSumbitRecent"])){
        $news = NewsContr::_News()->getNews();
        echo json_encode($news);
    }
    if(isset($_POST["ajaxSumbitViewed"])){
        $news = NewsContr::_News()->getMostViwedNews();
        echo json_encode($news);
    }
    if(isset($_POST["ShowANew"])){
        $newID = $_POST["ID_News"];
        $news = NewsContr::_News()->newsInformation($newID);
        header("location: ../html/DetallesNoticia.php");
    }
    if(isset($_POST["ajax_sumbit_AddedID"])){
        $news = NewsContr::_News()->getLastAddedNew();
        echo json_encode($news);
    }
    if(isset($_POST["ajax_sumbit_getResponses"])){
        $ID_News = $_POST["ID_News"];
        $responses = NewsContr::_News()->getResponses($ID_News);
        echo json_encode($responses);
    }
    if(isset($_POST["ajax_sumbit_updateComment"])){
        $ID_News = $_POST["ID_News"];
        $count = NewsContr::_News()->getCommentsCount($ID_News);
        echo json_encode($count);
    }
    if(isset($_POST["ajax_sumbit_likes"])){
        $ID_User = $_POST["ID_User"];
        $ID_News = $_POST["ID_News"];
        $likes = NewsContr::_News()->updateLikes($ID_User,$ID_News);
        echo json_encode($likes);
    }
    if(isset($_POST["ajax_sumbit_addComment"])){
        $ID_User = $_POST["ID_User"];
        $ID_News = $_POST["ID_News"];
        $Comment = $_POST["Comment"];
        $comments = NewsContr::_News()->addComments($ID_User,$ID_News,$Comment);
        echo json_encode($comments);
    }
    if(isset($_POST["ajax_sumbit_addResponse"])){
        $ID_User = $_POST["ID_User"];
        $ID_News = $_POST["ID_News"];
        $Response = $_POST["RESPONSE"];
        $CommentID = $_POST["COMMENTID"];
        $Responses = NewsContr::_News()->addResponse($ID_User,$ID_News,$Response,$CommentID);
        echo json_encode($Responses);
    }
    if(isset($_POST["ajax_sumbit_deleteComments"])){
        $idComments = $_POST["idComments"];
        $Responses = NewsContr::_News()->deleteComment($idComments);
        echo json_encode($Responses);
    }
    if(isset($_POST["ajax_sumbit_Photo"])){
        $newsID = $_POST["ID_News"];
        $Type = $_POST["Type"];
        if(!empty($_FILES["image"]["name"] )){

            $fileName = basename($_FILES["image"]["name"]);
            $imageType = strtolower( pathinfo($fileName,PATHINFO_EXTENSION));
            $allowedTypes = array('png','jpg','gif','jpeg','mp4');
 
            if( in_array($imageType,$allowedTypes) ){
 
                 $imageName = $_FILES["image"]["tmp_name"];
                 $base64Image = base64_encode(file_get_contents($imageName));
                 $realImage = 'data:image/'.$imageType.';base64,'.$base64Image;       
            }
            $status = NewsContr::_News()->setMultimedia($realImage,$newsID,$Type);
            echo json_encode('"{"sucess":true}"');
        }
        else{
            $realImage = '';
        }
    }
    if(isset($_POST["ajax_sumbit_Video"])){
        $newsID = $_POST["ID_News"];
        $Type = $_POST["Type"];
        if(!empty($_FILES["image"]["name"] )){

            $fileName = basename($_FILES["image"]["name"]);
            $imageType = strtolower( pathinfo($fileName,PATHINFO_EXTENSION));
            $allowedTypes = array('mp4');
 
            if( in_array($imageType,$allowedTypes) ){
 
                 $imageName = $_FILES["image"]["tmp_name"];
                 $base64Image = base64_encode(file_get_contents($imageName));
                 $realImage = 'data:video/'.$imageType.';base64,'.$base64Image;       
            }
            $status = NewsContr::_News()->setMultimedia($realImage,$newsID,$Type);
            echo json_encode($status);
        }
        else{
            $realImage = '';
        }
    }
?>