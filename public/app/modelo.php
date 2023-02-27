<?php

/**
 * @author 
 * @copyright 2015
 */

extract($_REQUEST);


switch(@trim($_REQUEST['opcion'])){
    
    
    case 'cambiar-clave':
            
            $titlePrincipal     = 'Cambiar Clave';
            $contenido          = cargarPaginaCase('cambio-clave.php');
            $opcionMenuActive   = 1;

            if(isset($_POST['updatePassword']))
            {
                $validate->validUpdatePassword();
            }
            
        

    break;
    
    
    case 'backup':
        
        //$titlePrincipal     = 'Backup <i class="icon-chevron-right white" style="margin-top:10px;"></i> Copia de Seguridad';
        //$contenido          = "<h3>Se esta realizando la copia de seguridad de la base de datos.</h3>";
        //$opcionMenuActive   = 5;
        backup_tables();
            
    break;    
    
    
    case 'login':
        
        if(!$validate->checkLogin()){
            $validate->login();    
        }
        
    break;
    
    case 'cerrarSession':
        
        $validate->cerrarSession();
        
    break;
    
    default:
        //$contenido = '<img src="'.URL_ADMINISTRACION.'images/logo-web.png" width="200px"/><h3 style="background-color:'.COLOR_TITLE.'">Bienvenido(a). '.htmlentities($_SESSION['name']).'</h3>';
        @$contenido = '<h3 style="background-color:'.COLOR_TITLE.'" class="title-datos">Bienvenido(a). '.htmlentities($_SESSION['name']).'</h3>';
        @$titlePrincipal = 'Contenido';
    break;    
    
    
    case 'registro-punto-venta':
                /**Si no es el administrador, Redireccionar.*****/
                //siNoEsAdmin();
                $titlePrincipal     = 'Punto de Venta<i class="glyphicon glyphicon-chevron-right" style="margin-top:10px;"></i> Registro';
                $contenido          = cargarPaginaCase('registro-punto-venta.php');
                $opcionMenuActive   = 3;
                if(isset($_POST['formRegistroPuntoVenta']))
                {
                    $validate->validFormRegistroPuntoVenta();
                }
                break;
       
       
       case 'registro-areas-admin':
                /**Si no es el administrador, Redireccionar.*****/
                //siNoEsAdmin();
                $titlePrincipal     = 'Punto de Venta<i class="glyphicon glyphicon-chevron-right" style="margin-top:10px;"></i> Registro';
                $contenido          = cargarPaginaCase('registro-areas-admin.php');
                $opcionMenuActive   = 3;
                if(isset($_POST['formRegistroAreaAdmin']))
                {
                    $validate->validFormRegistroAreaAdmin();
                }
                break;
                         
       case 'registro-ingreso-articulo':
                /**Si no es el administrador, Redireccionar.*****/
                //siNoEsAdmin();
                $titlePrincipal     = 'Ingreso de Articulos<i class="glyphicon glyphicon-chevron-right" style="margin-top:10px;"></i> Registro sin Compra';
                $contenido          = cargarPaginaCase('registro-ingreso-articulo.php');
                $opcionMenuActive   = 3;
                if(isset($_POST['formRegistroArticuloSinCompra']))
                {
                    $validate->validFormRegistroArticuloSinCompra();
                }
                break;
                
       case 'listar-articulos-general':
                /**Si no es el administrador, Redireccionar.*****/
                //siNoEsAdmin();
                $titlePrincipal     = 'Ingreso de Articulos<i class="glyphicon glyphicon-chevron-right" style="margin-top:10px;"></i> Listado de Articulos';
                $contenido          = cargarPaginaCase('listar-articulos-general.php');
                $opcionMenuActive   = 3;
                if(isset($_POST['formRegistroArticuloSinCompra']))
                {
                    $validate->validFormRegistroArticuloSinCompra();
                }
                break;
               
                
  	 case 'registro-detalle_compra':
                /**Si no es el administrador, Redireccionar.*****/
                //siNoEsAdmin();
                $titlePrincipal     = 'Compra <i class="glyphicon glyphicon-chevron-right" style="margin-top:10px;"></i> Registro';
                $contenido          = cargarPaginaCase('registro-detalle_compra.php');
                $opcionMenuActive   = 1;
                if(isset($_POST['formRegistroDetalle_compra']))
                {
                    $validate->validFormRegistroDetalle_compra();
                }
                break;
    case 'registro-articulo-sin-compra':
                /**Si no es el administrador, Redireccionar.*****/
                //siNoEsAdmin();
                $titlePrincipal     = '<i class="glyphicon glyphicon-chevron-right" style="margin-top:10px;"></i> Registro Articulo sin Compra';
                $contenido          = cargarPaginaCase('registro-articulo-sin-compra.php');
                $opcionMenuActive   = 1;
                if(isset($_POST['formRegistroArticuloSinCompra']))
                {
                    $validate->validFormRegistroArticuloSinCompra();
                }
                break;
                
     case 'registro-articulos-punto-venta':
              $titlePrincipal     = 'Punto de Venta<i class="glyphicon glyphicon-chevron-right" style="margin-top:10px;"></i> Registro Articulo';
              $contenido          = cargarPaginaCase('registro-articulos-punto-venta.php');
              $opcionMenuActive   = 1;
                if(isset($_POST['formRegistroArticuloSinCompra']))
                {
                    $validate->validFormRegistroArticuloSinCompra();
                }   
        
     break;          
    
  	 case 'registro-producto':
                /**Si no es el administrador, Redireccionar.*****/
                //siNoEsAdmin();
                $titlePrincipal     = 'Articulos <i class="glyphicon glyphicon-chevron-right" style="margin-top:10px;"></i> Registro';
                $contenido          = cargarPaginaCase('registro-producto.php');
                $opcionMenuActive   = 0;
                if(isset($_POST['formRegistroProducto']))
                {
                    $validate->validFormRegistroProducto();
                }
                break;
    
  	 case 'registro-proveedores':
                /**Si no es el administrador, Redireccionar.*****/
                //siNoEsAdmin();
                $titlePrincipal     = 'Proveedores <i class="glyphicon glyphicon-chevron-right" style="margin-top:10px;"></i> Registro';
                $contenido          = cargarPaginaCase('registro-proveedores.php');
                $opcionMenuActive   = 1;
                if(isset($_POST['formRegistroProveedores']))
                {
                    $validate->validFormRegistroProveedores();
                }
                break;
     case 'listar-compras':
                /**Si no es el administrador, Redireccionar.*****/
                //siNoEsAdmin();
                $titlePrincipal     = 'Compra<i class="glyphicon glyphicon-chevron-right" style="margin-top:10px;"></i> Listar';
                $contenido          = cargarPaginaCase('listar-compras.php');
                $opcionMenuActive   = 1;
                
     break;
     
                
    case 'historial-compra':
                /**Si no es el administrador, Redireccionar.*****/
                //siNoEsAdmin();
                $titlePrincipal     = 'Compra<i class="glyphicon glyphicon-chevron-right" style="margin-top:10px;"></i>Historial';
                $contenido          = cargarPaginaCase('historial-compra.php');
                $opcionMenuActive   = 6;
               
    break;
                
    
    case 'inventario':
                /**Si no es el administrador, Redireccionar.*****/
                //siNoEsAdmin();
                $titlePrincipal     = 'Inventario<i class="glyphicon glyphicon-chevron-right" style="margin-top:10px;"></i> Listar';
                $contenido          = cargarPaginaCase('inventario.php');
                $opcionMenuActive   = 4;
               
    break;
    
    case 'inventario-sur':
                /**Si no es el administrador, Redireccionar.*****/
                //siNoEsAdmin();
                $titlePrincipal     = 'Inventario<i class="glyphicon glyphicon-chevron-right" style="margin-top:10px;"></i> Zona Sur';
                $contenido          = cargarPaginaCase('inventario-sur.php');
                $opcionMenuActive   = 4;
               
    break;
    
    case 'inventario-centro':
                /**Si no es el administrador, Redireccionar.*****/
                //siNoEsAdmin();
                $titlePrincipal     = 'Inventario<i class="glyphicon glyphicon-chevron-right" style="margin-top:10px;"></i> Zona Centro';
                $contenido          = cargarPaginaCase('inventario-centro.php');
                $opcionMenuActive   = 4;
               
    break;
    
    case 'inventario-norte':
                /**Si no es el administrador, Redireccionar.*****/
                //siNoEsAdmin();
                $titlePrincipal     = 'Inventario<i class="glyphicon glyphicon-chevron-right" style="margin-top:10px;"></i> Zona Norte';
                $contenido          = cargarPaginaCase('inventario-norte.php');
                $opcionMenuActive   = 4;
               
    break;
                
  	 case 'registro-tipo_usuario':
                /**Si no es el administrador, Redireccionar.*****/
                //siNoEsAdmin();
                $titlePrincipal     = 'tipo_usuario<i class="glyphicon glyphicon-chevron-right" style="margin-top:10px;"></i> Registro';
                $contenido          = cargarPaginaCase('registro-tipo_usuario.php');
                $opcionMenuActive   = 6;
                if(isset($_POST['formRegistroTipo_usuario']))
                {
                    $validate->validFormRegistroTipo_usuario();
                }
                break;
  	 case 'registro-usuario':
                /**Si no es el administrador, Redireccionar.*****/
                //siNoEsAdmin();
                $titlePrincipal     = 'usuario<i class="glyphicon glyphicon-chevron-right" style="margin-top:10px;"></i> Registro';
                $contenido          = cargarPaginaCase('registro-usuario.php');
                $opcionMenuActive   = 7;
                if(isset($_POST['formRegistroUsuario']))
                {
                    $validate->validFormRegistroUsuario();
                }
                break;
  	
      
    
  	 case 'registro-marca_producto':
                /**Si no es el administrador, Redireccionar.*****/
                //siNoEsAdmin();
            
                $titlePrincipal     = 'Marca Articulo<i class="glyphicon glyphicon-chevron-right" style="margin-top:10px;"></i> Registro';
                $contenido          = cargarPaginaCase('registro-marca_producto.php');
                $opcionMenuActive   = 0;
                if(isset($_POST['formRegistroMarca_producto']))
                {
                    $validate->validFormRegistroMarca_producto();
                }
            break;
}?>