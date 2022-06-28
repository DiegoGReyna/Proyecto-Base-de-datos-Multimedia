<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preload" href="../css/style.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preload" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="preload" href="../css/style_Noticia.css">
    <link rel="stylesheet" href="../css/style_Noticia.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700;900&display=swap" rel="stylesheet">
</head>

<?php
include('../html/template/Head.php');
include('../html/template/nav.php');
session_start();
if (isset($_SESSION["USER_ID"])) {
    if (isset($_SESSION["newsInfo"])) {
        $userID = $_SESSION["USER_ID"];
        $newsInfo = $_SESSION["newsInfo"];
        $newsPhotos = $_SESSION["newsPhotos"];
        $newsKeyWords = $_SESSION["newsKeyWords"];
        $newsComments = $_SESSION["newsComments"];
        $newsResponse = $_SESSION["newsResponse"];
        $userPhoto = $_SESSION["PROFILE_PIC"];
        $userType = $_SESSION["USER_ROL"];
    } else {
?>
        <script>
            window.location.replace("../html/index.php");
        </script>
    <?php
    }
} else {
    ?>
    <script>
        window.location.replace("../html/login.php");
    </script>
<?php
}
?>

<body>
    <div class="BackGround">
        <div class="backGroundNoticia">

            <div class="Container_Noticia">
                <div class="Box_Noticia">
                    <div class="Box_Titular_Noticia">
                        <input type="text" id="idNewsID" value="<?php echo $userID; ?>" hidden>
                        <h1><?php echo $newsInfo[0]["NEWS_TITLE"]; ?></h1>
                        <hr>
                    </div>
                    <div class="Box_FechaHora_Noticia">
                        <h4><?php echo $newsInfo[0]["DATE_INCIDENT"]; ?></h4>
                    </div>
                    <div class="Box_Multimedia_Noticia">
                        <img src="<?php echo $newsInfo[0]["COVER_PHOTO"]; ?>" class="d-block w-100" alt="...">
                    </div>
                    <div class="Box_LugarAcontecimiento_Noticia">
                        <h3><?php echo $newsInfo[0]["SUBURB"], " ", $newsInfo[0]["Municipio"], " ", $newsInfo[0]["STATE"], " ", $newsInfo[0]["COUNTRY"]; ?></h3>
                    </div>

                    <div class="Box_FechaHoraPubliacion_Noticia">
                        <h4>Fecha de publicacion: <?php echo $newsInfo[0]["DATE_RELEASE"]; ?></h4>
                    </div>
                    <div class="Box_Descripcion_Noticia">
                        <p><?php echo $newsInfo[0]["TEXT"]; ?></p>
                    </div>
                    <div class="Box_FirmaReportero">
                        <h5>Firma del reportero: <?php echo $newsInfo[0]["USER_FULL_NAME"]; ?></h5>

                    </div>
                </div>
                <hr>
            </div>

            <div class="Box_Multimedia_Noticia" id="idNewsPhotos">

            </div>

            <div class="Container_Comentarios">

                <div class="box_Megusta">
                    <div class="Container_LIkesButton">
                        <div class="BoxContador_Likes">
                            <div class="Box_CantidadLIkes">
                                <p id="idComments"> <?php echo $newsInfo[0]["COMMENTS"]; ?> </p>
                                <p>Comentarios</p>
                            </div>
                        </div>
                        <div class="BoxContador_Likes">
                            <div class="Box_CantidadLIkes">
                                <p id="idLikes"> <?php echo $newsInfo[0]["LIKES"]; ?> </p>
                                <p> likes </p>
                            </div>
                        </div>
                        <div class="Box_ButtonLike">
                            <button onclick="updateLikes(<?php echo $userID; ?>, <?php echo $newsInfo[0]["NEWS_ID"]; ?>)">
                                <img src="../img/hand-thumbs-up-fill.svg" alt="Me gustas">
                            </button>
                        </div>

                    </div>

                </div>
                <div class="Box_Comentarios">
                    <div class="Container_TextAreaButton">
                        <h2>Comentarios</h2>
                        <div class="Box_CamentarioArea">

                            <div class="Box_ComentariActivo">
                                <div class="ImagenPerfilComentario">
                                    <img src="<?php echo $userPhoto; ?>" alt="ImagenPerfil">
                                </div>
                                <input type="text" id="idComentario" placeholder="Agregue un comentario..."> <br>
                            </div>
                            <div class="Box_ComentarioActivoYBoton">
                                <button onclick="addComment(<?php echo $userID; ?>, <?php echo $newsInfo[0]['NEWS_ID']; ?>, '<?php echo $userType; ?>')">Comentar</button>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="ComentarioRelizado">
                        <div class="Container_comentario_Echo" id="idCommentsContainer">

                        </div>
                    </div>
                </div>
            </div>

            <div class="Container_Noticias_Relacionadas">
                <hr>
                <h2> Noticias Relacionadas</h2>
                <hr>
                <div class="Container_NoticiasRelacionadas" id="newsRelatedID">

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

<script>
    loadNewsPhotos(<?php echo json_encode($newsPhotos); ?>);
    loadKeyWordsNews(<?php echo json_encode($newsKeyWords); ?>);
    loadComments(<?php echo json_encode($newsComments); ?>);
    loadResponses(<?php echo json_encode($newsComments); ?>, <?php echo json_encode($newsResponse); ?>);

    if (<?php echo $userType; ?> == 'User')
        $(".Box_EliminarComentario").hide();
</script>

</html>