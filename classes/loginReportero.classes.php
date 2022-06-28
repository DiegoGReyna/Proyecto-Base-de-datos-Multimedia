<?php
include "../classes/DB.classes.php";
class RepBD extends DB{

    protected function getPendingNews($id){
        $stmt = $this->connect()->prepare('CALL sp_getPendingNewsByReportero(?);');
        if(!$stmt->execute(array($id))){
            $stmt = null;
            header("location: ../html/index.php?error=stmtfailed");
            exit();
        }

        $pendingNews = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["pendingNews"] = $pendingNews;
        $stmt = null;
        return  $pendingNews;
    }

    protected function getrejectedNews($id){
        $stmt = $this->connect()->prepare('CALL sp_getRejectedNewsByReportero(?);');
        if(!$stmt->execute(array($id))){
            $stmt = null;
            header("location: ../html/index.php?error=stmtfailed");
            exit();
        }

        $rejectedNews = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["rejectedNews"] = $rejectedNews;
        $stmt = null;
        return  $rejectedNews;
    }

    protected function deleteNewsID($id){
        $stmt = $this->connect()->prepare('CALL sp_deleteNews(?);');
        if(!$stmt->execute(array($id))){
            $stmt = null;
            header("location: ../html/index.php?error=stmtfailed");
            exit();
        }

        $rejectedNews = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["deletedNews"] = $rejectedNews;
        $stmt = null;
    }

    protected function getReviewNews($ID_News){
        $stmt = $this->connect()->prepare('CALL sp_getSingleNewsInfo(?);');
        if(!$stmt->execute(array($ID_News))){
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
        if(!$stmtM->execute(array($ID_News))){
            $stmtM = null;
            header("location: ../html/index.php");
            exit();
        }

        $stmtK = $this->connect()->prepare('CALL sp_getNewsKeywords(?);');
        if(!$stmtK->execute(array($ID_News))){
            $stmtK = null;
            header("location: ../html/index.php");
            exit();
        }

        $stmtCM = $this->connect()->prepare('CALL sp_getComment(?);');
        if(!$stmtCM->execute(array($ID_News))){
            $stmtCM = null;
            header("location: ../html/index.php");
            exit();
        }

        $stmtCR = $this->connect()->prepare('CALL sp_getCommentsResponse(?);');
        if(!$stmtCR->execute(array($ID_News))){
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
        $_SESSION["revNewsInfo"] = $newsInformation;
        $_SESSION["revNewsPhotos"] = $newsPhotos;
        $_SESSION["revNewsKeyWords"] = $newsKeyWords;
        $_SESSION["revNewsComments"] = $newsComments;
        $_SESSION["revNewsResponse"] = $newsResponse;
        $stmt = null;
        $stmtM = null;
        $stmtK = null;
        $stmtCM = null;
        $stmtCR = null;
    }


    protected function getEditNews($ID_News){
        $stmt = $this->connect()->prepare('CALL sp_getSingleNewsInfo(?);');
        if(!$stmt->execute(array($ID_News))){
            $stmt = null;
            header("location: ../html/InicioReportero.php");
            exit();
        }

        $stmtM = $this->connect()->prepare('CALL sp_getNewsPhotos(?);');
        $stmtM->execute(array($ID_News));


        $stmtK = $this->connect()->prepare('CALL sp_getKewWordsOfNews(?);');
        $stmtK->execute(array($ID_News));

        $stmtC = $this->connect()->prepare('CALL sp_getSectionsOfNews(?);');
        $stmtC->execute(array($ID_News));
        


        $newsInformation = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $newsPhotos = $stmtM->fetchAll(PDO::FETCH_ASSOC);
        $newsKeyWords = $stmtK->fetchAll(PDO::FETCH_ASSOC);
        $newsSections = $stmtC->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["revNewsInfo"] = $newsInformation;
        $_SESSION["revNewsPhotos"] = $newsPhotos;
        $_SESSION["revNewsKeyWords"] = $newsKeyWords;
        $_SESSION["revNewsSections"] = $newsSections;
        $stmt = null;
        $stmtM = null;
        $stmtK = null;
        $stmtC = null;
    }
}
?>