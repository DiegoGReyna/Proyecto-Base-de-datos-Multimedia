function loadNews() {
    loadMostResentNews();
    loadMostViewedNews();
}

function loadMostResentNews() {
    $.ajax({
        url: '../includes/news_inc.php',
        type: 'POST',
        data: { 'ajaxSumbitRecent': 1 },
        success: function (json) {
            var data_array = $.parseJSON(json);
            var html = "";
            var count = 0;
            for (let key of data_array) {
                if (count % 3 == 0) {
                    if (count != 0) {
                        html = html.concat('</div>');
                        html = html.concat(' <div class="RowContainer_NoticiasRecinetes">');
                    }
                    else {
                        html = html.concat('<div class="RowContainer_NoticiasRecinetes">');
                    }
                }
                if (key['PARENT'] == null) {
                    html = html.concat('<div class="Box_NoticiaReciente"><div class="Box_ImagenNoticia"><img src="' + key['COVER_PHOTO'] + '"></div>');
                    html = html.concat('<div class="Box_ContNoticia">');
                    html = html.concat('<div class="Box_TituloNoticia"><h3> ', key['NEWS_TITLE'], ' </h3></div>');
                    html = html.concat('<div class="Box_ResumenNoticia"><p>', key['DESCRIP'], '</p></div>');

                    html = html.concat('<div class="Box_FormLeerMasFechaNoticia">');
                    html = html.concat('<form action="../includes/news_inc.php" method="POST">');
                    html = html.concat('<input name="ID_News" value=' + key['NEWS_ID'] + ' hidden>');
                    html = html.concat('<div class="Box_LinkLeerMas"><input type="submit" name="ShowANew" value="Leer más"></div></form>');
                    html = html.concat('<div class="Box_FechaNoticia"><p>', key['DATE_INCIDENT'], '</p></div></div></div></div>');


                }
                count++;
            }
            html = html.concat('</div>');
            $("#ID_AllNews").html(html);

        },
        error: function (jqXHR, status, error) {

            alert('Disculpe, existió un problema');
        },
        complete: function (jqXHR, status) {
            //alert('Petición realizada');
        }
    });
}

function loadMostViewedNews() {
    $.ajax({
        url: '../includes/news_inc.php',
        type: 'POST',
        data: { 'ajaxSumbitViewed': 1 },
        success: function (json) {
            var data_array = $.parseJSON(json);
            var html = "";
            var count = 0;
            for (let key of data_array) {
                if (count % 4 == 0) {
                    if (count != 0) {
                        html = html.concat('</div>');
                        html = html.concat(' <div class="RowContainer_NoticiasMasVistas">');
                    }
                    else {
                        html = html.concat(' <div class="RowContainer_NoticiasMasVistas">');
                    }
                }
                html = html.concat('<div class="Box_NoticiasMasVistas"><div class="Box_ImagenNoticia"><img src="' + key['COVER_PHOTO'] + '"></div>');

                html = html.concat('<div class="Box_ContNoticia">');
                html = html.concat('<div class="Box_TituloNoticia"><h3> ', key['NEWS_TITLE'], ' </h3></div>');
                html = html.concat('<div class="Box_ResumenNoticia"><p>', key['DESCRIP'], '</p></div>');

                html = html.concat('<div class="Box_FormLeerMasFechaNoticia">');
                html = html.concat('<form action="../includes/news_inc.php" method="POST">');
                html = html.concat('<input name="ID_News" value=' + key['NEWS_ID'] + ' hidden>');
                html = html.concat('<div class="Box_LinkLeerMas"><input type="submit" name="ShowANew" value="Leer más"></div></form>');
                html = html.concat('<div class="Box_FechaNoticia"><p>', key['DATE_INCIDENT'], '</p></div></div></div></div>');
                count++;
            }
            html = html.concat('</div>');
            $("#ID_ViwedNews").html(html);

        },
        error: function (jqXHR, status, error) {
            console.log(status);
            console.log(error);
            alert('Disculpe, existió un problema');
        },
        complete: function (jqXHR, status) {
            //alert('Petición realizada');
        }
    });
}

