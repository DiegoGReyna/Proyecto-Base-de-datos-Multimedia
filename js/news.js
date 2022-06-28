var Sections = [];
var keyWords = [];
var path = "";

function AddSection() {
    var li = document.createElement('li');
    var key = document.getElementById('Id_SelectSeccion').value;
    var skillsSelect = document.getElementById("Id_SelectSeccion");
    var selectedText = skillsSelect.options[skillsSelect.selectedIndex].text;

    if (key != '0') {
        Sections.push(key);
        console.log(Sections);
        li.innerHTML = "<li>" + selectedText + "<input type='hidden' name='ListCategories[]' value='" + key + "'/></li>"
        document.getElementById('ListCategories').appendChild(li);
    }
}

function AddKeyWord() {
    var li = document.createElement('li');;
    var keyWord = document.getElementById('Id_KeyWords').value;

    if (keyWord.length > 0) {
        keyWords.push(keyWord);
        console.log(keyWords);
        li.innerHTML = "<li>" + keyWord + "<input type='hidden' name='ListKeyWord[]' value='" + keyWord + "'/></li>"
        document.getElementById('ListKeyWords').appendChild(li);
        document.getElementById("Id_KeyWords").value = "";
    }
}

function CheckDataForNews() {
    var newsTitle = document.getElementById('ID_Titulo_Noticia').value;
    var newsDesc = document.getElementById('idDescNoticia').value;
    var newsText = document.getElementById('idTextNoticia').value;
    var contry = document.getElementById('ID_Pais').value;
    var state = document.getElementById('ID_Estado').value;
    var municipio = document.getElementById('ID_Municipio').value;
    var colonia = document.getElementById('ID_Colonia').value;
    var listCategories = document.getElementById('ListCategories');
    var listKey = document.getElementById('ListKeyWords');
    var date = document.getElementById('idDate').value;

    if (newsTitle != '' && newsDesc != '' && newsText != '' && contry != '' && state != ''
        && municipio != '' && colonia != '' && listCategories.childElementCount > 0
        && listKey.childElementCount > 0 && date != "") {
        createNews();
        getRecentAddedID();
        Swal.fire({
            icon: 'success',
            title: 'Noticia agregada exitosamente',
            text: 'La noticia ha sido agregada exitosamente'
        });

        //Display Multimedia
        document.getElementById("submitNews").setAttribute("style", "display: none");
        document.getElementById("Id_InputFileImagenPerfil").setAttribute("style", "display: none");
        document.getElementById("idDivMultimedia").setAttribute("style", "display: block");

        //Make news ReadOnly
        document.getElementById("Id_InputFileImagenPerfil").setAttribute("style", "display: none");
        document.getElementById("btnSelectCat").setAttribute("style", "display: none");
        document.getElementById("btnSelectClave").setAttribute("style", "display: none");

        document.getElementById('ID_Titulo_Noticia').readOnly = true;
        document.getElementById('idDescNoticia').readOnly = true;
        document.getElementById('idTextNoticia').readOnly = true;
        document.getElementById('ID_Pais').readOnly = true;
        document.getElementById('ID_Estado').readOnly = true;
        document.getElementById('ID_Municipio').readOnly = true;
        document.getElementById('ID_Colonia').readOnly = true;
        document.getElementById('idDate').readOnly = true;


        return true;
    }
    else {
        Swal.fire({
            icon: 'error',
            title: 'Favor de llenar todos los campos',
            text: 'Todos los campos son obligatorios, favor de llenarlos'
        });
        return false;
    }
}

function CheckDataForNewsEdit(id) {
    var newsTitle = document.getElementById('ID_Titulo_Noticia').value;
    var newsDesc = document.getElementById('idDescNoticia').value;
    var newsText = document.getElementById('idTextNoticia').value;
    var contry = document.getElementById('ID_Pais').value;
    var state = document.getElementById('ID_Estado').value;
    var municipio = document.getElementById('ID_Municipio').value;
    var colonia = document.getElementById('ID_Colonia').value;
    var date = document.getElementById('idDate').value;
    if (newsTitle != '' && newsDesc != '' && newsText != '' && contry != '' && state != ''
        && municipio != '' && colonia != '' && date != "") {
        editNews(id);
        Swal.fire({
            icon: 'success',
            title: 'Noticia editada exitosamente',
            text: 'La noticia ha sido editada exitosamente'
        });
        return true;
    }
    else {
        Swal.fire({
            icon: 'error',
            title: 'Favor de llenar todos los campos',
            text: 'Todos los campos son obligatorios, favor de llenarlos'
        });
        return false;
    }
}

