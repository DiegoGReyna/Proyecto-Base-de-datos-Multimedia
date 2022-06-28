<?php
include "../classes/register-contr.classes.php";
    if(isset($_POST["submitRegistrar"])){
        $Full_Name = $_POST["Full_Name"];
        $email = $_POST["email"];
        $pwd = $_POST["password"];
        $confirm = $_POST["confirmPassword"];
        if(!empty( $_FILES["image"]["name"] )){

            $fileName = basename($_FILES["image"]["name"]);
            $imageType = strtolower( pathinfo($fileName,PATHINFO_EXTENSION));
            $allowedTypes = array('png','jpg','gif');
 
            if( in_array($imageType,$allowedTypes) ){
 
                 $imageName = $_FILES["image"]["tmp_name"];
                 $base64Image = base64_encode(file_get_contents($imageName));
                 $realImage = 'data:image/'.$imageType.';base64,'.$base64Image;
 
            }else{
                 header("location: ../load.php?error=no_valid_extension");
                 exit();
            }
         }else{
             header("location: ../load.php?error=no_file");
             exit();
         }
        $register = new RegisterContr(4,$Full_Name,$email,$pwd,$confirm,$realImage);
        $register->registerUser();
        header("location: ../html/CreateUser.php?error=none");
        exit();
        
    }
    else if(isset($_POST["submitActualizar"])){
        $id = $_POST["ID_idUser"];
        $RealPassword = $_POST["ID_idUserCurrentPass"];
        $Full_Name = $_POST["ID_Nombre"];
        $email = $_POST["ID_Correo"];
        $currentPassword =["ID_ContraActual"];
        $pwd = $_POST["ID_Contra"];
        $confirm = $_POST["ID_ContraConf"];

        if(!empty( $_FILES["image"]["name"] )){

            $fileName = basename($_FILES["image"]["name"]);
            $imageType = strtolower( pathinfo($fileName,PATHINFO_EXTENSION));
            $allowedTypes = array('png','jpg','gif');
 
            if( in_array($imageType,$allowedTypes) ){
 
                 $imageName = $_FILES["image"]["tmp_name"];
                 $base64Image = base64_encode(file_get_contents($imageName));
                 $realImage = 'data:image/'.$imageType.';base64,'.$base64Image;       
            }
        }
        else{
            $realImage = '';
        }
        if($RealPassword !== $currentPassword &&  empty($currentPassword)){
            header("location: ../html/UpdateUserInfo.php?error=WrongPassword");
        }else{
            $register = new RegisterContr($id,$Full_Name,$email,$pwd,$confirm, $realImage);
            $register->updateUser();
            header("location: ../html/UpdateUserInfo.php?error=none");
        } 
    }
    else if(isset($_POST["submitRegistrarRepEdit"])){
        $Full_Name = $_POST["Full_Name"];
        $email = $_POST["email"];
        $pwd = $_POST["password"];
        $confirm = $_POST["confirmPassword"];
        $rol = $_POST["id_Puesto"];
        echo "Si estoy aqui";
        $register = new RegisterContr($rol,$Full_Name,$email,$pwd,$confirm, 'none');
        $register->registerRepEdit();
        header("location: ../html/CreateRepEdit.php?error=none");
    }
