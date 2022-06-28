<?php
include "../classes/DB.classes.php";
class LoginEdit extends DB{

    protected function editColor($catID,$catColor){
        $stmt = $this->connect()->prepare('CALL sp_updateCatColor(?,?);');
        if(!$stmt->execute(array($catID,$catColor))){
            $stmt = null;
            header("location: ../html/login.php?error=stmtfailed");
            exit();
        }

        //$check;
        if($stmt->rowCount() == 0){ 
            $stmt = null;
            header("location: ../html/index.php");
            exit();
        }

        $color = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["color"] = $color;
        $stmt = null;
    }

    protected function addCategory($catName,$catDesc,$catColor,$catOrder){
        $stmt = $this->connect()->prepare('CALL sp_addSection(?,?,?,?);');
        if(!$stmt->execute(array($catName,$catDesc,$catColor,$catOrder))){
            $stmt = null;
            header("location: ../html/login.php?error=stmtfailed");
            exit();
        }

        //$check;
        if($stmt->rowCount() == 0){ 
            $stmt = null;
            header("location: ../html/index.php");
            exit();
        }

        $added = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["added"] = $added;
        $stmt = null;
    }

    protected function editOrderSection($catName,$catOrder){
        $stmt = $this->connect()->prepare('CALL sp_updateOrderCat(?,?);');
        if(!$stmt->execute(array($catName,$catOrder))){
            $stmt = null;
            header("location: ../html/login.php?error=stmtfailed");
            exit();
        }

        //$check;
        if($stmt->rowCount() == 0){ 
            $stmt = null;
            header("location: ../html/index.php");
            exit();
        }

        $order = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["order"] = $order;
        $stmt = null;
    }

    protected function pending_newsEdit(){
        $stmt = $this->connect()->prepare('CALL sp_pendingNewsEditor;');
        if(!$stmt->execute(array())){
            $stmt = null;
            header("location: ../html/login.php?error=stmtfailed");
            exit();
        }

        $newsEditor = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["pending_newsEditor"] = $newsEditor;
        $stmt = null;
        return $newsEditor;
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

        protected function setRejectNews($ID_News){
            $stmt = $this->connect()->prepare('CALL sp_rejectNews(?);');
            if(!$stmt->execute(array($ID_News))){
                $stmt = null;
                header("location: ../html/login.php?error=stmtfailed");
                exit();
            }
    
            $rejectedNews = $stmt->fetchAll(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION["rejectedNews"] = $rejectedNews;
            $stmt = null;
            return $rejectedNews;
        }

        protected function setapprovetNews($ID_News){
            $stmt = $this->connect()->prepare('CALL sp_approveNews(?);');
            if(!$stmt->execute(array($ID_News))){
                $stmt = null;
                header("location: ../html/login.php?error=stmtfailed");
                exit();
            }
    
            $approvedNews = $stmt->fetchAll(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION["approvedNews"] = $approvedNews;
            $stmt = null;
        }
    
        protected function getReporteros($opc){
            $stmt = $this->connect()->prepare('CALL sp_getReporteros(?);');
            if(!$stmt->execute(array($opc))){
                $stmt = null;
                header("location: ../html/login.php?error=stmtfailed");
                exit();
            }
    
            $reporteros = $stmt->fetchAll(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION["reporterosA"] = $reporteros;
            $stmt = null;
            return $reporteros;
        }

        protected function editReportero($ID, $opc){
            $stmt = $this->connect()->prepare('CALL sp_editReportero(?,?);');
            if(!$stmt->execute(array($ID, $opc))){
                $stmt = null;
                header("location: ../html/login.php?error=stmtfailed");
                exit();
            }
    
            $reporteros = $stmt->fetchAll(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION["UPDATERep"] = $reporteros;
            $stmt = null;
            return $reporteros;
        }
}
?>