<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preload" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="preload" href="../css/style_InicioEditor.css">
    <link rel="stylesheet" href="../css/style_InicioEditor.css">

    <link rel="preload" href="../css/style.css">
    <link rel="stylesheet" href="../css/style.css">

    <link rel="preload" href="../css/sweetalert2.css">
    <link rel="stylesheet" href="../css/sweetalert2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700;900&display=swap" rel="stylesheet">

</head>

<body>

    <?php
    include('../html/template/Head.php');
    include('../html/template/nav.php');
    if (isset($_SESSION["USER_ID"])) {
        $userID = $_SESSION["USER_ID"];
        $userName = $_SESSION["USER_FULL_NAME"];
        $userType = $_SESSION["USER_ROL"];
        if ($userType != "Editor") {
    ?>
            <script>
                window.location.replace("../html/index.php");
            </script>
        <?php
        }
    } else { ?>
        <script>
            window.location.replace("../html/index.php");
        </script>
    <?php
    } ?>

    <div class="BackGround">
        <div class="Container_InicioEditor">
            <div class="Container_ColorSecciones">
                <div class="Titulo_Area">
                    <hr>
                    <h2>Color de Secciones</h2>
                    <hr>
                </div>
                <div class="Box_ColorSecciones">
                    <div class="Container_SeleccionColorNombreSeccion">
                        <div class="Box_SeleccionSeccion">
                            <label for="ID_NombreSeleccion">Nombre de la seccion:</label>
                            <select id="Id_SelectSeccion" onclick="showCategories('Id_SelectSeccion');" onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                            </select>
                        </div>
                        <div class="Box_SeleccionColorSeccion">
                            <label for="ID_ColorSeccion">Color de la seccion:</label>
                            <div class="Box_ColorInput">
                                <input class="inputColor" type="color" id="idColorEditar">
                            </div>
                        </div>
                        <div class="Box_ActualizarColorSeleccion">

                            <input type="button" onclick=editarColorSeccion() value="Actualizar">

                        </div>
                    </div>
                </div>
            </div>
            <div class="Container_OrdenSecciones">
                <div class="Titulo_Area">
                    <hr>
                    <h2>Orden de secciones</h2>
                    <hr>
                </div>
                <div class="Box_OrdenSecciones">
                    <div class="Container_SeleccionInputSeccionIndice">
                        <div class="Box_OrdenSeleccionSecciones">
                            <label for="ID_SelectNombreSeccionOrden">Nombre de la seccion</label>
                            <select name="" id="ID_SelectNombreSeccionOrden" onclick="showCategories('ID_SelectNombreSeccionOrden');" onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                            </select>
                        </div>
                        <div class="Box_SeleccionSeccion">
                            <label for="ID_NombreSeleccion">Importancia de secciones:</label>
                            <select name="" id="Id_OrdenSeccionEdit">
                                <option value="-">-</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <div class="Box_OrdenButtonActualizar">

                            <input type="button" onclick=ConfirmSecciones() value="Actualizar">
                        </div>
                    </div>
                </div>
            </div>
            <div class="Container_ReporterosEliminar">
                <div class="Titulo_Area">
                    <hr>
                    <h2>Reporteros por Eliminar</h2>
                    <hr>
                </div>
                <div class="Box_ReporterosEliminar">
                    <div class="Container_SeleccionButtonReporteroEliminar">
                        <div class="Box_ReporteroSeleccion">


                            <label for="">Nombre del reportero:</label>
                            <select name="" id="ID_ReporterosDelete" onclick="showReporteros('D','ID_ReporterosDelete');" onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                            </select>
                        </div>
                        <div class="Box_ReporteroButtonEliminar">
                            <button onclick="update_Reportero('ID_ReporterosDelete', 'D')" id="Id_ButtonEliminarReportero">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="Container_ReporterosEliminar" hidden>
                <div class="Titulo_Area">
                    <hr>
                    <h2>Reporteros a habilitar</h2>
                    <hr>
                </div>
                <div class="Box_ReporterosEliminar">
                    <div class="Container_SeleccionButtonReporteroEliminar">
                        <div class="Box_ReporteroSeleccion">


                            <label for="">Nombre del reportero:</label>
                            <select name="" id="ID_ReporterosHabilitar" onclick="showReporteros('A','ID_ReporterosHabilitar');" onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                            </select>
                        </div>
                        <div class="Box_ReporteroButtonEliminar">
                            <button onclick="update_Reportero('ID_ReporterosHabilitar', 'A')" id="Id_ButtonEliminarReportero">Habilitar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="Container_SeccionAgregar">
                <div class="Titulo_Area">
                    <hr>
                    <h2>Agregar seccion</h2>
                    <hr>
                </div>
                <div class="Box_SeccionAgregar">

                    <div class="Container_InputButtonTexareaSeccionAgregar">
                        <div class="Container_InputsAgrugarSecciones">
                            <div class="Box_SeccionAgregarTextArea">
                                <label for="ID_TextAreaDescripcionSeccion">Descripcion: </label>
                                <input type="text" id="ID_TextAreaDescripcionSeccion" class="texto_Actualiza" placeholder="Descripcion de la categoria">
                            </div>
                            <div class="Box_SeccionAgregarInput">


                                <label for="ID_InputNombreSeccion">Nombre de la Seccion: </label>
                                <input type="text" id="ID_InputNombreSeccion">
                            </div>
                        </div>
                        <div class="Container_InputsAgrugarSecciones">
                            <div class="Box_SeleccionColorSeccion">
                                <label for="ID_ColorSeccion">Color de la seccion:</label>

                                <input type="color" id="idColorAgregar">
                            </div>
                            <div class="Box_SeleccionSeccion">
                                <label for="ID_NombreSeleccion">Importancia de secciones:</label>
                                <select name="" id="Id_OrdenSeccionAgregar">
                                    <option value="-">-</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>
                        <div class="Box_AgregarSeccionButton">

                            <input type="submit" placeholder="Agregar" onclick=ValidacionCreacionCategoria()>
                        </div>
                    </div>

                </div>
            </div>





            <div class="Container_NoticiasPendiente">
                <div>
                    <hr>
                    <h2>Noticias pendientes</h2>
                    <hr>
                </div>
                <div>
                    <div class="RowContainer_Noticias" id="divPendingNews">

                    </div>
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


    <script>
        loadPendingNews();
    </script>



</body>

</html>