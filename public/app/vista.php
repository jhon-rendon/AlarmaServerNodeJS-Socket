<?php
//include "include/constants.php";
?>
<!DOCTYPE HTML>
<html lang="es">
<head>

	<meta http-equiv="content-type" content="text/html" charset="utf-8"/>
	<meta name="author" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    
    <link rel="shortcut icon" href="images/"/>
    <!--<link  rel="stylesheet" type="text/css" href="<?php echo URL_ADMINISTRACION?>css/reset.css"/> 
    <link  rel="stylesheet" type="text/css" href="<?php echo URL_ADMINISTRACION?>css/style.css"/>
    <link  rel="stylesheet" type="text/css" href="<?php echo URL_ADMINISTRACION?>css/style2.css"/>-->
    <!--<link  rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.10.2.custom.min.css"/>-->
    <!--<link  rel="stylesheet" type="text/css" href="css/overcast/jquery-ui-1.10.2.custom.min.css"/>-->
    
    
    <!--<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />-->
   
    <link  rel="stylesheet" type="text/css" href="<?php echo URL_ADMINISTRACION?>css/bootstrap.min-3.css"/>
    <link  rel="stylesheet" type="text/css" href="<?php echo URL_ADMINISTRACION?>css/jqueryui/jquery-ui-1.10.1.custom.css"/>
    <link  rel="stylesheet" type="text/css" href="<?php echo URL_ADMINISTRACION?>css/style-new.css"/>
   
    <!--<link  rel="stylesheet" type="text/css" href=" http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css"/>-->
    <link  rel="stylesheet" type="text/css" href="<?php echo URL_ADMINISTRACION?>css/jquery.dataTables.css"/>
    <!--<link rel="stylesheet" type="text/css" href="<?php echo URL_ADMINISTRACION?>css/bootstrap-select.css"/>-->
    <link  rel="stylesheet" type="text/css" href="<?php echo URL_ADMINISTRACION?>css/jquery.fancybox.css"/>
	<link  rel="stylesheet" type="text/css" href="<?php echo URL_ADMINISTRACION?>css/jquery.treeview.css"/>
    <style>
    .tamanioModal{width:80% !important;}
    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script src="<?php echo URL_ADMINISTRACION?>js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
    <script src="<?php echo URL_ADMINISTRACION?>js/bootstrap.min-3.js" type="text/javascript"></script>
    <script src="<?php echo URL_ADMINISTRACION?>js/jquery-ui-1.10.2.custom.min.js" type="text/javascript"></script>
    <script src="<?php echo URL_ADMINISTRACION?>js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?php echo URL_ADMINISTRACION?>js/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?php echo URL_ADMINISTRACION?>js/jquery.lightbox_me.js" type="text/javascript"></script>
    <script src="<?php echo URL_ADMINISTRACION?>js/jquery.placeholder.js" type="text/javascript"></script>
    <script src="<?php echo URL_ADMINISTRACION?>js/blockUI.js" type="text/javascript"></script>
    <script src="<?php echo URL_ADMINISTRACION?>js/jquery.fancybox.js" type="text/javascript"></script>
    <!--<script src="js/bootstrap.js" type="text/javascript"></script> -->
    <script src="<?php echo URL_ADMINISTRACION?>js/jquery.treeview.js" type="text/javascript"></script>
    <script src="<?php echo URL_ADMINISTRACION?>js/jquery.cookie.js" type="text/javascript"></script>
    <script src="<?php echo URL_ADMINISTRACION?>js/jquery-barcode.min.js" type="text/javascript"></script>
    <script src="<?php echo URL_ADMINISTRACION?>js/funciones.js" type="text/javascript"></script>
    <!--<script type="text/javascript" src="<?php echo URL_ADMINISTRACION?>js/bootstrap-select.js"></script>-->

   
    <title><?=SITENAME?></title>
    


    
</head>


