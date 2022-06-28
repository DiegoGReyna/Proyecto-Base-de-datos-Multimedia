<?php
include "../classes/register.classes.php";
class RegisterContr extends Register{

    private $email;
    private $pwd;
    private $confirm;
    private $Full_Name;
    private $id;
    private $image;


    public function __construct($id,$Full_Name,$email,$pwd,$confirm,$image){
        $this->Full_Name = $Full_Name;
        $this->email = $email;
        $this->pwd = $pwd;
        $this->confirm = $confirm;
        $this->id = $id;
        $this->image = $image;
    }

    public function registerUser(){
        if( $this->emptyInputs() == false ){
            // echo 'rip en los inputs';
            header("location: ../html/CreateUser.php?error=emptyInput");
            exit();
        }
        if( $this->matchPwd() == false ){
            // echo 'rip en los inputs';
            header("location: ../html/CreateUser.php?error=matchPwd");
            exit();
        }
        if( $this->checkUser($this->email) == false ){
            // echo 'rip en los inputs';
            header("location: ../html/CreateUser.php?error=userCheck");
            exit();
        }
        $this->register($this->email, $this->pwd, $this->Full_Name, $this->id, $this->image);
    }

    public function registerRepEdit(){
        if( $this->emptyInputs() == false ){
            // echo 'rip en los inputs';
            header("location: ../html/CreateRepEdit.php?error=emptyInput");
            exit();
        }
        if( $this->matchPwd() == false ){
            // echo 'rip en los inputs';
            header("location: ../html/CreateRepEdit.php?error=matchPwd");
            exit();
        }
        if( $this->checkUser($this->email) == false ){
            // echo 'rip en los inputs';
            header("location: ../html/CreateRepEdit.php?error=userCheck");
            exit();
        }

        $this->registerRep($this->email, $this->pwd, $this->Full_Name, $this->id);
        
    }

    private function matchPwd(){
        $result = false;
        if($this->pwd !== $this->confirm){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function emptyInputs(){
        $result = false;
        if( empty($this->email) || empty($this->pwd) || empty($this->confirm) ){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    public function updateUser(){
        if( $this->emptyInputsUpdate() == false ){
            // echo 'rip en los inputs';
            header("location: ../html/CreateUser.php?error=emptyInput");
            exit();
        }
        if( $this->matchPwd() == false ){
            // echo 'rip en los inputs';
            header("location: ../html/CreateUser.php?error=matchPwd");
            exit();
        }
        if((empty($this->confirm) && empty($this->pwd))){
            $this->updateWpasswords($this->id, $this->email,$this->Full_Name, $this->pwd, $this->image);
        }
        else{
            $this->updatePass($this->id, $this->email,$this->Full_Name, $this->pwd, $this->image);
        }
        
        
    }

    private function emptyInputsUpdate(){
        $result = false;
        if( empty($this->email) || empty($this->Full_Name) ){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }
}