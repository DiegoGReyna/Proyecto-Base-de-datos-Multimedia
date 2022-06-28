<?php
include "../classes/DB.classes.php";
class newsCat extends DB
{
    protected function newsCategories(){
        
        $stmt = $this->connect()->prepare('CALL sp_getSections');
        
        if(!$stmt->execute(array())){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../index.php?error=no_categories");
            exit();
        }
        
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["NEWS_Categories"] = $categories;
        $stmt = null;
        return $categories;
    }

    protected function newsAllCategories(){
        
        $stmt = $this->connect()->prepare('CALL sp_getAllSections');
        
        if(!$stmt->execute(array())){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../index.php?error=no_categories");
            exit();
        }
        
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["NEWS_Categories"] = $categories;
        $stmt = null;
        return $categories;
    }


    protected function newsFiveCategories(){
        
        $stmt = $this->connect()->prepare('CALL sp_getFiveSections');
        
        if(!$stmt->execute(array())){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../index.php?error=no_categories");
            exit();
        }
        
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["NEWS_Categories"] = $categories;
        $stmt = null;
        return $categories;
    }

    protected function selectedCategory($newsID){
        $stmt = $this->connect()->prepare('CALL sp_getNewsByCategories(?);');
        if(!$stmt->execute(array($newsID))){
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

        $newsCard = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["newsCard"] = $newsCard;
        $stmt = null;
    }
   
}
