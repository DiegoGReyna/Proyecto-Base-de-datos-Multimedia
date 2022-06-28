<!DOCTYPE html>
<html lang="en">

<?php 
include('../html/template/Head.php');
include('../html/template/nav.php');
if (isset($_SESSION["USER_ID"])) {
    $userID = $_SESSION["USER_ID"];
    $userName = $_SESSION["USER_FULL_NAME"];
    $userEmail = $_SESSION["USER_EMAIL"];
    $userType = $_SESSION["USER_ROL"];
    $userPass = $_SESSION["USER_Pass"];
    $userPhoto = $_SESSION["PROFILE_PIC"];
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar</title>
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
    <div class="BackGroundInicio">
        <div class="Contenedor_Update">
            <div class="box_CreateUser">
                <form class="form_DatosUser" action="../includes/register_inc.php" enctype="multipart/form-data" method="POST" onsubmit="return UpdateUserInfo()">
                    <div class="Box_TituloCuenta">
                        <label class="titulo">Editar usuario</label>
                    </div>
                    <hr>
                    <div class="Container_UserDataImage">
                        <div class="Box_DataCreateUser">

                            <div class="Box_DataUserFullName">
                                <div class="Box_TituloInputs">
                                    <label class="titulo">Nombre completo</label>
                                </div>
                                <input type="text" id="ID_Nombre" name="ID_Nombre" class="texto_Actualiza" value="<?php echo  $userName; ?>">
                            </div>
                            <div class="Box_DataUserEmail">
                                <div class="Box_TituloInputs">
                                    <label class="titulo">Email</label>
                                </div>
                                <input type="text" id="ID_Correo" name="ID_Correo" class="texto_Actualiza" value="<?php echo  $userEmail; ?>">
                            </div>
                            <input type="text" id="ID_idUser" name="ID_idUser" value="<?php echo  $userID; ?>" hidden>
                            <input type="text" id="ID_idUserCurrentPass" name="ID_idUserCurrentPass" value="<?php echo  $userPass; ?>" hidden>

                            <div class="Box_Show_Hide">
                                <input id="Id_Show_Hide" type="button" value="Show Passwords" onclick="Show_HidePass()" />
                            </div>
                            <div id="divContras">
                                <div class="Box_LebelUpdateUser_Instrucciones">
                                    <label class="pie_Input">Puedes usar letras, números y signos de puntuación</label>
                                </div>
                                <div class="Box_TituloInputs">
                                    <label class="titulo">Contraseña actual</label>
                                </div>
                                <input type="text" id="ID_ContraActual" name="ID_ContraActual" class="texto_Actualiza" placeholder="Contraseña Actual">
                                <div class="Box_TituloInputs">
                                    <label class="titulo"> Nueva contraseña</label>
                                </div>
                                <div class="Box_LebelUpdateUser_Instrucciones">
                                    <label class="pie_Input">Usa 8 o más caracteres con una combinación de letras, números y simbolos</label>
                                </div>
                                <div class="together">
                                    <input type="text" id="ID_Contra" name="ID_Contra" class="texto2_Actualiza" placeholder="Contraseña">
                                    <input type="text" id="ID_ContraConf" name="ID_ContraConf" class="texto2_Actualiza" placeholder="Confirmación">
                                </div>

                                <!-- <input type="checkbox" class="CheckIt" name="" id="">
                                <label class="titulo">Mostrar contraseña</label> -->
                            </div>
                            <div class="together">
                                <div class="Container_InputImagenPerfil">
                                    <div class="Box_InputFile">
                                        <label for="Id_InputFileImagenPerfil">Editar Foto perfil</label>
                                        <input type="file" name="image" id="Id_InputFileImagenPerfil" onchange="setImage(event)">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Container_CargarImagenPerfil">
                            <div class="Box_CargarImagenPerfil">
                                <!-- <label class="titulo Esp_Top">Foto de perfil:</label> -->                  
                                <img src="<?php echo (isset($userPhoto)) ? $userPhoto : "../img/person-fill.svg"; ?>" class="imagen_Us" name="image" id="id_displayImage" alt="">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!--<input id="Id_SubmitButton" class="btnActualiza" type="button" value="Actualizar" placeholder="Registrar">-->
                    <input id="Id_SubmitButton" class="btnActualiza" type="submit" name="submitActualizar" value="Actualizar">
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