function backToTop() {
    document.body.scroll = 0;
    document.documentElement.scrollTop = 0
}

function showBusqueda() {
    // document.getElementById("Id_Container_Busqueda").classList.toggle("show");

    var ShowDiv = document.getElementById('Id_Container_Busqueda');
    ShowDiv.style.display = "flex";
    var HideDiv = document.getElementById('Id_Container_EnlacesNoticias');
    HideDiv.style.display = "none";
}

function hideBusqueda() {
    var HideDiv = document.getElementById('Id_Container_Busqueda');
    HideDiv.style.display = "none";
}

function showMasSecciones() {
    $.ajax({
        url: '../includes/newsCategory_inc.php',
        type: 'POST',
        data: { 'ajax_sumbit': 1 },
        success: function (json) {
            var data_array = $.parseJSON(json);
            var html = "";
            var count = 0;
            for (let key of data_array) {
                if (count % 10 == 0) {
                    if (count != 0) {
                        html = html.concat('</div>');
                        html = html.concat('<div class="Colum_MasSecciones">');
                    }
                    else {
                        html = html.concat('<div class="Colum_MasSecciones">');
                    }
                }
                if (count % 5 == 0) {
                    if (count != 0) {
                        html = html.concat('</div>');
                        html = html.concat('<div class="Row_MasSecciones">');
                    }
                    else {
                        html = html.concat('<div class="Row_MasSecciones">');
                    }
                }
                if (key['PARENT'] == null) {
                    //html = html.concat('<button type="button" id="',key['SECTION_ID'],'" style="color:#' ,key['HEXADECIMAL'],'; padding: 10px;" onclick="showNewsByCategory(',key['SECTION_ID'],')">',key['SECTION_NAME'],'</button>');
                    html = html.concat('<form action="../includes/newsCategory_inc.php" method="POST">');
                    html = html.concat('<input type="text" name="id_Category" value="' + key['SECTION_ID'] + '"hidden>');
                    html = html.concat('<input type="submit" name="category" value="' + key['SECTION_NAME'] + '"></form>');
                }
                count++;
            }
            html = html.concat('</div>');
            html = html.concat('</div>');
            $("#SectionHolder").html(html);

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


    var ShowDiv = document.getElementById('Id_Container_EnlacesNoticias');
    ShowDiv.style.display = "flex";

    var HideDiv = document.getElementById('Id_Container_Busqueda');
    HideDiv.style.display = "none";
}

function hideMasSecciones() {
    var HideDiv = document.getElementById('Id_Container_EnlacesNoticias');
    HideDiv.style.display = "none";
}

function showNewsByCategory(id) {
    //TODO: Cargar por secciones
    alert(id);
}

function showFiveSecciones() {
    $.ajax({
        url: '../includes/newsCategory_inc.php',
        type: 'POST',
        data: { 'ajax_sumbit_five': 1 },
        success: function (json) {
            var data_array = $.parseJSON(json);
            var html = "";
            for (let key of data_array) {
                if (key['PARENT'] == null) {
                    html = html.concat('<form class="FormFieveSecciones" action="../includes/newsCategory_inc.php" method="POST" style="background-color:', key['HEXADECIMAL'], ';" >');
                    html = html.concat('<input type="text" name="id_Category" value="' + key['SECTION_ID'] + '"hidden>');
                    //html = html.concat('<button type="button" id="',key['SECTION_ID'],'" style="color:#' ,key['HEXADECIMAL'],'; padding: 10px;" onclick="showNewsByCategory(',key['SECTION_ID'],')">',key['SECTION_NAME'],'</button>');
                    html = html.concat('<input type="submit" class="FormFieveSecciones" name="category" value="' + key['SECTION_NAME'] + '" ></form>');
                }
            }
            $("#CatContainer").html(html);
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


    var ShowDiv = document.getElementById('Id_Container_EnlacesNoticias');
    //ShowDiv.style.display = "flex";

    var HideDiv = document.getElementById('Id_Container_Busqueda');
    //HideDiv.style.display = "none";
}