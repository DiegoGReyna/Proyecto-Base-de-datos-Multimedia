<?php 
include "../classes/login.classes.php";
class LoginContr extends Login{

   private $email;
   private $pwd;

   public function __construct($email,$pwd){
        $this->email = $email;
        $this->pwd = $pwd;
   }

   public function loginUser(){
       if($this->emptyInputs() == false){
        echo 'rip en los inputs';
        header("location: ../html/login.php?error=emptyInput");
        exit();
       }

       $this->sign_in($this->email,$this->pwd);
   }

   private function emptyInputs(){
       $result = false;
       if( empty($this->email) || empty($this->pwd) ){
           $result = false;
       }else{
           $result = true;
       }
       return $result;
   }

}
?>