<!DOCTYPE html>
<html lang="en">
<?php
include('../html/template/Head.php');
include('../html/template/nav.php');
session_start();
if (isset($_SESSION["newsCard"])) {
    $newsCard = $_SESSION["newsCard"];
    $FechaI = $_SESSION["FechaI"];
    $FechaF = $_SESSION["FechaF"];
    $Titulo = $_SESSION["Titulo"];
    $KeyWord = $_SESSION["KeyWord"];
} else {
?>
    <script>
        window.location.replace("../html/index.php");
    </script>
<?php
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
    <div class="BackGroundInicio">
        <div class="Contenedor_Noticias">

            <div class="Contenedor_NoticiasRecinetes">
                <div class="Box_Titulo_NoticiasMasReciente">
                    <hr>
                    <h4 id="fechaInicial"> Fecha inicial: <?php echo $FechaI; ?></h4>
                    <h4 id="fechaFinal"> Fecha final: <?php echo $FechaF; ?></h4>
                    <hr>
                    <h4 id="Titulo"> Titulo: <?php echo ($Titulo != '') ? $Titulo : '--'; ?></h4>
                    <hr>
                    <h4 id="PalabrasClave"> Palabra Clave: <?php echo ($KeyWord != '') ? $KeyWord : '--'; ?></h4>
                    <hr>
                </div>

                <div id="ID_AllCatNews" class="Container_NoticiasRecientesPublicadas">

                </div>
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

</body>

<script>
    loadCategoryNews(<?php echo json_encode($newsCard); ?>);
</script>

</html>