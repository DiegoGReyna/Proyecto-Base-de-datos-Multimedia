<!DOCTYPE html>
<html lang="en">
<?php
include('../html/template/Head.php');
include('../html/template/nav.php');
if (isset($_SESSION["USER_ID"])) {
    $userID = $_SESSION["USER_ID"];
    $userName = $_SESSION["USER_FULL_NAME"];
    $userType = $_SESSION["USER_ROL"];
    $userPhoto = $_SESSION["PROFILE_PIC"];
    $newsInfo = $_SESSION["revNewsInfo"];
    $newsPhotos = $_SESSION["revNewsPhotos"];
    $newsKeyWords = $_SESSION["revNewsKeyWords"];
    $newsSections = $_SESSION["revNewsSections"];
    //
    if ($userType != ("Reportero")) {
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
    <title>Noticia nueva</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
        <div class="Contenedor_CNoticia">
            <div class="Box_CNoticia">
                <div class="datoP_noticia">
                    <div>
                        <hr>
                        <div>
                            <h1 class="tit1">Editar noticia</h1>
                        </div>

                        <hr>
                        <div>
                            <label class="tit2">Titulo de la noticia:</label>
                        </div>
                        <input type="text" id="ID_Titulo_Noticia" name="ID_Titulo_Noticia" class="texto_Actualiza" value="<?php echo $newsInfo[0]["NEWS_TITLE"]; ?>"> <br>
                    </div>
                    <hr>
                    <div class="together">
                        <div class="Container_ImagenPrincipal_NewsCreation">
                            <div class="Box_InputFile">
                                <label for="Id_InputFileImagenPerfil">Seleccionar Foto de Portada</label>
                                <input type="file" name="Id_InputFileImagenPerfil" id="Id_InputFileImagenPerfil" onchange="setImage(event, 'id_displayImage')">
                            </div>
                            <div class="Container_CargarImagenPerfil">
                                <div class="Box_CargarImagenPerfil">
                                    <img src="<?php echo $newsInfo[0]["COVER_PHOTO"]; ?>" id="id_displayImage" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <hr>
                        <div>
                            <label class="tit2">Descripción de la noticia:</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" id="idDescNoticia" name="idDescNoticia" class="texto_Actualiza" value="<?php echo $newsInfo[0]["DESCRIP"]; ?>"> <br>
                            <!--<input class="form-control" placeholder="Leave a comment here" style="font-size: 2rem;" id="floatingTextarea">
                                <label for="floatingTextarea" id="idDescNoticia" name="idDescNoticia">Descripcion de la noticia</label>-->
                        </div>
                    </div>
                    <div>
                        <hr>
                        <div>
                            <label class="tit2">Texto de la noticia:</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" id="idTextNoticia" name="idTextNoticia" class="texto_Actualiza" value="<?php echo $newsInfo[0]["TEXT"]; ?>"> <br>
                            <!--<input class="form-control" placeholder="Leave a comment here" id="floatingTextarea">
                                <label for="floatingTextarea" id="idTextNoticia" name="idTextNoticia">Texto de la noticia</label>-->
                        </div>
                    </div>
                    <hr>
                    <div class="Box_SelectSeccion_NewsCreation">
                        <label class="tit2" for="idDate">Fecha del suceso:</label>
                        <input type="date" id="idDate" name="idDate" value="<?php echo $newsInfo[0]["DATE_INCIDENT"]; ?>">
                    </div>

                </div>
                <hr>
                <div class="together">

                    <div class="Container_SeleccionSeccion_NewsCreation">

                        <div class="Box_SelectSeccion_NewsCreation">
                            <label for="Id_SelectSeccion" class="tit2">Selecciones de la noticia:</label>
                            <select name="" id="Id_SelectSeccion" onclick="showCategories();" onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                            </select>
                        </div>
                        <input id="btnSelectCat" type="button" value="Seleccionar" onclick="AddSection()">
                        <ul id="ListCategories">

                        </ul>
                        <ul id="NewsCategories">

                        </ul>
                        <ul id="ListCategoriesNames">

                        </ul>
                    </div>


                    <div class="Box_PalabrasClabes_NewsCreation">
                        <label class="tit2">Palabras Claves:</label>
                        <input type="text" placeholder="Palabra clave" id="Id_KeyWords" value="">
                        <input id="btnSelectClave" type="button" value="Seleccionar" onclick="AddKeyWord()">
                        <ul id="NewsKeyWords">

                        </ul>
                        <ul id="ListKeyWords">

                        </ul>
                    </div>

                </div>
                <hr>
                <div class="ingresa_datos_direccion">

                    <div class="box_Direccion">
                        <label class="titNews">Dirección</label>
                    </div>
                    <div class="box_Datos_Direccion">

                        <div class="box_Pais">
                            <label for="ID_Pais" class="titNews">País:</label>
                            <input id="ID_Pais" name="ID_Pais" type="text" value="<?php echo $newsInfo[0]["COUNTRY"]; ?>">
                        </div>
                        <div class="box_Estado">
                            <label for="ID_Estado" class="titNews">Estado:</label>
                            <input id="ID_Estado" name="ID_Estado" type="text" value="<?php echo $newsInfo[0]["STATE"]; ?>">
                        </div>
                        <div class="box_Municipio">
                            <label for="ID_Municipio" class="titNews">Municipio:</label>
                            <input id="ID_Municipio" name="ID_Municipio" type="text" value="<?php echo $newsInfo[0]["Municipio"]; ?>">
                        </div>
                        <div class="box_Colonia">
                            <label for="ID_Colonia" class="titNews">Colonia:</label>
                            <input id="ID_Colonia" name="ID_Colonia" type="text" value="<?php echo $newsInfo[0]["SUBURB"]; ?>">
                        </div>
                    </div>
                    <input name="ID_User" id="ID_User" type="text" value="<?php echo $newsInfo[0]["SUBURB"]; ?>" hidden>

                </div>
                <hr>

                <div class="ingresa_datos_direccion">
                    <button id="submitNewsEdit" type="button" onclick="CheckDataForNewsEdit(<?php echo $newsInfo[0]['NEWS_ID']; ?>)">Editar noticia</button>
                </div>


                <div id="dividNew">
                    <input id="id_news" value="<?php echo $newsInfo[0]['NEWS_ID']; ?>" hidden>
                </div>
                <hr>
                <div class="Container_Multimedia_NewsCreation" id="idDivMultimedia">

                    <div class="together">
                        <div class="Container_ImagenPrincipal_NewsCreation">
                            <div class="Box_InputFile">
                                <label for="Id_InputFileImagenMultimedia">Contenido Multimedia</label>
                                <input style="display:none ;" type="file" name="Id_InputFileImagenMultimedia" id="Id_InputFileImagenMultimedia" accept="video/*" onchange="setImage(event, 'id_displayMultimedia')">
                            </div>
                            <div class="Container_CargarImagenPerfil">
                                <div class="Box_CargarImagenPerfil">
                                    <img src="../img/image.svg" id="id_displayMultimedia" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <br />
                    <br />
                    <div class="ingresa_datos_direccion">
                        <button id="submiMultimedia" type="button" onclick="AddPhoto()">Agregar foto</button>
                        <button id="submiMultimedia" type="button" onclick="AddVideo()">Agregar video</button>
                    </div>
                    <br />
                    <br />

                    <div class="Box_Multimedia_Noticia">
                        <div class="Box_carruse">
                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner" id="idNewsPhotos">
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../js/sweetalert2.js"></script>
    <script src="../js/news.js"></script>
    <script src="../js/loadNews.js"></script>

    <script>
        loadCreatedCategories(<?php echo json_encode($newsSections); ?>);
        loadCreatedKeyWords(<?php echo json_encode($newsKeyWords); ?>);
        loadNewsPhotosEdit(<?php echo json_encode($newsPhotos); ?>);
    </script>

</body>

</html>