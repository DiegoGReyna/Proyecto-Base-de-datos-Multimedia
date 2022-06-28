<?php
include "../classes/DB.classes.php";
class nav extends DB{

    protected function search($FechaI,$FechaF,$Titulo,$KeyWord){
        $stmt = $this->connect()->prepare('CALL sp_newsFilter(?,?,?,?);');
        $stmt->execute(array($FechaI,$FechaF,$Titulo,$KeyWord));

        $newsCard = $stmt->fetchAll(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION["newsCard"] = $newsCard;
            $_SESSION["FechaI"] = $FechaI;
            $_SESSION["FechaF"] = $FechaF;
            $_SESSION["Titulo"] = $Titulo;
            $_SESSION["KeyWord"] = $KeyWord;
        
        $stmt = null;
    }

}
?>