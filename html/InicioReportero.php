<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preload" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="preload" href="../css/style_InicioReportero.css">
    <link rel="stylesheet" href="../css/style_InicioReportero.css">
    <link rel="preload" href="../css/style.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preload" href="../css/sweetalert2.css">
    <link rel="stylesheet" href="../css/sweetalert2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700;900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
<?php
    include('../html/template/Head.php');
    include('../html/template/nav.php'); 
    if (isset($_SESSION["USER_ID"])) {
        $userID = $_SESSION["USER_ID"];
        $userName = $_SESSION["USER_FULL_NAME"];
        $userType = $_SESSION["USER_ROL"];
        if($userType != "Reportero"){
            ?>
        <script>
            window.location.replace("../html/index.php");
        </script>
    <?php
        }

    }
    else{?>
        <script>
            window.location.replace("../html/index.php");
        </script>
    <?php
    }?>
    <div class="BackGround">
        <div class="Container_InicioReportero">
            <div class="Container_noticias_Rechazadas">

                <div class="Box_NuevaNoticia">
                    <a href="NewsCreation.php">Nueva noticia</a>
                </div>

                <input type="text" value="<?php echo $userID; ?>" id="userID" hidden>

                <div class="Box_NoticiaRechazadas">
                    <div class="">
                        <hr>
                        <h2>Noticia rechazadas</h2>
                        <hr>
                    </div>

                    <div class=" RowContainer_NoticiasRechazadas" id="divRejectedNews">>
                    </div>
                </div>

                <div class="Box_NoticiaRechazadas">
                    <div class="">
                        <hr>
                        <h2>Noticias Pendientes</h2>
                        <hr>
                    </div>

                    <div class="RowContainer_NoticiasRechazadas" id="divPendingNews">
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


    <script>
        
        loadPendingNewsReportero(<?php echo $userID ?>);
        loadRejectedNews(<?php echo $userID ?>);
    </script>

    
</body>

</html>