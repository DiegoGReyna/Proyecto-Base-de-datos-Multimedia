<nav class="NavBox">
    <?php
    session_start();
    if (isset($_SESSION["USER_ID"])) {
        $userID = $_SESSION["USER_ID"];
        $userName = $_SESSION["USER_FULL_NAME"];
        $userEmail = $_SESSION["USER_EMAIL"];
        $userType = $_SESSION["USER_ROL"];
        $userPass = $_SESSION["USER_Pass"];
        $userPhoto = $_SESSION["PROFILE_PIC"];
        //
    }
    ?>

    <div class="container_NavPrincipal">
        <div class="NavPrincipal">
            <div class="Container_MenuMasCategorias_Y_InicioPagina">
                <div class="Container_Menu">
                    <div class="Box_ButtonMenuSecciones">
                        <button type="button" class="ButtonMenuSecciones" onclick="showMasSecciones()">
                            <img src="../img/list.svg" alt="menu" height="50" width="50">
                        </button>
                    </div>
                </div>
                <div class="Box_Enlance_inicio">
                    <a href="index.php">Noticias</a>
                </div>
            </div>
            <div class="Container_PerfilBusqueda">
                <div class="Container_ButtonPerfil">
                    <div class="Box_ButtonPerfil">
                        <?php if (isset($_SESSION["USER_ID"])) {
                        ?>
                            <a class="ButtonPerfil" href="UserProfile.php"><?php echo $userName ?></a>
                        <?php
                        } else {
                        ?>
                            <a class="ButtonPerfil" href="login.php">Iniciar sesion</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="Box_BuscarImagenPerfil">
                    <div class="Container_ImagenPerfil">
                        <div class="Box_ImagenPerfil">
                            <?php if (isset($_SESSION["USER_ID"])) {
                                if (isset($userPhoto)) {
                            ?>
                                    <img src="<?php echo  $userPhoto; ?>" class="imagen_Us" alt="">
                                <?php
                                } else {
                                ?>
                                    <img src="../img/person-fill.svg" class="imagen_Us" alt="">
                                <?php
                                }
                            } else {
                                ?>
                                <img src="../img/person-fill.svg" class="imagen_Us" alt="">
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="Container_ButtonBuscar">
                        <div class="Box_ButtonBuscar">
                            <button class="ButtonBuscar" onclick="showBusqueda()">
                                <img src="../img/search.svg" alt="menu" height="65" width="65">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="Container_Busqueda" id="Id_Container_Busqueda">

        <form action="../includes/navBar_inc.php" method="POST" class="Form_Busqueda">
            <div class="Box_HideBusqueda">
                <button onclick="hideBusqueda()">X</button>
            </div>
            <div class="box_RangoFechas">
                <div>
                    <label for="Id_FechaNoticiaBuscar">Fecha 1</label>
                    <input type="date" name="Id_FechaI" id="Id_FechaNoticiaBuscar" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div>
                    <label for="Id_FechaNoticiaBuscar2">Fecha 2</label>
                    <input type="date" name="Id_FechaF" id="Id_FechaNoticiaBuscar2" value="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>
            <div>
                <label for="Id_TituloDescripcion">Titulo</label>
                <input type="text" name="Titulo" id="Id_TituloDescripcion">
            </div>
            <div>
                <label for="Id_PalabrasClaves">Palabra clave</label>
                <input type="text" name="Id_PalabrasClaves" id="Id_PalabrasClaves">
            </div>
            <div class="box_buttonSubmitBuscar">
                <input type="submit" value="Buscar" name="search">
            </div>
        </form>

    </div>
    <div id="Id_Container_EnlacesNoticias">
        <div class="Box_Container_EnlacesNoticias">
            <div class="Container_HideMassSeccines_CerrarSeccion">
                <div class="Box_HideMasSecciones">
                    <button class="" onclick="hideMasSecciones()">X</button>
                </div>
                <div class="Container_CerrarSeccion">
                    <?php if (isset($_SESSION["USER_ID"])) {
                    ?>
                        <!--TODO-->
                        <form class="form_CerrarSession" action="../includes/navBar_inc.php" method="POST">
                            <input id="btnCerrarSesion" class="BtnCerrarSesion" type="submit" name="submit" value="Cerrar sesión" />
                        </form>
                        <?php
                        if ($userType == "Admin") {
                        ?>
                            <a class="BtnAccionRol" href="CreateRepEdit.php">Crear Usuario</a>
                            <a class="BtnAccionRol" href="ReporteSecciones.php">Reporte secciones</a>
                            <?php
                            ?>
                        <?php
                        } elseif ($userType == "Reportero") {
                        ?>
                            <a class="BtnAccionRol" href="InicioReportero.php">Reportero</a>
                            <a class="BtnAccionRol" href="ReporteSecciones.php">Reporte secciones</a>
                        <?php
                        } elseif ($userType == "Editor") {
                        ?>
                            <a class="BtnAccionRol" href="InicioEditor.php">Editor</a>
                            <a class="BtnAccionRol" href="CreateRepEdit.php">Crear Usuario</a>
                            <a class="BtnAccionRol" href="ReporteSecciones.php">Reporte secciones</a>
                        <?php
                        }
                        ?>
                    <?php
                    } ?>
                </div>
            </div>
            <div class="Container_HideMasSecciones">

                <div id="SectionHolder" class="Box_MasSecciones">
                </div>
            </div>

        </div>
    </div>
    <div class="NavSecciones">
        <div class="Container_Secciones" id="CatContainer">
        </div>
    </div>

    <script>
        showFiveSecciones()
    </script>

</nav>