<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear</title>
    <link rel="preload" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="preload" href="../css/style.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preload" href="../css/sweetalert2.css">
    <link rel="stylesheet" href="../css/sweetalert2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700;900&display=swap" rel="stylesheet">

</head>

<body>
    <?php 
    include('../html/template/Head.php');
    include('../html/template/nav.php');
  if(isset($_SESSION["USER_ID"])){
    $userID = $_SESSION["USER_ID"];
    $userName = $_SESSION["USER_FULL_NAME"];
    $userEmail = $_SESSION["USER_EMAIL"];
    $userType = $_SESSION["USER_ROL"];
    $userPhoto = $_SESSION["PROFILE_PIC"];
    $userGOOGLE = $_SESSION["GOOGLE"];
    //  
    }?>
    <div class="BackGroundInicio">
        <div class="Contenedor_Update">
            <div class="box_CreateUser">
                <form class="form_DatosUser" action="" method="post">
                    <div class="Container_DataCreateUser">

                        <div class="Box_TituloCuenta">
                            <label class="titulo">Perfil</label>
                        </div>
                        <hr>
                        <div class="Container_UserDataImage">
                            <div class="Box_DataCreateUser">

                                <div class="Box_DataUserFullName">
                                <input type="text" name="Full_Name" id="ID_NombreCompletoPerfil" class="texto_Actualiza" value="<?php echo  $userType;?>" readonly>
                                    <div>
                                        <label class="pie_Input" for="ID_NombreCompletoPerfil">Nombre completo</label>
                                    </div>
                                    <div class="Box_InputNombrePerfil">
                                        <input type="text" name="Full_Name" id="ID_NombreCompletoPerfil" class="texto_Actualiza" value="<?php echo  $userName;?>" readonly>
                                    </div>
                                </div>
                                <div class="Box_DataUserEmail">
                                    <div>
                                        <label for="ID_CorreoPerfil" class="pie_Input">E-mail</label>
                                    </div>
                                    <div class="Box_InputEmailPerfil">
                                        <input type="email" name="email" id="ID_CorreoPerfil" class="texto_Actualiza" value="<?php echo  $userEmail;?>" readonly>
                                    </div>

                                </div>
                            </div>
                            <div class="Container_CargarImagenPerfil">
                                <div class="Box_CargarImagenPerfil">
                                <?php 
                                if(isset($userPhoto)){
                                ?>
                                <img src="<?php echo  $userPhoto;?>" class="imagen_Us" alt="">
                                <?php
                                }else{
                                ?>
                                <img src="../img/person-fill.svg" class="imagen_Us" alt="">
                                <?php
                                }
                                ?>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="Box_InputEditar">
                            <?php if($userGOOGLE != 1){?>
                            <!--TODO-->
                            <a id="Btn_Editar" href="UpdateUserInfo.php" class="btnCrear">Editar</a>
                            <!--<input id="Id_SubmitButton" class="btnEditar" type="submit" name="submit" value="Editar" placeholder="Editar">-->
                            <?php
                        }
                        ?>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>
    <script src="../js/UserInfo.js"></script>
    <script src="../js/sweetalert2.js"></script>
    <script src="../js/script_Inicio.js"></script>

</body>

</html>