<?php
include "../classes/news.classes.php";
class NewsContr extends News{
    private $userID;
    private $TituloNoticia;
    private $ImgImage;
    private $DescNoticia;
    private $TextNoticia;
    private $Pais;
    private $Estado;
    private $Municipio;
    private $Colonia;
    private $listPalabrasClave = array();
    private $listCategories = array();
    private $date;


    public function __construct($userID,$TituloNoticia, $ImgImage, $DescNoticia, $TextNoticia, $Pais,
    $Estado, $Municipio, $Colonia,$listPalabrasClave,$listCategories, $date){
    $this->userID = $userID;
    $this->TituloNoticia = $TituloNoticia;
    $this->ImgImage = $ImgImage;
    $this->DescNoticia = $DescNoticia;
    $this->TextNoticia = $TextNoticia;
    $this->Pais = $Pais;
    $this->Estado = $Estado;
    $this->Municipio = $Municipio;
    $this->Colonia = $Colonia;
    $this->listPalabrasClave = $listPalabrasClave;
    $this->listCategories = $listCategories;
    $this->date = $date;
    }

    public function news_Creation(){
        $this->create_News($this->userID,$this->TituloNoticia, $this->ImgImage, $this->DescNoticia, $this->TextNoticia, 
        $this->Pais, $this->Estado, $this->Municipio, $this->Colonia,$this->listPalabrasClave,
        $this->listCategories, $this->date);
    }

    public function news_Edit($newsID){
        $this->update_News($newsID, $this->userID, $this->TituloNoticia, $this->ImgImage, $this->DescNoticia, $this->TextNoticia, 
        $this->Pais, $this->Estado, $this->Municipio, $this->Colonia, $this->listPalabrasClave,
        $this->listCategories, $this->date);
    }

    public static function _News() {
        $instance = new self("","","","","","","","","","","","");
        return $instance;
    }

    public function getNews(){
        return $this->getAllNews();
    }

    public function getMostViwedNews(){
        return $this->getViwedNews();
    }

    public function getLastAddedNew(){
        return $this->getLastAdded();
    }

    public function updateLikes($ID_User,$ID_News){
        return $this->likesUpdate($ID_User,$ID_News);
    }

    public function getCommentsCount($ID_News){
        return $this->getCountComments($ID_News);
    }

    public function getResponses($ID_News){
        return $this->getResponsesNews($ID_News);
    }

    public function addComments($ID_User,$ID_News,$Comment){
        return $this->addComment($ID_User,$ID_News,$Comment);
    }

    public function addResponse($ID_User,$ID_News,$Response,$CommentID){
        return $this->addResponses($ID_User,$ID_News,$Response,$CommentID);
    }

    public function deleteComment($idComments){
        return $this->deleteCommentID($idComments);
    }

    public function setMultimedia($ImgImage, $ID,$Type){
        return $this->setMulti($ImgImage, $ID,$Type);
    }

    public function newsInformation($ID){
        $this->newsCompleteInfo($ID);
    }


}