function loadNewsPhotos(newsPhotos) {

    if (newsPhotos.length != 0) {
        var html = "";
        for (let i = 0; i < newsPhotos.length; i++) {
            if (i == 0) {
                html += '<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">';
                html += '<div class="carousel-inner">';
                html += '<div class="carousel-item active">';
                if (newsPhotos[i]['TYPE'] == 'F') {
                    html += '<img src="' + newsPhotos[i]['CONTENT_MULTIMEDIA'] + '" class="d-block w-100" alt="..."></div>';
                }
                else {
                    html += '<video controls="controls" poster="image" preload="metadata" class="d-block w-100">';
                    html += '<source src="' + newsPhotos[i]['CONTENT_MULTIMEDIA'] + '"/></video></div>';
                }
            }
            else {
                html += '<div class="carousel-item">';
                if (newsPhotos[i]['TYPE'] == 'F') {
                    html += '<img src="' + newsPhotos[i]['CONTENT_MULTIMEDIA'] + '" class="d-block w-100" alt="..."></div>';
                }
                else {
                    html += '<video controls="controls" poster="image" preload="metadata" class="d-block w-100">';
                    html += '<source src="' + newsPhotos[i]['CONTENT_MULTIMEDIA'] + '"/></video></div>';
                }
            }
        }
        html += '</div>';
        html += '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">';
        html += '<span class="carousel-control-prev-icon" ></span>';
        html += '<span class="visually-hidden">Previous</span></button>';
        html += '<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">';
        html += '<span class="carousel-control-next-icon" ></span>';
        html += '<span class="visually-hidden">Next</span></button>';
        html += '</div></div>';

        $("#idNewsPhotos").html(html);
    }
}

function loadCategoryNews(newsCard) {
    var html = ""
    for (let i = 0; i < newsCard.length; i++) {
        if (i % 4 == 0) {
            if (i != 0) {
                html += '</div>';
                html += ' <div class="RowContainer_NoticiasMasVistas">';
            } else {
                html = html.concat(' <div class="RowContainer_NoticiasMasVistas">');
            }
        }
        html += '<div class="Box_NoticiasMasVistas"><div class="Box_ImagenNoticia"><img src="' + newsCard[i]['COVER_PHOTO'] + '"></div>';
        html += '<div class="Box_ContNoticia">';
        html += '<div class="Box_TituloNoticia"><h3> ' + newsCard[i]['NEWS_TITLE'] + ' </h3></div>';
        html += '<div class="Box_ResumenNoticia"><p>' + newsCard[i]['DESCRIP'] + '</p></div>';
        html += '<div class="Box_FormLeerMasFechaNoticia">';
        html += '<form action="../includes/news_inc.php" method="POST">';
        html += '<input name="ID_News" value=' + newsCard[i]['NEWS_ID'] + ' hidden>';
        html += '<div class="Box_LinkLeerMas"><input type="submit" name="ShowANew" value="Leer más"></div></form>';
        html += '<div class="Box_FechaNoticia"><p>' + newsCard[i]['DATE_INCIDENT'] + '</p></div></div></div></div>';
    }
    html += '</div>';

    console.log(html);

    $("#ID_AllCatNews").html(html);
}

function loadKeyWordsNews(newsWords) {
    var html = ""
    for (let i = 0; i < newsWords.length; i++) {
        if (i % 4 == 0) {
            if (i != 0) {
                html += '</div>';
                html += ' <div class="RowContainer_NoticiasMasVistas">';
            } else {
                html = html.concat(' <div class="RowContainer_NoticiasMasVistas">');
            }
        }
        html += '<div class="Box_NoticiasMasVistas"><div class="Box_ImagenNoticia"><img src="' + newsWords[i]['COVER_PHOTO'] + '"></div>';
        html += '<div class="Box_ContNoticia">';
        html += '<div class="Box_TituloNoticia"><h3> ' + newsWords[i]['NEWS_TITLE'] + ' </h3></div>';
        html += '<div class="Box_ResumenNoticia"><p>' + newsWords[i]['DESCRIPTION'] + '</p></div>';
        html += '<div class="Box_FormLeerMasFechaNoticia">';
        html += '<form action="../includes/news_inc.php" method="POST">';
        html += '<input name="ID_News" value=' + newsWords[i]['NEWS_ID'] + ' hidden>';
        html += '<div class="Box_LinkLeerMas"><input type="submit" name="ShowANew" value="Leer más"></div></form>';
        html += '<div class="Box_FechaNoticia"><p>' + newsWords[i]['DATE_INCIDENT'] + '</p></div></div></div></div>';
    }
    html += '</div>';

    $("#newsRelatedID").html(html);
}

function updateLikes(userID, newsID) {
    var dataForm = new FormData();
    dataForm.append('ajax_sumbit_likes', 1);
    dataForm.append('ID_User', userID);
    dataForm.append('ID_News', newsID);
    $.ajax({
        url: '../includes/news_inc.php',
        type: 'POST',
        data: {
            'ajax_sumbit_likes': 1,
            'ID_User': userID,
            'ID_News': newsID
        },
        success: function (json) {
            console.log("aqui");
            var data_array = $.parseJSON(json);
            var html = data_array[0]["LIKES"];
            console.log(html);

            $("#idLikes").html(html);
        },
        error: function (jqXHR, status, error) {
            console.log(status);
            console.log(error);
            alert('Disculpe, existió un problema');
        },
        complete: function (jqXHR, status) {
            //alert('Petición realizada');
        }
    });
}

