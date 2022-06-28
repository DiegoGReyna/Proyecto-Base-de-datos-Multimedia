<!DOCTYPE html>
<html lang="en">

<?php include('../html/template/nav.php');
if (isset($_SESSION["USER_ID"])) {
    $userID = $_SESSION["USER_ID"];
    $userName = $_SESSION["USER_FULL_NAME"];
    $userType = $_SESSION["USER_ROL"];
    //$userPhoto = $_SESSION["PROFILE_PIC"];
    //
    if ($userType != ("Admin" || "Editor")) {
?>
        <script>
            window.location.replace("../html/index.php");
        </script>
<?php
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
                <form class="form_DatosUser" action="../includes/register_inc.php" method="POST" onsubmit="return CheckRepEditor()">
                    <div class="Container_DataCreateUser">

                        <div class="Box_TituloCuenta">
                            <label class="titulo">Crea tu cuenta</label>
                        </div>
                        <hr>
                        <div class="Container_UserDataImage">
                            <div class="Box_DataCreateUser">

                                <div class="Box_DataUserFullName">

                                    <input type="text" name="Full_Name" id="ID_Nombre" class="texto_Actualiza" placeholder="Nombre Completo" required>
                                    <div class="Box_DataUserEmail">
                                        <label class="pie_Input">Puedes usar letras, números y signos de puntuación</label>
                                        <input name="email" id="ID_Correo" class="texto_Actualiza" placeholder="E-Mail" required>
                                    </div>
                                    <input type="text" name="password" class="texto2_Actualiza" value="00000000" hidden>
                                    <input type="text" name="confirmPassword" class="texto2_Actualiza" value="00000000" hidden>
                                    <input type="text" id="id_Puesto" name="id_Puesto" class="texto2_Actualiza" hidden>
                                </div>
                                <select class="SelectType" name="Puestos" id="id_Select" onchange="puestoChanged()">
                                    <option value="0"></option>
                                    <option value="2">Editor</option>
                                    <option value="3">Reportero</option>
                                </select>
                            </div>

                        </div>
                        <hr>
                        <input id="Id_SubmitButton" class="btnRegistro" type="submit" name="submitRegistrarRepEdit" value="Registrar" placeholder="Registrar">
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