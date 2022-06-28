function ValidacionCreacionCategoria() {

  var ID_InputDescripcionSeccion = document.getElementById("ID_TextAreaDescripcionSeccion").value;
  var ID_InputNombreSeccion = document.getElementById("ID_InputNombreSeccion").value;
  var ColorSeccion = document.getElementById("idColorAgregar").value;
  var ID_OrdenSeccion = document.getElementById("Id_OrdenSeccionAgregar").value;

  if (ID_OrdenSeccion != '-' && ID_InputNombreSeccion != '' && ID_InputDescripcionSeccion != '' && ColorSeccion != "#000000" && ColorSeccion != "#ffffff") {
    if (ID_InputDescripcionSeccion.length <= 250) {
      addSection(ID_InputNombreSeccion, ID_InputDescripcionSeccion, ColorSeccion, ID_OrdenSeccion);
      Swal.fire({
        icon: 'success',
        title: 'Ingreso exitoso',
        showConfirmButton: false,
        timer: 1500
      });
      document.getElementById("ID_SelectNombreSeccionOrden").addAttribute("onclick");
      document.getElementById("ID_TextAreaDescripcionSeccion").innerHTML = "";
      document.getElementById("Id_OrdenSeccionAgregar").value = '-';
    }
    else {
      window.alert('Error al ingresar descripcion');
      Swal.fire({
        icon: 'error',
        title: 'Error al ingresar seccion',
        text: 'Descripcion demasiado larga',

      });
    }
  }
  else {
    Swal.fire({
      icon: 'error',
      title: 'Error al ingresar seccion',
      text: 'Ingrese nombre y descripcion de la seccion',
    });
  }
}

function validacionEliminarReportero() {
  var BottonEliminar = document.getElementById("Id_DropBoxReporteros").value;
  if (BottonEliminar != '') {
    Swal.fire({
      icon: 'succes',
      title: 'Reportero eliminado',
      text: 'Reportero eliminado y noticias pendientes tambien',
    });
  } else {
    Swal.fire({
      icon: 'error',
      title: 'No sé a seleccionado ningún reportero',
      text: 'Seleccione un reportero para eliminar',
    });
  }

}

function editarColorSeccion() {
  var key = document.getElementById('Id_SelectSeccion').value;
  var ColorSeccion = document.getElementById("idColorEditar").value;
  if (key != "" && ColorSeccion != "#000000" && ColorSeccion != "#ffffff") {
    editCategoryColor(key, ColorSeccion);
    Swal.fire({
      icon: 'success',
      title: 'Seccion actualizada',
      text: 'Color asignado a la sección',
    });
    document.getElementById("Id_SelectSeccion").addAttribute("onclick");
  } else {
    Swal.fire({
      icon: 'error',
      title: 'No sé han llenado los campos',
      text: 'Favor de llenar ambos campos',
    });
  }
}

function editCategoryColor(ID, ColorSeccion) {
  $.ajax({
    url: '../includes/loginEditor_inc.php',
    type: 'POST',
    data: {
      'ajax_edit_color': 1,
      'catColor': ColorSeccion,
      'catID': ID
    },
    success: function (json) {
      var data_array = $.parseJSON(json);
      console.log(data_array);
    },
    error: function (jqXHR, status, error) {
    },
    complete: function (jqXHR, status) {
    }
  });
}

function showCategories(dropdown) {
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
      $("#" + dropdown).html(html);
      document.getElementById("#" + dropdown).removeAttribute("onclick");
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

function addSection(NombreSeccion, DescripcionSeccion, Color, Orden) {
  $.ajax({
    url: '../includes/loginEditor_inc.php',
    type: 'POST',
    data: {
      'ajax_add_cat': 1,
      'catColor': Color,
      'catName': NombreSeccion,
      'catDesc': DescripcionSeccion,
      'ordenSec': Orden
    },
    success: function (json) {
      var data_array = $.parseJSON(json);
      console.log(data_array);
    },
    error: function (jqXHR, status, error) {
    },
    complete: function (jqXHR, status) {
    }
  });
}


function ConfirmSecciones() {
  var SeleccionSeccion = document.getElementById('ID_SelectNombreSeccionOrden').value;
  var Indice = document.getElementById('Id_OrdenSeccionEdit').value;
  if (Indice != '-' && SeleccionSeccion > 0) {

    editarOrder(SeleccionSeccion, Indice);
    Swal.fire({
      icon: 'sucess',
      title: 'Importancia modicicada',
      text: 'La importancia de la seccion ha sido modificada',
    })
  }
  else {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Ingrese los datos correctamnete, digite un indice y seleccione una seccion',
    });
  }
}