function addComment(userID, newsID) {
    var dataForm = new FormData();
    $.ajax({
        url: '../includes/news_inc.php',
        type: 'POST',
        data: {
            'ajax_sumbit_addComment': 1,
            'ID_User': userID,
            'ID_News': newsID,
            'Comment': $("#idComentario").val()
        },
        success: function (json) {
            var data_array = $.parseJSON(json);
            loadComments(data_array);
            getResponses(newsID, data_array);
            updateCommentsCount(newsID);
        },
        error: function (jqXHR, status, error) {
            console.log(status);
            console.log(error);
        },
        complete: function (jqXHR, status) {
            $("#idComentario").val("");
            Swal.fire({
                icon: 'Success',
                title: 'Comentario agregado',
                text: 'El comentario ha sido agregado'
            });
        }
    });
}

function getResponses(newsID, comments) {
    $.ajax({
        url: '../includes/news_inc.php',
        type: 'POST',
        data: {
            'ajax_sumbit_getResponses': 1,
            'ID_News': newsID
        },
        success: function (json) {
            var data_array = $.parseJSON(json);
            loadResponses(comments, data_array);
        },
        error: function (jqXHR, status, error) {
            console.log(status);
            console.log(error);
        },
        complete: function (jqXHR, status) {
            //alert('Petición realizada');
        }
    });
}

function loadComments(newsComments) {
    var html = "";
    for (let i = 0; i < newsComments.length; i++) {
        html += '<div></div>';
        html += '<div class="box_comentario_Echo" id="idComment' + newsComments[i]['COMMENTS_ID'] + '">';

        html += '<div class="ImagenPerfilComentario">';
        html += '<img src="' + newsComments[i]['PROFILE_PIC'] + '" alt="ImagenPerfil" ></div>';

        html += '<div class="Box_UsuarioContenido">';
        html += '<div class="Box_Usuario_Comentario"><h4>' + newsComments[i]['USER_FULL_NAME'] + '</h4></div>';
        html += '<div class="Box_Contenido_Comentario">';
        html += '<div class="Box_TextoComentario">'
        html += '<p>' + newsComments[i]['COMMENT'] + '</p></div>';
        html += '<div class="Box_OpcionesComentario">'
        html += '<div class="Box_FechaComentario">'
        html += '<p>' + newsComments[i]['DATE_OF_COMMENT'] + '</p></div>';

        html += '<div class="Box_EliminarComentario">'
        html += '<button onclick="deleteComment(' + newsComments[i]['COMMENTS_ID'] + ',' + newsComments[i]['FK_NEWS_ID'] + ')">Eliminar</button>'
        html += '</div></div></div>';
        html += '<div class="Box_RespuestaComentario" id="response' + newsComments[i]['COMMENTS_ID'] + '"></div>';
        html += '<div class="Box_InputRespuestaComentario"id="button' + newsComments[i]['COMMENTS_ID'] + '">';
        html += '<input type="text" id="idRespuesta' + newsComments[i]['COMMENTS_ID'] + '" placeholder="Agregue una respuesta...">';
        html += '<div class="Box_ComentarioActivoYBoton">';
        html += '<button onclick="addResponse(' + newsComments[i]['COMMENTS_ID'] + ',' + newsComments[i]['FK_NEWS_ID'] + ')">Responder</button>';
        html += '</div></div><hr></div>';
    }

    $("#idCommentsContainer").html(html);
}

function loadResponses(newsComments, newsResponse) {
    for (let k = 0; k < newsComments.length; k++) {
        let html = "";

        for (let i = 0; i < newsResponse.length; i++) {

            if (newsComments[k]['COMMENTS_ID'] == newsResponse[i]['COMMENTS_ID']) {

                html += '<div class="box_comentario_Echo" id="idComment' + newsResponse[i]['RESPONCES_ID'] + '">';
                html += '<div class="ImagenPerfilComentario">';
                html += '<img src="' + newsResponse[i]['PROFILE_PIC'] + '" alt="ImagenPerfil"  ></div>';
                html += '<div class="Box_UsuarioContenido">';
                html += '<div class="Box_Usuario_Comentario"><h4>' + newsResponse[i]['USER_FULL_NAME'] + '</h4></div>';
                html += '<div class="Box_Contenido_Comentario">';
                html += '<div class="Box_TextoComentario">'
                html += '<p>' + newsResponse[i]['RESPONSE'] + '</p></div>';
                html += '<div class="Box_OpcionesComentario">'
                html += '<div class="Box_FechaComentario">'
                html += '<p>' + newsResponse[i]['DATE_OF_RESPONSE'] + '</p></div>';
                html += '</div></div></div>';
                html += '</div>';

            }


        }


        let id = "response" + newsComments[k]['COMMENTS_ID'];
        let HtmlClass = 'class="Box_RespuestaComentario"';


        $("#" + id).html(html);


    }


}

