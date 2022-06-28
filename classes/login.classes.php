<?php
include "../classes/DB.classes.php";
class Login extends DB{

    protected function sign_in($email,$password){
        $stmt = $this->connect()->prepare('CALL sp_login(?);');
        if(!$stmt->execute(array($email))){
            $stmt = null;
            header("location: ../html/login.php?error=stmtfailed");
            exit();
        }

        //$check;
        if($stmt->rowCount() == 0){ 
            $stmt = null;
            header("location: ../html/login.php?error=userNotFound");
            exit();
        }

        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($password,$pwdHashed[0]["USER_PWD"]);

        if( $checkPwd == false ){
            $stmt = null;
            header("location: ../html/login.php?error=wrongPassword");
            exit();
        }else if($checkPwd == true){
            session_start();
            $_SESSION["USER_ID"] = $pwdHashed[0]["USER_ID"];
            $_SESSION["USER_FULL_NAME"] = $pwdHashed[0]["USER_FULL_NAME"];
            $_SESSION["USER_EMAIL"] = $email;
            $_SESSION["PROFILE_PIC"] = $pwdHashed[0]["PROFILE_PIC"];
            $_SESSION["USER_ROL"] = $pwdHashed[0]["ROL"];
            $_SESSION["GOOGLE"] = $pwdHashed[0]["GOOGLE"];
            $_SESSION["USER_Pass"] = $password;

        }
        $stmt = null;
    }

}
?>