function editNews(id) {
    var dataForm = new FormData();
    dataForm.append('ajax_Edit_News', 1);
    dataForm.append('newsID', id);
    dataForm.append('ID_User', $("#ID_User").val());
    dataForm.append('ID_Titulo_Noticia', $("#ID_Titulo_Noticia").val());
    dataForm.append('idDescNoticia', $("#idDescNoticia").val());
    dataForm.append('idTextNoticia', $("#idTextNoticia").val());
    dataForm.append('ID_Pais', $("#ID_Pais").val());
    dataForm.append('ID_Estado', $("#ID_Estado").val());
    dataForm.append('ID_Municipio', $("#ID_Municipio").val());
    dataForm.append('ID_Colonia', $("#ID_Colonia").val());
    dataForm.append('ListKeyWord', keyWords);
    dataForm.append('ListCategories', Sections);
    dataForm.append('idDate', $("#idDate").val());
    dataForm.append('image', $("#Id_InputFileImagenPerfil").get(0).files[0]);
    console.log($("#ID_User").val());
    $.ajax({
        url: '../includes/news_inc.php',
        type: 'POST',
        data: dataForm,
        dataType: 'json',
        mimeType: 'multipart/form-data',
        contentType: false,
        cache: false,
        processData: false,
        success: function (json) {
            var data_array = $.parseJSON(json);
            console.log(data_array);
        },
        error: function (jqXHR, status, error) {
            console.log(jqXHR);
            console.log(status);
            console.log(error);
        },
        complete: function (jqXHR, status) {
        }
    });
}

function createNews() {
    var dataForm = new FormData();
    dataForm.append('ajax_Create_News', 1);
    dataForm.append('ID_User', $("#ID_User").val());
    dataForm.append('ID_Titulo_Noticia', $("#ID_Titulo_Noticia").val());
    dataForm.append('idDescNoticia', $("#idDescNoticia").val());
    dataForm.append('idTextNoticia', $("#idTextNoticia").val());
    dataForm.append('ID_Pais', $("#ID_Pais").val());
    dataForm.append('ID_Estado', $("#ID_Estado").val());
    dataForm.append('ID_Municipio', $("#ID_Municipio").val());
    dataForm.append('ID_Colonia', $("#ID_Colonia").val());
    dataForm.append('ListKeyWord', keyWords);
    dataForm.append('ListCategories', Sections);
    dataForm.append('idDate', $("#idDate").val());
    dataForm.append('image', $("#Id_InputFileImagenPerfil").get(0).files[0]);
    console.log(dataForm);
    $.ajax({
        url: '../includes/news_inc.php',
        type: 'POST',
        data: dataForm,
        dataType: 'json',
        mimeType: 'multipart/form-data',
        contentType: false,
        cache: false,
        processData: false,
        success: function (json) {
            var data_array = $.parseJSON(json);
            console.log(data_array);
        },
        error: function (jqXHR, status, error) {
            console.log(jqXHR);
            console.log(status);
            console.log(error);
        },
        complete: function (jqXHR, status) {
        }
    });
}

