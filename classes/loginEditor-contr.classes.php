<?php 
include "../classes/loginEditor.classes.php";
class LoginContr extends LoginEdit{

   public function __construct(){
   }

   public static function cats() {
    $instance = new self();
    return $instance;
    }

    public function editColorCat($catID,$catColor){
        return $this->editColor($catID,$catColor);
    }

    public function addCat($catName,$catDesc,$catColor,$catOrder){
        return $this->addCategory($catName,$catDesc,$catColor,$catOrder);
    }

    public function editOrderCat($catName,$catOrder){
        return $this->editOrderSection($catName,$catOrder);
    }

    public function pending_news(){
        return $this->pending_newsEdit();
    }

    public function reviewNews($ID_News){
        return $this->getReviewNews($ID_News);
    }

    public function reporteros($opc){
        if($opc == "D"){
            return $this->getReporteros(1);
        }
        else{
            return $this->getReporteros(0);
        }
    }

    public function updateReporteros($ID, $opc){
        return $this->editReportero($ID,$opc);
    }

    public function rejectNews($ID_News){
        return $this->setRejectNews($ID_News);
    }

    public function approvetNews($ID_News){
        $this->setapprovetNews($ID_News);
    }

}
?>