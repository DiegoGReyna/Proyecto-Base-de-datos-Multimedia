<?php
include "../classes/DB.classes.php";
class news extends DB
{
    protected function create_News($userID, $TituloNoticia, $ImgImage, $DescNoticia, $TextNoticia, $Pais,
    $Estado, $Municipio, $Colonia,$listPalabrasClave,$listCategories, $date){
        $stmt = $this->connect()->prepare('CALL sp_create_News(?,?,?,?,?,?,?);');
        if(!$stmt->execute(array($TituloNoticia,$DescNoticia,$ImgImage,$TextNoticia,1,$userID,$date))){
            $stmt = null;
            //header("location: ../html/NewsCreation.php?error=stmtfailed");
            //exit();
        }
        //$check;
        if($stmt->rowCount() == 0){ 
            $stmt = null;
            //header("location: ../html/NewsCreation.php?error=userNotFound");
            //exit();
        }

        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $newsID = $info[0]["ID"];
        $stmt = $this->connect()->prepare('CALL sp_setAdress(?,?,?,?,?);');
        $stmt->execute(array($Pais,$Estado,$Municipio, $Colonia,$newsID));
        $stmt = null;
        foreach($listPalabrasClave as $key){
            $stmt = $this->connect()->prepare('CALL sp_addKeyWord(?,?);');
                $stmt->execute(array($newsID,$key));
                $stmt = null;
        }
        $stmt = null;
        foreach($listCategories as $cat){
            $stmt = $this->connect()->prepare('CALL sp_addSectionsForNews(?,?);');
                $stmt->execute(array($cat,$newsID));
                $stmt = null;
        }
        $stmt = null;
        exit();
    }

    protected function update_News($newsID, $userID,$TituloNoticia, $realImage, $DescNoticia, $TextNoticia, $Pais,
    $Estado, $Municipio, $Colonia, $listPalabrasClave, $listCategories, $date){
        $stmt = $this->connect()->prepare('CALL sp_edit_News(?,?,?,?,?,?,?);');
        $stmt->execute(array($newsID,$TituloNoticia,$DescNoticia,$realImage,$TextNoticia,1,$date));
        $stmt = null;
        $stmt = $this->connect()->prepare('CALL sp_editAdress(?,?,?,?,?);');
        $stmt->execute(array($Pais,$Estado,$Municipio, $Colonia,$newsID));
        $stmt = null;
        foreach($listPalabrasClave as $key){
            if($key != ''){
            $stmt = $this->connect()->prepare('CALL sp_addKeyWord(?,?);');
                $stmt->execute(array($newsID,$key));
                $stmt = null;
            }
        }
        $stmt = null;
        foreach($listCategories as $cat){
            if($cat != ''){
            $stmt = $this->connect()->prepare('CALL sp_addSectionsForNews(?,?);');
                $stmt->execute(array($cat,$newsID));
                $stmt = null;
            }
        }
        $stmt = null;
        exit();
    }

    protected function getAllNews(){
        
        $stmt = $this->connect()->prepare('CALL sp_getShowNews()');
        
        if(!$stmt->execute(array())){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../index.php?error=no_news");
            exit();
        }
        
        $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["allNews"] = $news;
        $stmt = null;
        return $news;
    }

    protected function getViwedNews(){
        
        $stmt = $this->connect()->prepare('CALL sp_getMostViewedNews()');
        
        if(!$stmt->execute(array())){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../index.php?error=no_news");
            exit();
        }
        
        $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["viwedNews"] = $news;
        $stmt = null;
        return  $news;
    }

    protected function getLastAdded(){
        
        $stmt = $this->connect()->prepare('CALL sp_getLastNewsID');
        
        if(!$stmt->execute(array())){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../index.php?error=no_news");
            exit();
        }
        
        $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["idNews"] = $news;
        $stmt = null;
        return  $news;
    }

    protected function setMulti($ImgImage, $newsID,$Type){
        
        $stmt = $this->connect()->prepare('CALL sp_addMultimedia(?,?,?)');
        
        if(!$stmt->execute(array($newsID,$ImgImage,$Type))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../index.php?error=no_news");
            exit();
        }
        
        $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["status"] = $news;
        $stmt = null;
        return  $news;
    }