function getRecentAddedID() {
    $.ajax({
        url: '../includes/news_inc.php',
        type: 'POST',
        data: { 'ajax_sumbit_AddedID': 1 },
        success: function (json) {
            var data_array = $.parseJSON(json);
            var html = "";
            for (let key of data_array) {
                if (key['PARENT'] == null) {
                    html = html.concat('<input id="id_news" value="', key['NEWS_ID'], '">', key['NEWS_ID'], '</input>');
                }
            }
            $("#dividNew").html(html);
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

function setImage(event, idImage) {
    var output = document.getElementById(idImage);

    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src);
        path = URL.createObjectURL(event.target.files[0]);
    }
}

function setMultimedia(event, idImage) {
    var output = document.getElementById(idImage);
    var file = document.getElementById("Id_InputFileImagenMultimedia");

    var filePath = file.value;
    var allowedExtensions = /(\.mp4)$/i;

    if (!allowedExtensions.exec(filePath)) {
        output.style.display = "block";
        document.getElementById("video").style.display = "none";
        console.log("Foto");
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src);
            path = URL.createObjectURL(event.target.files[0]);
        }
    }
    else {
        output.style.display = "none";
        console.log("Video");
        var media = URL.createObjectURL(event.target.files[0]);
        var video = document.getElementById("video");
        video.src = media;
        video.style.display = "block";
        path = media;
    }
    console.log(path);
}

function showCategories() {
    $.ajax({
        url: '../includes/newsCategory_inc.php',
        type: 'POST',
        data: { 'ajax_sumbit_all': 1 },
        success: function (json) {
            var data_array = $.parseJSON(json);
            var html = "";
            for (let key of data_array) {
                if (key['PARENT'] == null) {
                    html = html.concat('<option value="', key['SECTION_ID'], '">', key['SECTION_NAME'], '</option>');
                }
            }
            $("#Id_SelectSeccion").html(html);
            document.getElementById("Id_SelectSeccion").removeAttribute("onclick");
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

function AddPhoto() {
    var dataForm = new FormData();
    dataForm.append('ajax_sumbit_Photo', 1);
    dataForm.append('ID_News', $("#id_news").val());
    dataForm.append('Type', 'F');
    dataForm.append('image', $("#Id_InputFileImagenMultimedia").get(0).files[0]);
    console.log(dataForm);

    $.ajax({
        url: '../includes/news_inc.php',
        type: 'POST',
        data: dataForm,
        dataType: 'json',
        mimeType: 'multipart/form-data',
        contentType: false,
        cache: false,
        processData: false,
        success: function (json) {
        },
        error: function (jqXHR, status, error) {
            console.log(status);
            console.log(error);
        },
        complete: function (jqXHR, status) {
            var carrusel = document.getElementById("idCarousel").childElementCount;
            var html = document.getElementById("idCarousel").innerHTML;
            console.log(html);
            if (carrusel == 0) {
                html += '<div class="carousel-item active">';
            }
            else {
                html += '<div class="carousel-item">';
            }
            html += '<img src="' + path + '" class="d-block w-100" alt="..."></div>';
            $("#idCarousel").html(html);
        }
    });
    Swal.fire({
        icon: 'success',
        title: 'Imagen agregada exitosamente',
        text: 'La imagen ha sido agregada exitosamente'
    });
}

function AddVideo() {
    var dataForm = new FormData();
    dataForm.append('ajax_sumbit_Video', 1);
    dataForm.append('ID_News', $("#id_news").val());
    dataForm.append('Type', 'V');
    dataForm.append('image', $("#Id_InputFileImagenMultimedia").get(0).files[0]);

    $.ajax({
        url: '../includes/news_inc.php',
        type: 'POST',
        data: dataForm,
        dataType: 'json',
        mimeType: 'multipart/form-data',
        contentType: false,
        cache: false,
        processData: false,
        success: function (json) {

        },
        error: function (jqXHR, status, error) {
            console.log(status);
            console.log(error);
        },
        complete: function (jqXHR, status) {
            var carrusel = document.getElementById("idCarousel").childElementCount;
            var html = document.getElementById("idCarousel").innerHTML;
            if (carrusel == 0) {
                html += '<div class="carousel-item active">';
            }
            else {
                html += '<div class="carousel-item">';
            }
            html += '<video class="d-block w-100" controls="controls" poster="image" preload="metadata">';
            html += '<source src="' + path + '" type="video/mp4"/>' + '</video></div>';

            $("#idCarousel").html(html);
        }
    });
    Swal.fire({
        icon: 'success',
        title: 'Video agregado exitosamente',
        text: 'La video ha sido agregada exitosamente'
    });
}

