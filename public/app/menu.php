        <?php
                
                //$getUsuario = $database-> getUserInfo($_SESSION['username']);
                 
                 /**Si es el administrador *****/  
                if(isset($_SESSION['id_rol']) and $_SESSION['id_rol']==1){
                    $ocultar = "";
                   /**Si no es el administrador *****/
                  }else if(isset($_SESSION['id_rol'])!=1 || !$_SESSION['is_admin'] || $_SESSION['is_admin']!=1){
                   //$ocultar = "style='display:none;'";
                    
                 }
                 $ocultar="";
        ?>
            <div id="titulo-menu"></div>
            <div id="accordion">
                
                <!--<h3 <?php echo $ocultar;?>>Backup</h3>
                <div <?php echo $ocultar;?>>
                   <ul  <?php echo $ocultar;?>>
                    <li <?php echo $ocultar;?>><a href="?opcion=backup">Copia de Seguridad de la base de datos</a></li>
                    
                   </ul>-->
                        
                        <h3 <?php echo $ocultar;?>>Articulo</h3>
                            <div <?php echo $ocultar;?>>
                               <ul  <?php echo $ocultar;?>>
                                <li <?php echo $ocultar;?>><a href="?opcion=registro-producto" class="menuOpcion">Registrar - Listar</a></li>
                                <li <?php echo $ocultar;?>><a href="?opcion=registro-marca_producto" class="menuOpcion">Marcas</a></li>
                                
                               </ul>
                               
                            </div>
                            
                             <h3 <?php echo $ocultar;?>>Ingreso de Articulos</h3>
                            <div <?php echo $ocultar;?>>
                               <ul  <?php echo $ocultar;?>>
                                <li <?php echo $ocultar;?>><a href="?opcion=registro-ingreso-articulo" class="menuOpcion">Articulos Sin Compra</a></li>
                                
                               </ul>
                               
                            </div>
                       
                        
                        <!--<h3 <?php echo $ocultar;?>>Compra</h3>
                            <div <?php echo $ocultar;?>>
                               <ul  <?php echo $ocultar;?>>
                                <li <?php echo $ocultar;?>><a href="?opcion=registro-compra" class="menuOpcion">Registrar - Listar</a></li>
                               </ul>
                               
                            </div>-->
                        <h3 <?php echo $ocultar;?>>Compra</h3>
                            <div <?php echo $ocultar;?>>
                               <ul  <?php echo $ocultar;?>>
                               <li <?php echo $ocultar;?>><a href="?opcion=registro-proveedores" class="menuOpcion">Proveedores</a></li>
                                <li <?php echo $ocultar;?>><a href="?opcion=registro-detalle_compra" class="menuOpcion">Registrar </a></li>
                                <li <?php echo $ocultar;?>><a href="?opcion=listar-compras" class="menuOpcion">Listar</a></li>
                                <!--<li <?php echo $ocultar;?>><a href="?opcion=registro-articulo-sin-compra" class="menuOpcion">Registar Articulo sin Compra</a></li>-->
                               </ul>
                               
                            </div>
                        
                         <h3 <?php echo $ocultar;?> style="display: none;">Venta</h3>
                            <div <?php echo $ocultar;?>>
                               <ul  <?php echo $ocultar;?>>
                                <li <?php echo $ocultar;?>><a href="?opcion=registro-detalle_venta" class="menuOpcion">Registrar - Listar</a></li>
                                <li <?php echo $ocultar;?>><a href="?opcion=listar-ventas" class="menuOpcion">Listar</a></li>
                               </ul>
                               
                            </div>
                            
                        <h3 <?php echo $ocultar;?>>Punto de Venta</h3>
                            <div <?php echo $ocultar;?>>
                               <ul  <?php echo $ocultar;?>>
                                <li <?php echo $ocultar;?>><a href="?opcion=registro-punto-venta" class="menuOpcion">Registrar - Listar</a></li>
                                <li <?php echo $ocultar;?>><a href="?opcion=registro-articulos-punto-venta" class="menuOpcion">Asignar Articulo</a></li>
                                
                               </ul>
                               
                            </div>
                        <!--<h3 <?php echo $ocultar;?>>Detalle_venta</h3>
                            <div <?php echo $ocultar;?>>
                               <ul  <?php echo $ocultar;?>>
                                <li <?php echo $ocultar;?>><a href="?opcion=registro-detalle_venta" class="menuOpcion">Registrar - Listar</a></li>
                               </ul>
                               
                            </div>-->
                            <h3 <?php echo $ocultar;?>>Inventario</h3>
                            <div <?php echo $ocultar;?>>
                               <ul  <?php echo $ocultar;?>>
                                <li <?php echo $ocultar;?>><a href="?opcion=inventario" class="menuOpcion">Listar</a></li>
                                <li><a href="?opcion=inventario-sur" class="menuOpcion">Zona Sur</a></li>
                                <li><a href="?opcion=inventario-centro" class="menuOpcion">Zona Centro</a></li>
                                <li><a href="?opcion=inventario-norte" class="menuOpcion">Zona Norte</a></li>
                               </ul>
                               
                            </div>
                            
                            
                <h3 <?php echo $ocultar;?>>Historial Compras</h3>
                <div>
                   
                   <div class='accordion'>
                     
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
                            
                            echo "<h3>".$anio."</h3>";
                            
                            /**Obtenemos los meses relacionados con el año ***********/
                            $meses      = $database->getMesesHistorialCompraByAnio($anio);
                            
                            if(count($meses)>0){
                                echo '<div><ul>';
                                
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
                                echo '</ul></div>';
                            }
                        
                        }
                      }
                     ?>
                 </div>
                </div>
                
                <h3 <?php echo $ocultar;?>>Pedidos</h3>
                            <div <?php echo $ocultar;?>>
                               <ul  <?php echo $ocultar;?>>
                                <li <?php echo $ocultar;?>><a href="#" class="menuOpcion">Registrar - Listar</a></li>
                                <li <?php echo $ocultar;?>><a href="#" class="menuOpcion">Listar</a></li>
                               </ul>
                               
                            </div>
                <h3 <?php echo $ocultar;?>>Articulos Baja</h3>
                            <div <?php echo $ocultar;?>>
                               <ul  <?php echo $ocultar;?>>
                                <li <?php echo $ocultar;?>><a href="#" class="menuOpcion">Registrar - Listar</a></li>
                                <li <?php echo $ocultar;?>><a href="#" class="menuOpcion">Listar</a></li>
                               </ul>
                               
                            </div>
                
                <!--<h3 <?php echo $ocultar;?>>Cotizaciones</h3>
                            <div <?php echo $ocultar;?>>
                               <ul  <?php echo $ocultar;?>>
                                <li <?php echo $ocultar;?>><a href="?opcion=registro-cotizaciones" class="menuOpcion">Registrar - Listar</a></li>
                                <li <?php echo $ocultar;?>><a href="?opcion=listar-cotizaciones" class="menuOpcion">Listar</a></li>
                               </ul>
                               
                            </div>-->
                        <!--<h3 <?php echo $ocultar;?>>Tipo_usuario</h3>
                            <div <?php echo $ocultar;?>>
                               <ul  <?php echo $ocultar;?>>
                                <li <?php echo $ocultar;?>><a href="?opcion=registro-tipo_usuario" class="menuOpcion">Registrar - Listar</a></li>
                               </ul>
                               
                            </div>
                        <h3 <?php echo $ocultar;?>>Usuario</h3>
                            <div <?php echo $ocultar;?>>
                               <ul  <?php echo $ocultar;?>>
                                <li <?php echo $ocultar;?>><a href="?opcion=registro-usuario" class="menuOpcion">Registrar - Listar</a></li>
                               </ul>
                               
                            </div>-->
                       

                   
</div>