<?php
include "../classes/login-contr.classes.php";
    if(isset($_POST["submit"])){
        $email = $_POST["email"];
        $pwd = $_POST["password"];

        $login = new LoginContr($email,$pwd);
        header("location: ../html/login.php?error=none");
        $login->loginUser();
        header("location: ../html/login.php?error=none");
    }
?>