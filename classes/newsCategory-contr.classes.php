<?php 
include "../classes/newsCategory.classes.php";
class newsCategory extends newsCat{

    public function __construct(){}
    
    public static function cats() {
        $instance = new self();
        return $instance;
    }

    public function getAllCategories(){
        return $this->newsAllCategories();
    }

    public function getCategories(){
        return $this->newsCategories();
    }

    public function getFiveCategories(){
        return $this->newsFiveCategories();
    }

    public function selectSingleCategpry($catID){
        $this->selectedCategory($catID);
    }

}
?>