function editarOrder(NombreSeccion, Orden) {
  console.log(NombreSeccion);
  $.ajax({
    url: '../includes/loginEditor_inc.php',
    type: 'POST',
    data: {
      'ajax_edit_order_cat': 1,
      'catName': NombreSeccion,
      'ordenSec': Orden
    },
    success: function (json) {
      var data_array = $.parseJSON(json);
      console.log(data_array);
    },
    error: function (jqXHR, status, error) {
    },
    complete: function (jqXHR, status) {
    }
  });
}

function loadPendingNews() {
  $.ajax({
    url: '../includes/loginEditor_inc.php',
    type: 'POST',
    data: { 'ajax_pending_news': 1 },
    success: function (json) {
      var data_array = $.parseJSON(json);
      var html = "";
      var count = 0;
      console.log(data_array);
      for (let key of data_array) {
        if (count == 0) {
          html = html.concat(' <div class="RowContainer_NoticiasMasVistas">');
        }
        html = html.concat('<div class="Box_NoticiasMasVistas"><div class="Box_ImagenNoticia"><img src="' + key['COVER_PHOTO'] + '"></div>');
        html = html.concat('<div class="Box_ContNoticia">');
        html = html.concat('<div class="Box_TituloNoticia"><h3> ', key['NEWS_TITLE'], ' </h3></div>');
        html = html.concat('<div class="Box_ResumenNoticia"><p>', key['DESCRIP'], '</p></div>');
        html = html.concat('<div class="Box_FormLeerMasFechaNoticia">');
        html = html.concat('<form action="../includes/loginEditor_inc.php" method="POST">');
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
    },
    complete: function (jqXHR, status) {
      //alert('Petición realizada');
    }
  });
}

function reject(IDNews) {
  $.ajax({
    url: '../includes/loginEditor_inc.php',
    type: 'POST',
    data: {
      'rejectNews': 1,
      'ID_News': IDNews
    },
    success: function (json) {
    },
    error: function (jqXHR, status, error) {
    },
    complete: function (jqXHR, status) {
      Swal.fire({
        icon: 'succes',
        title: 'Noticia Rechazada',
        text: 'La notica rechazada',
      });
    }
  });
}

function approve() {
  Swal.fire({
    icon: 'succes',
    title: 'Noticia aprovada',
    text: 'La notica aprovada y publicada',
  });
  return true;
}


function showReporteros(opc, dropdown) {
  $.ajax({
    url: '../includes/loginEditor_inc.php',
    type: 'POST',
    data: {
      'ajax_sumbit_rep': 1,
      'opc': opc
    },
    success: function (json) {
      var data_array = $.parseJSON(json);
      var html = "";
      for (let key of data_array) {
        html = html.concat('<option value="', key['USER_ID'], '">', key['USER_FULL_NAME'], '</option>');
      }
      $("#" + dropdown).html(html);
      document.getElementById("#" + dropdown).removeAttribute("onclick");
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

function update_Reportero(dropdown, opc) {
  var key = document.getElementById(dropdown).value;
  console.log(key);
  if (key != "") {
    if (opc == 'D') {
      updateReportero(key, 0);
      Swal.fire({
        icon: 'success',
        title: 'Reportero actualizado',
        text: 'El reportero ha sido eliminado',
      });
    }
    else {
      updateReportero(key, 1);
      Swal.fire({
        icon: 'success',
        title: 'Reportero actualizado',
        text: 'El reportero ha sido habilitado',
      });
    }
    document.getElementById("#" + dropdown).addAttribute("onclick");
  } else {
    Swal.fire({
      icon: 'error',
      title: 'No hay seleccion',
      text: 'Favor de seleccionar a un reportero',
    });
  }
}

function updateReportero(ID, OPC) {
  $.ajax({
    url: '../includes/loginEditor_inc.php',
    type: 'POST',
    data: {
      'updateReportero': 1,
      'ID': ID,
      'OPC': OPC
    },
    success: function (json) {
    },
    error: function (jqXHR, status, error) {
    },
    complete: function (jqXHR, status) {
    }
  });
}