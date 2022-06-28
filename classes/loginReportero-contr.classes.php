<?php 
include "../classes/loginReportero.classes.php";
class Reportero extends RepBD{

    public function __construct(){}

    public static function _News() {
        $instance = new self();
        return $instance;
    }

    public function pendingNews($id){
        return $this->getPendingNews($id);
    }

    public function rejectedNews($id){
        return $this->getrejectedNews($id);
    }

    public function deleteNews($id){
        $this->deleteNewsID($id);
    }

    public function reviewNews($ID_News){
        $this->getReviewNews($ID_News);
    }

    public function getNews($ID_News){
        $this->getEditNews($ID_News);
    }

}
?>