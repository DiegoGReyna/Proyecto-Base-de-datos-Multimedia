<!DOCTYPE html>
<html lang="en">

<?php
include('../html/template/Head.php');
include('../html/template/nav.php');
if (isset($_SESSION["USER_ID"])) {
    $userID = $_SESSION["USER_ID"];
    $userName = $_SESSION["USER_FULL_NAME"];
    $userType = $_SESSION["USER_ROL"];
    //$userPhoto = $_SESSION["PROFILE_PIC"];
    //
?>
    <script>
        window.location.replace("../html/index.php");
    </script>
<?php
}
?>

<body>
    <div class="BackGroundInicio">
        <div class="Contenedor_Login">
            <div class="box_ImagenPerfilLogin">
                <img src="../img/person-fill.svg" class="imagen_logo" alt="ImagenPerfil" height="100" width="100">
            </div>
            <div class="Box_Ingreso_DatosLoging">
                <div class="ingresa_datos">
                    <form class="form" action="../includes/login_inc.php" method="POST" onsubmit="return checkDataForLogin()">
                        <input id="Id_CorreoElectronico" name="email" class="texto_Ingresa" type="email" placeholder="Correo Eléctronico" required>
                        <input id="Id_PassWord" name="password" type="password" class="texto_Ingresa" placeholder="Contraseña" required><br>
                        <input id="Id_InputIniciarSesion" class="btnIniciarGoogle" type="submit" name="submitGoogle" value="Iniciar con google">
                        <input id="Id_InputIniciarSesion" class="btnIniciar" type="submit" name="submit" value="Iniciar sesión">
                    </form>
                    <hr>
                </div>

                <div class="Box_ContenedorEnlaces">
                    <!-- <a href="loginEditor.php" class="btnCrear"></a> -->
                    <a href="CreateUser.php" class="btnCrear">Crear cuenta</a>
                    <!-- <a href="loginReportero.php" class="btnCrear"></a> -->
                </div>
            </div>
        </div>
        <?php include('../html/template/footer.php'); ?>
    </div>
    <script src="../js/login.js"></script>
    <script src="../js/script_Inicio.js"></script>
    <script src="../js/sweetalert2.js"></script>
</body>

</html>