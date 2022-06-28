<!DOCTYPE html>
<html lang="en">
<?php
include('../html/template/Head.php');
include('../html/template/nav.php');
session_start();
if (isset($_SESSION["USER_ID"])) {
    $userID = $_SESSION["USER_ID"];
    $userName = $_SESSION["USER_FULL_NAME"];
    $userType = $_SESSION["USER_ROL"];
    $userPhoto = $_SESSION["PROFILE_PIC"];
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preload" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="preload" href="../css/style.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700;900&display=swap" rel="stylesheet">


</head>

<body>
    <script>
        loadNews();
    </script>
    <div class="BackGroundInicio">
        <div class="Contenedor_Noticias">

            <div class="Contenedor_NoticiasRecinetes">
                <div class="Box_Titulo_NoticiasMasReciente">
                    <hr>
                    <h2> Noticias mas reciente</h2>
                    <hr>
                </div>


                <div class="Container_NoticiasRecientesPublicadas" id="ID_AllNews">

                </div>
            </div>

            <div class="Contenedor_NoticiasMasVistas">
                <div class="Box_TituloNoticiasMasvistas">
                    <hr>
                    <h2> Noticias mas Vistas </h2>
                    <hr>
                </div>

                <div class="Container_NoticiasMasVistasPublicadas" id="ID_ViwedNews">
                </div>

            </div>

        </div>

        <footer>
            <div class="Box_Volver">
                <button onclick="backToTop()" class="Button_VolverInicio">
                    <img src="../img/arrow-up.svg" height="50" width="50" alt="volver a inicio">
                </button>
            </div>

        </footer>
    </div>
</body>

</html>