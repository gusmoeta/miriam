<?php 
// echo "request<br><br>";
// var_dump($_REQUEST);
// echo "session<br><br>";
// var_dump($_SESSION);
// echo "sesion name<br><br>";
// var_dump(session_name());
// echo "sesion id<br><br>";
// var_dump(session_id());
// echo "<br><br>";
// echo "sesion user " . $_SESSION['usuario'] . "<br><br>";
// echo "sesiin contra " . $_SESSION['contra'] . "<br><br>";
?>
<!DOCTYPE HTML>
    <html lang="es">
        <head>
            <title>Proyecto</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">            
            <!-- ICONOS Y FUENTES -->
            <link rel="icon" href="../web/images/icon.png" type="image/png">
            <!-- <script defer src="https://use.fontawesome.com/releases/v5.0.12/js/all.js" integrity="sha384-Voup2lBiiyZYkRto2XWqbzxHXwzcm4A5RfdfG6466bu5LqjwwrjXCMBQBLMWh7qR" crossorigin="anonymous"></script> -->
            <link href="../web/css/fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.css" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
            <!-- ESTILOS -->
            <link rel="stylesheet" href="../web/jquery-ui-1.12.1.custom/jquery-ui.css">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">         
            <link rel="stylesheet" href="../web/toaster/css/jquery.notify.css">
            <link rel="stylesheet" href="../web/css/estilo_menu.css">
            <link rel="stylesheet" href="../web/css/estilo_card.css">
            <link rel="stylesheet" href="../web/css/estilo_forms.css">
            <link rel="stylesheet" href="../web/css/estilo_categorias.css">
            <link rel="stylesheet" href="../web/css/estilo_perfil.css">
            <!-- SCRIPTS -->
            <script type="text/javascript" src="../web/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
            <script type="text/javascript" src="../web/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
            <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
            <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
            <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> -->
            <script type="text/javascript" src="../web/toaster/js/jquery.notify.min.js"></script>
            <script type="text/javascript" src="../web/toaster/js/toaster.js"></script>
            <script type="text/javascript" src="../web/js/cards.js"></script>
            <script type="text/javascript" src="../web/js/formularios.js"></script>
            <script type="text/javascript" src="../web/js/menu.js"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.js"></script>
            </head>
            
            <body>     
            <!-- <body onresize="tamano()">      -->
            <!-- <p id="an"></p>        -->
            <header>
            <!-- BARRA SUPERIOR MÓVIL -->
            <div class="menu_bar">
                <div class="tit1">
                        <p class="titulo"><?php echo $params['titulo'] ?></p>
                </div>                
                <div class="botones">                    
                    <div class="trash_btn">
                        <a href="#" class="trash-icono"><i class="fas fa-trash"></i></a>
                    </div>
                    <div class="search_btn">
                        <a href="#" class="search-icono"><i class="fas fa-search"></i></a>
                    </div>

                </div>           
                <div class="input-group buscar">
                    <form action="index.php?ctl=buscar_alimento" method="POST">
                        <input type="search" name="buscar" placeholder="Buscar alimento">
                    </form>
                    </div>     
                <div class="menu_btn">
                    <a href="#" class="menu-icono"><i class="fas fa-bars"></i></a>
                </div>                
            </div>
            <!-- MENU LATERAL -->
            <nav>
                <ul>
                    <li><a href="index.php?ctl=perfil_usuario" class="btn-menu-usr">       <i class="fas fa-user-circle fa-fw" style="margin-right: 25px">    </i><?php echo ucfirst($_SESSION['usuario']) ?></a></li>
                    <li><a href="index.php?ctl=inicio" class="btn-menu" id="inicio">       <i class="fas fa-home" style="margin-right: 25px">                 </i>Inicio</a></li>
                    <li><a href="index.php?ctl=anadir_alimento" class="btn-menu">          <i class="fas fa-plus-circle fa-fw" style="margin-right: 25px">    </i>Añadir alimento</a></li>
                    <li><a href="index.php?ctl=filtrar" class="btn-menu" id="filtrar_ali"> <i class="fas fa-filter fa-fw" style="margin-right: 25px">         </i>Filtrar</a></li>
                    <li><a href="index.php?ctl=caducados" class="btn-menu">                <i class="fas fa-exclamation-triangle fa-fw" style="margin-right: 25px"></i>Caducados</a></li>
                    <!-- <li><a href="#" class="btn-menu">                            <i class="fas fa-snowflake fa-fw" style="margin-right: 25px">      </i>Congelados</a></li> -->
                    <li><a href="index.php?ctl=categorias" class="btn-menu">               <i class="fas fa-tag fa-fw" style="margin-right: 25px">            </i>Categorías</a></li>
                    <li><a href="index.php?ctl=calendario" class="btn-menu">               <i class="far fa-calendar-alt fa-fw" style="margin-right: 25px">   </i>Calendario</a></li>
                    <li><a href="index.php?ctl=ajustes" class="btn-menu">                  <i class="fas fa-cog fa-fw" style="margin-right: 25px">            </i>Ajustes</a></li>            
                    <li><a href="index.php?ctl=cerrarSession" class="btn-menu">            <i class="fas fa-sign-out-alt" style="margin-right: 25px"></i>            </i>Cerrar sesión</a></li>            
                </ul>
            </nav>
            </header>

            <div id="contenido">
           
                <?php echo $contenido ?>
            </div>



            <!-- BOTON AÑADIR ALIMENTO -->
            <a href="index.php?ctl=anadir_alimento" class="btn-floating" id="demo-success"><i class="fas fa-plus" style="color: #F5F5F5"></i></a>
            
            <!-- PAGINACIÓN -->
            <!-- <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                <li class="page-item disabled"><a class="page-link" href="#">1</a></li>
                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
              </ul>
            </nav> -->

            <footer>
            <!-- <hr/>
            <div align="center">- pie de página -</div> -->
            </footer>

     </body>
     <!-- <script>
        function tamano()
        {
         
            var ancho = window.innerWidth;
            
            parrafo = document.getElementById("an");
            parrafo.innerHTML = ancho;

            

        }
     </script> -->
 </html>