function ConfirmDeleteNews() {
    //Aqui se hará el getElementById()

    Swal.fire({
        title: 'Deseas Eliminar la noticia?',
        text: "el no se podra revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Borrar'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Borrado',
                'Se a Eliminado correctamente',
                'success'
            );
        }
    })
}

function ConfirmEditNews() {
    Swal.fire({
        title: 'Deseas Editar la noticia?',

        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#32c58d',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Editar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.open('../html/NewsCreation.php');
        }
    })
}

function loadPendingNewsReportero(IDReportero) {
    $.ajax({
        url: '../includes/loginReportero_inc.php',
        type: 'POST',
        data: {
            'ajax_pending_news': 1,
            'IDReportero': IDReportero
        },
        success: function (json) {
            var data_array = $.parseJSON(json);
            var html = "";
            var count = 0;
            for (let key of data_array) {
                if (count == 0) {
                    html = html.concat(' <div class="RowContainer_NoticiasMasVistas">');
                }
                html = html.concat('<div class="Box_NoticiasMasVistas"><div class="Box_ImagenNoticia"><img src="' + key['COVER_PHOTO'] + '"></div>');
                html = html.concat('<div class="Box_ContNoticia">');
                html = html.concat('<div class="Box_TituloNoticia"><h3> ', key['NEWS_TITLE'], ' </h3></div>');
                html = html.concat('<div class="Box_ResumenNoticia"><p>', key['DESCRIP'], '</p></div>');
                html = html.concat('<div class="Box_FormLeerMasFechaNoticia">');
                html = html.concat('<form action="../includes/loginReportero_inc.php" method="POST">');
                html = html.concat('<input name="ID_News" value=' + key['NEWS_ID'] + ' hidden>');
                html = html.concat('<div class="Box_LinkLeerMas"><input type="submit" name="revisar" value="Revisar"></div></form>');
                html = html.concat('<div class="Box_FechaNoticia"><p>', key['DATE_INCIDENT'], '</p></div></div></div></div>');
                count++;
            }
            html = html.concat('</div>');
            $("#divPendingNews").html(html);

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

function loadRejectedNews(IDReportero) {
    $.ajax({
        url: '../includes/loginReportero_inc.php',
        type: 'POST',
        data: {
            'ajax_rejected_news': 1,
            'IDReportero': IDReportero
        },
        success: function (json) {
            var data_array = $.parseJSON(json);
            var html = "";
            var count = 0;
            for (let key of data_array) {
                if (count == 0) {
                    html = html.concat(' <div class="RowContainer_NoticiasMasVistas">');
                }
                html = html.concat('<div class="Box_NoticiasMasVistas"><div class="Box_ImagenNoticia"><img src="' + key['COVER_PHOTO'] + '"></div>');
                html = html.concat('<div class="Box_ContNoticia">');
                html = html.concat('<div class="Box_TituloNoticia"><h3> ', key['NEWS_TITLE'], ' </h3></div>');
                html = html.concat('<div class="Box_ResumenNoticia"><p>', key['DESCRIP'], '</p></div>');

                html = html.concat('<div class="Form_EliminarEditarNews">');
                html = html.concat('<form action="../includes/loginReportero_inc.php" method="POST">');

                html = html.concat('<input name="ID_News" value=' + key['NEWS_ID'] + ' hidden>');
                html = html.concat('<div class="Box_LinkLeerMas"><input type="submit" name="edit" value="Editar"></div></form>');
                html = html.concat('<div class="Box_LinkLeerMas"><button onclick="deleteNews(' + key['NEWS_ID'] + ')">Eliminar</button></div>');
                html = html.concat('<div class="Box_FechaNoticia"><p>', key['DATE_INCIDENT'], '</p></div></div></div></div>');
                count++;
            }
            html = html.concat('</div>');
            $("#divRejectedNews").html(html);

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

function deleteNews(id) {
    console.log(id);
    $.ajax({
        url: '../includes/loginReportero_inc.php',
        type: 'POST',
        data: {
            'ajax_eliminarNews': 1,
            'ID_News': id
        },
        success: function (json) {

        },
        error: function (jqXHR, status, error) {
            console.log(status);
            console.log(error);
            alert('Disculpe, existió un problema');
        },
        complete: function (jqXHR, status) {
            //alert('Petición realizada');
            Swal.fire(
                'Success',
                'Se eliminio la noticia correctamente',
                'success'
            );
            loadRejectedNews($("#userID").val());
            loadPendingNewsReportero($("#userID").val());
        }
    });
}