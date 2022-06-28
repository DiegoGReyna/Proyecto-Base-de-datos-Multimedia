<!DOCTYPE html>
<html lang="en">

<?php 
    include('../html/template/Head.php');
    include('../html/template/nav.php'); ?>

<body>
    <?php  ?>
    <div class="BackGroundInicio">
        <div class="Contenedor_Login">
            <div class="box_ImagenPerfilLogin">
                <img src="../img/person-fill.svg" class="imagen_logo" alt="ImagenPerfil" height="100" width="100">
            </div>
            <div class="Box_Ingreso_DatosLoging">
                <div class="ingresa_datos">
                    <form action="">
                        <input id="Id_CorreoElectronico" class="texto_Ingresa" type="email" placeholder="Correo Eléctronico" required>
                        <input id="Id_PassWord" type="password" class="texto_Ingresa" placeholder="Contraseña" required><br>
                        <input id="Id_InputIniciarSesion" class="btnIniciar" type="submit" placeholder="Iniciar sesión" onclick=checkDataForLoginReportero()>
                    </form>
                    <hr>
                </div>
                <div class="Box_ContenedorEnlaces">
                    <a href="login.php" class="btnCrear">iniciar como cliente</a>
                    <a href="CreateUser.php" class="btnCrear">Crear cuenta</a>
                    <a href="loginEditor.php" class="btnCrear">iniciar como Editor</a>
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