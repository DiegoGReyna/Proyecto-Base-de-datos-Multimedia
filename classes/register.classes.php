<?php
include "../classes/DB.classes.php";
class Register extends DB
{

    protected function checkUser($email)
    {
        $stmt = $this->connect()->prepare('SELECT EMAIL FROM USERS WHERE EMAIL = ?;');
        if (!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../html/CreateUser.php?error=stmtfailed");
            exit();
        }
        $check = false;
        if ($stmt->rowCount() > 0) {
            $check = false;
        } else {
            $check = true;
        }
        return $check;
    }

    protected function register($email, $password, $full_name, $user_type, $image)
    {
        //TODO: StoredProcedure
        $stmt = $this->connect()->prepare('CALL sp_register_user(?,?,?,?,?)');

        $hashPwd = password_hash($password, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($email, $hashPwd, $full_name, $user_type, $image))) {
            $stmt = null;
            header("location: ../html/CreateUser.php?error=stmtfailed");
            exit();
        } else {
            $userInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION["USER_ID"] = $userInfo[0]["USER_ID"];
            $_SESSION["USER_FULL_NAME"] = $userInfo[0]["USER_FULL_NAME"];
            $_SESSION["USER_EMAIL"] = $email;
            $_SESSION["PROFILE_PIC"] = $userInfo[0]["PROFILE_PIC"];
            $_SESSION["USER_ROL"] = $userInfo[0]["ROL"];
            $_SESSION["USER_Pass"] = $password;
            $this->sign_in($email,$password);
        }
        $stmt = null;
    }

    protected function updateWpasswords($id, $email, $full_name, $password, $image)
    {
        //TODO: StoredProcedure
        $stmt = $this->connect()->prepare('CALL sp_update_user_WPass(?,?,?,?)');

        if (!$stmt->execute(array($id, $email, $full_name, $image))) {
            $stmt = null;
            header("location: ../html/CreateUser.php?error=stmtfailed");
            exit();
        } else {
            $userInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION["USER_ID"] = $userInfo[0]["USER_ID"];
            $_SESSION["USER_FULL_NAME"] = $userInfo[0]["USER_FULL_NAME"];
            $_SESSION["USER_EMAIL"] = $email;
            $_SESSION["PROFILE_PIC"] = $userInfo[0]["PROFILE_PIC"];
            $_SESSION["USER_ROL"] = $userInfo[0]["ROL"];
            $_SESSION["GOOGLE"] = $userInfo[0]["GOOGLE"];
            $_SESSION["USER_Pass"] = $password;
        }
        $stmt = null;
    }

    protected function updatePass($id, $email, $full_name, $password, $image)
    {
        //TODO: StoredProcedure
        $stmt = $this->connect()->prepare('CALL sp_update_user_Pass(?,?,?,?,?)');

        $hashPwd = password_hash($password, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($id, $email, $full_name, $hashPwd, $image))) {
            $stmt = null;
            header("location: ../html/CreateUser.php?error=stmtfailed");
            exit();
        } else {
            $userInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION["USER_ID"] = $userInfo[0]["USER_ID"];
            $_SESSION["USER_FULL_NAME"] = $userInfo[0]["USER_FULL_NAME"];
            $_SESSION["USER_EMAIL"] = $email;
            $_SESSION["PROFILE_PIC"] = $userInfo[0]["PROFILE_PIC"];
            $_SESSION["USER_ROL"] = $userInfo[0]["ROL"];
            $_SESSION["USER_Pass"] = $password;
        }
        $stmt = null;
    }

    protected function registerRep($email, $password, $full_name, $user_type)
    {
        //TODO: StoredProcedure
        $stmt = $this->connect()->prepare('CALL sp_register_RepEdit(?,?,?,?)');

        $hashPwd = password_hash($password, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($email, $hashPwd, $full_name, $user_type))) {
            $stmt = null;
            header("location: ../html/CreateRepEdit.php?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }

    protected function sign_in($email,$password){
        $stmt = $this->connect()->prepare('CALL sp_login(?);');
        if(!$stmt->execute(array($email))){
            $stmt = null;
            header("location: ../html/login.php?error=stmtfailed");
            exit();
        }
        if($stmt->rowCount() == 0){ 
            $stmt = null;
            header("location: ../html/login.php?error=userNotFound");
            exit();
        }
        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($password,$pwdHashed[0]["USER_PWD"]);
        if( $checkPwd == false ){
            $stmt = null;
            header("location: ../html/login.php?error=wrongPassword" + $pwdHashed[0]["USER_PWD"]);
            exit();
        }else if($checkPwd == true){
            session_start();
            $_SESSION["USER_ID"] = $pwdHashed[0]["USER_ID"];
            $_SESSION["USER_FULL_NAME"] = $pwdHashed[0]["USER_FULL_NAME"];
            $_SESSION["USER_EMAIL"] = $email;
            $_SESSION["PROFILE_PIC"] = $pwdHashed[0]["PROFILE_PIC"];
            $_SESSION["USER_ROL"] = $pwdHashed[0]["ROL"];
            $_SESSION["USER_Pass"] = $password;
        }
        $stmt = null;
    }
}
