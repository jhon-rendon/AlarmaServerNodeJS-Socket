<!--<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>-->
            <li class="dropdown">
                <a data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">Registros <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li ><a href="?opcion=registro-producto" class="menuOpcion">Articulos</a></li>
                        <li><a href="?opcion=registro-marca_producto" class="menuOpcion">Marcas</a></li>
                        <li><a href="?opcion=registro-proveedores" class="menuOpcion">Proveedores</a></li>
                       
                        
                    </ul>
            </li>
            
         
            
            <li class="dropdown">
                <a data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">Ingreso de Articulos <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="?opcion=registro-detalle_compra" class="menuOpcion">Compra</a></li>
                        <li><a href="?opcion=registro-ingreso-articulo" class="menuOpcion">Articulos Sin Compra</a></li>
                        <li><a href="?opcion=listar-articulos-general" class="menuOpcion">Listar de Articulos en General</a></li>
                        
                    </ul>
            </li>
            
            <li class="dropdown">
                <a data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">Compras <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <!--<li><a href="?opcion=registro-detalle_compra" class="menuOpcion">Registrar</a></li>-->
                        <li><a href="?opcion=listar-compras" class="menuOpcion">Listar</a></li>
                        <li><a href="?opcion=historial-compra" class="menuOpcion">Historial</a></li>
                    </ul>
            </li>
            
            <li class="dropdown" style="display: none;">
                <a data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">Ventas <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="?opcion=registro-detalle-venta" class="menuOpcion">Registrar</a></li>
                        <li><a href="?opcion=listar-ventas">Listar</a></li>
                    </ul>
            </li>
            
            <li class="dropdown">
                <a data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">Puntos de Venta <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="?opcion=registro-punto-venta" class="menuOpcion">Registar -listar</a></li>
                        
                    </ul>
            </li>
            
            <li class="dropdown">
                <a data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">Administracion <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="?opcion=registro-areas-admin" class="menuOpcion">Registar -listar</a></li>
                        
                    </ul>
            </li>
            
            <li class="dropdown">
                <a data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">Inventario Zonas<b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="?opcion=inventario" class="menuOpcion">Almacen</a></li>
                        <li><a href="?opcion=inventario-sur" class="menuOpcion">Zona Sur</a></li>
                        <li><a href="?opcion=inventario-norte" class="menuOpcion">Zona Norte</a></li>
                        <li><a href="?opcion=inventario-centro" class="menuOpcion">Zona Centro</a></li>
                        <li><a href="?opcion=#" class="menuOpcion">Zona Dagua</a></li>
                        <li><a href="?opcion=#" class="menuOpcion">Zona Juanchacho</a></li>
                     
                    </ul>
            </li>
            <li class="dropdown">
                <a data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">Pedidos <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="?opcion=#" class="menuOpcion">Registar -listar</a></li>
                        
                    </ul>
            </li>
            
            <li class="dropdown">
                <a data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">Articulos de Baja <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="?opcion=#" class="menuOpcion">Registar -listar</a></li>
                        
                    </ul>
            </li>
            
            <!--<li class="dropdown">
                <a data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">Historial Compras <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <?php
                      $getAnioHistorialCompra = $database->getAniosHistorialCompra();

                      if(count($getAnioHistorialCompra)>0){
                        
                        $contador = 0;
                        
                        foreach($getAnioHistorialCompra as $historial){
                            
                            $mesArray   = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");  
                            $anio       = $historial['anio_fechaCompra'];
                            
                            if($anio == @$_REQUEST['anio']){
                              /**Activando el menu del accordion del año seleccionado ***/
                              if(@$_REQUEST['opcion'] == 'historial-compra'){
                                $activeMenuJs = '$(".accordion").accordion({ heightStyle: "content",active:'.$contador.'});';
                              }
                            }
                            
                            $contador++;
                            echo '<li class="dropdown">';
                            echo '<a  data-toggle="dropdown" class="dropdown-toggle" href="#">'.$anio.' <b class="caret"></b></a>';
                           // echo "<li class='dropdown'>".$anio."";
                            
                            /**Obtenemos los meses relacionados con el año ***********/
                            $meses      = $database->getMesesHistorialCompraByAnio($anio);
                            
                            if(count($meses)>0){
                                echo '<ul role="menu" class="dropdown-menu">';
                                
                                foreach($meses as $mes){
                                    if(@$_REQUEST['mes'] == $mes['mes_compra'] AND @$_REQUEST['anio'] == $anio){
                                        if(@$_REQUEST['opcion'] == 'historial-compra'){
                                            $active = 'itemMenuActive';
                                        }
                                         else{
                                        $active = '';
                                    }
                                    
                                    }
                                    else{
                                        $active = '';
                                    }
                                    
                                    echo '<li class="'.$active.'"><a href="?opcion=historial-compra&anio='.$anio.'&mes='.$mes['mes_compra'].'">'.$mesArray[($mes['mes_compra']-1)].'</a></li>';
                                        
                                } 
                                echo '</ul></li>';
                            }
                        
                        }
                      }
                     ?>
                        
                       
                    </ul>
            </li>
            
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">Historial Ventas <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="#">Proveedores</a></li>
                        <li><a href="#">Registrar</a></li>
                        <li><a href="#">Listar</a></li>
                    </ul>
            </li>-->
            
            <!--<li class="visible-lg" style="">
                <div id="hora" style="color:white;font-size: 16px;font-family: calibri;margin-top:9px;">		  
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
            </li>
            <li class="visible-lg" ><div id="reloj"  style="color:white;font-size: 16px;font-family: calibri;margin-left:20px;margin-top:9px;"></div></li>
            -->
            <!--<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>-->
            
            
            <!--<li style="margin-left:10px;"><button  class="btn btn-info"    style="margin-top:7px;" onclick="window.location='<?=URL_ADMINISTRACION.'?opcion=cambiar-clave'?>';">Cambiar Clave</button></li>-->
            <!--<li style="margin-left:10px;"><button  class="btn btn-success" style="margin-top:7px;" onclick="window.location='<?=URL_ADMINISTRACION.'?opcion=backup'?>';">Backup</button></li>-->
            <div class="btn-group" style="margin-left:10px;margin-top:7px;">
              <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;<?php echo htmlentities($_SESSION['name'])?></button>
              <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu">
                <li><a href="#" onclick="$('#dialog-cerrar-seccion').dialog({width:329});return false;">Salir</a></li>
                <!--<li role="separator" class="divider"></li>-->
                <li onclick="window.location='<?=URL_ADMINISTRACION.'?opcion=cambiar-clave'?>';"><a href="#">Cambiar Clave</a></li>
                <li onclick="window.location='<?=URL_ADMINISTRACION.'?opcion=backup'?>';"><a href="#">Generar Backup</a></li>
                
              </ul>
            </div>
            <!--<li style="margin-left:10px;"><button   class="btn btn-danger" style="margin-top:7px;" onclick="$('#dialog-cerrar-seccion').dialog({width:329});return false;">SALIR</button></li>-->
            <!--<li style="margin-top:7px;margin-left:10px;"><?php echo htmlentities($_SESSION['name'])?></li>-->