<body>
    
           
    <aside id='arriba'> 
         <a href='#arriba'><span></span></a> 
    </aside>
    
    
    <nav class="navbar navbar-inverse navbar-fixed-top" id="barMenu">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Navegacion</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=URL_ADMINISTRACION?>">Menu</a>
        </div>
                        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            
            <?php include "menu2.php";?>
            <li style="display: none;"><div id="reloj"  style="color:white;font-size: 16px;font-family: calibri;margin-left:20px;margin-top:9px;"></div></li>
            
            
          </ul>
          <!--<form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>-->
          <!--<ul class="nav navbar-nav navbar-right">
            <li><a href="#">Link</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </li>
          </ul>-->
        </div><!-- /.navbar-collapse -->
        <!--<div style="margin-left:42%;margin-top:-15px;position: absolute;"><span class="glyphicon glyphicon-eye-close text-primary" aria-hidden="true"></span></div>--> 
      </div><!-- /.container-fluid -->
    </nav>
    <?php echo @$_SESSION['username'];?>
    <!--<nav>
       
        <div class="row" style='background-image:url("images/header.jpg");margin-top:5px;'>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="height:39px;">
                <div class="container">
                    <div style="margin-top: 6px;">
                        <i class="glyphicon glyphicon-user white" style="margin-top:3px;"></i>&nbsp; <span style="color:white;">TRANJUANCHACO</span><?php //echo @htmlentities($_SESSION['rsocial']); ?>
                        <button style="margin-top:-5px;margin-left:30px;" class="btn btn-info hidden-xs" onclick="window.location='<?=URL_ADMINISTRACION.'?opcion=cambiar-clave'?>';">Cambiar Clave</button>
                        <button style="margin-top:-5px;" class="btn btn-success hidden-xs" onclick="window.location='<?=URL_ADMINISTRACION.'?opcion=backup'?>';">Backup</button>
                        <button style="margin-top:-5px;" class="btn btn-danger" onclick="$('#dialog-cerrar-seccion').dialog({width:329});return false;">SALIR</button>
                        
                        <div id="reloj" class="hidden-xs" style="float: right;color:white;font-size: 16px;font-family: calibri;margin-left:20px;margin-right:100px;"></div>
                        <div id="hora"  class="hidden-xs"  style="float: right;color:white;font-size: 16px;font-family: calibri;">		  
			             <script type="text/javascript">
                			dows = new Array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
                			months = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                			now = new Date();
                			dow = now.getDay();
                			d = now.getDate();
                			m = now.getMonth();
                			h = now.getTime();
                			y = now.getYear();
                			document.write(dows[dow]+" "+d+" de "+months[m]+" de ");
             			</script>
            			<?php echo date('Y'); ?>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </nav>-->
    
    <header>
         <div class="container" style="margin-top:50px;">
            <div class="row">
                <div class="col-md-offset-4 col-lg-offset-4">
                    <a href="<?=URL_ADMINISTRACION?>"><img src="images/logo-cms.png"  width="400px" class="img-responsive" alt="Logo"/></a>
                </div>
            </div>
        </div>
    </header>
    
    <!--<section id="menu" class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="margin-top:15px;">
               <div class="panel panel-primary" style='background-image: url("images/sec.jpg");background-repeat: repeat-x; box-shadow: 0 0 12px 0 gray;'>
                    <div class="panel-heading" style="text-align: center;">Menu <img src="images/seccion.png" style="float: right;"/></div>
                    <div class="panel-body">
                        <?php //require_once "menu.php";?>
                    </div>
               </div>
    </section>-->
    <div class="container-fluid" style="margin-top:15px;" id="content">
        
        <div class="row">
            
 
            <section id="contenido" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="">
                 <div class="panel panel-primary" style='background-image: url("images/tit2.jpg");background-repeat: repeat-x; box-shadow: 0 0 12px 0 gray;'>
                        <div class="panel-heading"><?php echo @$titlePrincipal;?>
                            <div id="reloj" class="hidden-xs" style="float: right;color:white;font-size: 16px;font-family: calibri;"></div>
                            <div id="hora"  class="hidden-xs"  style="float: right;color:white;font-size: 16px;font-family: calibri;">		  
    			             <script type="text/javascript">
                    			dows = new Array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
                    			months = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                    			now = new Date();
                    			dow = now.getDay();
                    			d = now.getDate();
                    			m = now.getMonth();
                    			h = now.getTime();
                    			y = now.getYear();
                    			document.write(dows[dow]+" "+d+" de "+months[m]+" de ");
                 			</script>
                			<?php echo date('Y'); ?>
                            </div>
                        </div>
                        <div class="panel-body">
                        <?php echo @$contenido;?> 
                        </div>
                 </div>
            </section>
        </div>
        
    </div>

    <footer style="">
        <nav class="navbar navbar-inverse">
            <div style="color: white;text-align: center;font: bold;">
                Desarrollado por <?=DESARROLLO?> <br />
                <?php echo date("Y");?>
            </div>
       </nav>
    </footer>




    
    <!--Ventana Modal Cerrar Seccion -->
    <div id="dialog-cerrar-seccion" title="Realmente desea Salir de la Sesi&oacute;n?" style="display:none;" >
    
        <div style="text-align:right;margin-top:30px;" >
            <hr/>
            <button class="btn btn-inverse" onclick="window.location='?opcion=cerrarSession';">Aceptar</button>&nbsp;&nbsp;
            <button class="btn btn-default" onclick="$('#dialog-cerrar-seccion').dialog('close');">Cancelar</button>
        </div>
    </div>


    <!--<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>-->
    <?php require_once("codigoJs.php");?>
    <script type="text/javascript">
    $('ul.nav li.dropdown').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
        }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
    });
    $(document).ready(function(){
        var window_height = $(window).height();
        var page_height = $('header').height() + $('#content').height();
        var footer_height = $('footer').height();
        var aumento;

        //alert(window_height);
        //alert(getBrowser());
        if (page_height < window_height) {
            //margin_footer = (window_height - (page_height - footer_height))-50;
            if(getBrowser() == "Firefox"){
                aumento = -90;
            }
            else{
                aumento = 0;
            }
            margin_footer = window_height - page_height - footer_height -  aumento;
            //alert(margin_footer);
            if(margin_footer<0){
                margin_footer = 20;
            }
              
            $('footer').css('margin-top', (margin_footer));
        }
        
        
        
        <?php
        if(isset($_REQUEST['idcompra'])){
         
          ?> 
        $('#modalDetalleCompra').modal();  
        <?php
        }
        ?>
        <?php
        if(isset($_REQUEST['idventa'])){
         
          ?> 
        $('#modalDetalleVenta').modal();  
        <?php
        }
        ?>
        
        
    });
    </script>
</body>
</html>