    protected function likesUpdate($ID_User,$ID_News){
        
        $stmt = $this->connect()->prepare('CALL sp_newsLikes(?,?)');
        
        if(!$stmt->execute(array($ID_User,$ID_News))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../index.php?error=no_news");
            exit();
        }
        
        $likes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["likes"] = $likes;
        $stmt = null;
        return  $likes;
    }

    protected function getCountComments($ID_News){
        
        $stmt = $this->connect()->prepare('CALL sp_getCommentsCount(?)');
        
        if(!$stmt->execute(array($ID_News))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        
        $COUNT = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["count"] = $COUNT;
        $stmt = null;
        return  $COUNT;
    }

    protected function addComment($ID_User,$ID_News,$Comment){
        
        $stmt = $this->connect()->prepare('CALL sp_addComment(?,?,?)');
        
        if(!$stmt->execute(array($ID_News,$ID_User,$Comment))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../index.php?error=no_news");
            exit();
        }
        
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["comments"] = $comments;
        $stmt = null;
        return  $comments;
    }

    protected function addResponses($ID_User,$ID_News,$Response,$CommentID){
        
        $stmt = $this->connect()->prepare('CALL sp_addResponse(?,?,?,?)');
        
        if(!$stmt->execute(array($ID_News,$ID_User,$CommentID,$Response))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        
        $commentsRes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["commentsForResponses"] = $commentsRes;
        $stmt = null;
        return  $commentsRes;
    }

    protected function deleteCommentID($idComments){
        
        $stmt = $this->connect()->prepare('CALL sp_deleteComments(?)');
        
        if(!$stmt->execute(array($idComments))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        
        $commentsRes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["commentsForResponses"] = $commentsRes;
        $stmt = null;
        return  $commentsRes;
    }

    protected function getResponsesNews($ID_News){
        
        $stmt = $this->connect()->prepare('CALL sp_getCommentsResponse(?)');
        
        if(!$stmt->execute(array($ID_News))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../index.php?error=no_news");
            exit();
        }
        
        $newsResponse = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["newsResponse"] = $newsResponse;
        $stmt = null;
        return  $newsResponse;
    }

    protected function newsCompleteInfo($ID){
        $stmt = $this->connect()->prepare('CALL sp_getSingleNewsInfo(?);');
        if(!$stmt->execute(array($ID))){
            $stmt = null;
            header("location: ../html/index.php");
            exit();
        }

        if($stmt->rowCount() == 0){ 
            $stmt = null;
            header("location: ../html/index.php");
            exit();
        }
        $stmtM = $this->connect()->prepare('CALL sp_getNewsPhotos(?);');
        if(!$stmtM->execute(array($ID))){
            $stmtM = null;
            header("location: ../html/index.php");
            exit();
        }

        $stmtK = $this->connect()->prepare('CALL sp_getNewsKeywords(?);');
        if(!$stmtK->execute(array($ID))){
            $stmtK = null;
            header("location: ../html/index.php");
            exit();
        }

        $stmtCM = $this->connect()->prepare('CALL sp_getComment(?);');
        if(!$stmtCM->execute(array($ID))){
            $stmtCM = null;
            header("location: ../html/index.php");
            exit();
        }

        $stmtCR = $this->connect()->prepare('CALL sp_getCommentsResponse(?);');
        if(!$stmtCR->execute(array($ID))){
            $stmtCR = null;
            header("location: ../html/index.php");
            exit();
        }
        
        $newsInformation = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $newsPhotos = $stmtM->fetchAll(PDO::FETCH_ASSOC);
        $newsKeyWords = $stmtK->fetchAll(PDO::FETCH_ASSOC);
        $newsComments = $stmtCM->fetchAll(PDO::FETCH_ASSOC);
        $newsResponse = $stmtCR->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["newsInfo"] = $newsInformation;
        $_SESSION["newsPhotos"] = $newsPhotos;
        $_SESSION["newsKeyWords"] = $newsKeyWords;
        $_SESSION["newsComments"] = $newsComments;
        $_SESSION["newsResponse"] = $newsResponse;
        $stmt = null;
        $stmtM = null;
        $stmtK = null;
        $stmtCM = null;
        $stmtCR = null;
    }

}