function addResponse(commentID, newsID) {
    $.ajax({
        url: '../includes/news_inc.php',
        type: 'POST',
        data: {
            'ajax_sumbit_addResponse': 1,
            'ID_User': $("#idNewsID").val(),
            'ID_News': newsID,
            'RESPONSE': $("#idRespuesta" + commentID).val(),
            'COMMENTID': commentID
        },
        success: function (json) {
            var data_array = $.parseJSON(json);
            loadComments(data_array);
            getResponses(newsID, data_array);
        },
        error: function (jqXHR, status, error) {
            console.log(status);
            console.log(error);
            alert('Disculpe, existió un problema');
        },
        complete: function (jqXHR, status) {
            $("#idRespuesta" + commentID).val("");
            Swal.fire({
                icon: 'Success',
                title: 'Respuesta agregada',
                text: 'La respuesta ha sido agregada'
            });
        }
    });
}

function loadCreatedCategories(cat) {
    console.log(cat);
    var html = ""
    for (let i = 0; i < cat.length; i++) {
        html += "<li>" + cat[i]['SECTION_NAME'] + "<input type='hidden' value='" + cat[i]['SECTION_ID'] + "'/></li>"
    }

    $("#NewsCategories").html(html);
}

function loadCreatedKeyWords(key) {
    console.log(key);
    var html = ""
    for (let i = 0; i < key.length; i++) {
        html += "<li>" + key[i]['KEY_WORD_TEXT'] + "<input type='hidden' value='" + key[i]['KEY_WORDS_ID'] + "'/></li>"
    }

    $("#NewsKeyWords").html(html);
}

function loadNewsPhotosEdit(newsPhotos) {
    if (newsPhotos.length != 0) {
        var html = "";
        for (let i = 0; i < newsPhotos.length; i++) {
            if (i == 0) {
                html += '<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">';
                html += '<div class="carousel-inner">';
                html += '<div class="carousel-item active">';
                if (newsPhotos[i]['TYPE'] == 'F') {
                    html += '<img src="' + newsPhotos[i]['CONTENT_MULTIMEDIA'] + '" class="d-block w-100" alt="..."></div>';
                }
                else {
                    html += '<video controls="controls" poster="image" preload="metadata" >';
                    html += '<source src="' + newsPhotos[i]['CONTENT_MULTIMEDIA'] + '" type="video/mp4" />' + '</video></div>';
                }
            }
            else {
                html += '<div class="carousel-item">';
                if (newsPhotos[i]['TYPE'] == 'F') {
                    html += '<img src="' + newsPhotos[i]['CONTENT_MULTIMEDIA'] + '" class="d-block w-100" alt="..."></div>';
                }
                else {
                    html += '<video controls="controls" poster="image" preload="metadata" >';
                    html += '<source src="' + newsPhotos[i]['CONTENT_MULTIMEDIA'] + '" type="video/mp4" />' + '</video></div>';
                }
            }
        }
        html += '</div>';
        html += '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">';
        html += '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
        html += '<span class="visually-hidden">Previous</span></button>';
        html += '<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">';
        html += '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
        html += '<span class="visually-hidden">Next</span></button>';
        html += '</div></div>';

        $("#idNewsPhotos").html(html);
    }
}

function deleteComment(idComments, newsID) {
    $.ajax({
        url: '../includes/news_inc.php',
        type: 'POST',
        data: {
            'ajax_sumbit_deleteComments': 1,
            'idComments': idComments
        },
        success: function (json) {
            var data_array = $.parseJSON(json);
            loadComments(data_array);
            getResponses(newsID, data_array);
            updateCommentsCount(newsID);
        },
        error: function (jqXHR, status, error) {
            console.log(status);
            console.log(error);
            alert('Disculpe, existió un problema');
        },
        complete: function (jqXHR, status) {
            $("#idRespuesta" + commentID).val("");
            Swal.fire({
                icon: 'Success',
                title: 'Comentario eliminado',
                text: 'El comentario ha sido eliminado correctamente.'
            });
        }
    });
}

function updateCommentsCount(newsID) {
    $.ajax({
        url: '../includes/news_inc.php',
        type: 'POST',
        data: {
            'ajax_sumbit_updateComment': 1,
            'ID_News': newsID
        },
        success: function (json) {
            var data_array = $.parseJSON(json);
            html = '';
            html += data_array[0]['COUNT'];
            $("#idComments").html(html);
        },
        error: function (jqXHR, status, error) {
            console.log(status);
            console.log(error);
        },
        complete: function (jqXHR, status) {
            $("#idComentario").val("");
            Swal.fire({
                icon: 'Success',
                title: 'Comentario agregado',
                text: 'El comentario ha sido agregado'
            });
        }
    });
}