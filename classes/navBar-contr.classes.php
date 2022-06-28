<?php 
include "../classes/navBar.classes.php";
class navBar extends nav{

    private $FechaI;
    private $FechaF;
    private $Titulo;
    private $KeyWord;
 
    public function __construct($FechaI,$FechaF,$Titulo,$KeyWord){
         $this->FechaI = $FechaI;
         $this->FechaF = $FechaF;
         $this->Titulo = $Titulo;
         $this->KeyWord = $KeyWord;
    }

    public function searching(){
        $this->search($this->FechaI,$this->FechaF,$this->Titulo,$this->KeyWord);
    }
}
?>