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
        <div class="Container_ReporteSecciones">
            <div class="Titulo_Principal">
                <hr>
                <h2>Reporte de secciones</h2>
                <hr>
            </div class="">
            <div class="Container_Filtro_Tabla">
                <div class="Titulo_Secundario">
                    <h2>Filtro de de reporte de secciones</h2>
                </div>
                <form class="Box_FiltroSubmit">
                    <div class="Box_Filtro">
                        <div class="Box_DataFiltro">
                            <div>
                                <label for="Id_SelectSecciones">Secciones</label>
                            </div>
                            <div class="SelectBox">
                                <select name="" id="Id_SelectSecciones" onclick="showCategories();" onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                    <option value="0">Todas</option>
                                    <option value="1">Deportes</option>
                                </select>
                            </div>
                        </div>
                        <div class="Box_DataFiltro">
                            <div>
                                <label for="Id_SelectTypeReporte">Secciones</label>
                            </div>
                            <div class="SelectBox">
                                <select name="" id="Id_SelectTypeReporte" onclick="showCategories();" onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                    <option value="0">Detalle por noticia</option>
                                    <option value="1">Detalle por secciones</option>
                                </select>
                            </div>
                        </div>
                        <div class="Box_DataFiltro">
                            <div>
                                <label for="ID_Fecha1ReporteSecciones">Fecha 1</label>
                            </div>

                            <input type="date" name="" id="ID_Fecha1ReporteSecciones">

                        </div>
                        <div class="Box_DataFiltro">
                            <div>
                                <label for="ID_Fecha2ReporteSecciones">Fecha 2</label>
                            </div>

                            <input type="date" name="" id="ID_Fecha2ReporteSecciones">

                        </div>
                    </div>
                    <div class="Box_ButtonDetalleReporte">
                        <input type="button" value="Generar">
                    </div>
                </form>
                <div class="Container_TablasReporte">
                    <hr>
                    <div class="Titulo_Secundario">
                        <h3>Detalle de Reporte</h3>
                    </div>
                    <div class="Box_TablaDetallePorSecciones">
                        <table class="table">
                            <thead>
                                <tr>

                                    <th scope="col">Seccion </th>
                                    <th scope="col">Mes/Año</th>
                                    <th scope="col">Likes</th>
                                    <th scope="col">Comentarios</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <td>Deportes</td>
                                    <td>07/2021</td>
                                    <td>100</td>
                                    <td>10</td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="Box_TablaDetallePorNoticias">
                        <table class="table">
                            <thead>
                                <tr>

                                    <th scope="col">Seccion </th>
                                    <th scope="col">Mes/Año</th>
                                    <th scope="col">Noticia</th>
                                    <th scope="col">Likes</th>
                                    <th scope="col">Comentarios</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <td>Deportes</td>
                                    <td>07/2021</td>
                                    <td>Pierde tigres</td>
                                    <td>100</td>
                                    <td>10</td>

                                </tr>

                            </tbody>
                        </table>
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
    </div>
</body>

</html>