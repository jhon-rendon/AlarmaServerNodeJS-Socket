(function () {
  "use strict";

  //===== Prealoder

  window.onload = function () {
    window.setTimeout(fadeout, 200);
  };

  function fadeout() {
	  document.querySelector(".preloader").style.opacity = "0";
    document.querySelector(".preloader").style.display = "none";
	
  }

})();


  let pds             = [];
  let countListadoPds = [];
  let socket          = null;
  let alertaSonora    = null;
  let fecha                 = document.getElementById("fecha");
  let listadoPuntosCantidad = document.getElementById("listado");
  let listadoNotificaciones = document.getElementById("chat-content");
  let load                  = document.getElementById("load");
 
  
  
  function socketInit() {
    
    console.log("Conectado al Socket ");
    //socket = io.connect("http://" +process.env.IPSERVERSOCKET +":" +process.env.PUERTOSERVERSOCKET,{ forceNew: true });//Conectar al Servidor de Socket
    socket = io.connect("http://localhost:9758",{ forceNew: true });//Conectar al Servidor de Socket
  }

  function socketFechaActual(){
    
    socket.emit("fecha-actual"); //Solicitar La Fecha Actual al servidor

    //Obtener La fecha del servidor
    socket.on("fecha-actual", (fechaActual) => {
      
      console.log("Obteniendo Fecha actual del servidor" + fechaActual);
      fecha.innerHTML = `${fechaActual}`; //Cambiando la fecha del campo html fecha
         
    });
  }

  function socketAlertasHoy(){
  
    load.style.display = "block";
    socket.emit("alertas-hoy");//Solicitar las Todas las Alertas del dia Actual

    //Obtener Todas las alertas del dia actual
    socket.on("alertas-hoy", (dataAlerta) => {
    
      //Si la variable pds contiene información, se procede almacenar la data del dia actual y visualizarla en pantalla
      if (pds.length > 0) { 
        return;
      }
      //Crear el primer registro con listado de los puntos de venta y las cantidad de alerta realizadas ( inicialmente 1) 
      /*countListadoPds.push({
        pdv: dataAlerta[0].pdv,
        count: 1,
      });*/

      for (let i = 0; i < dataAlerta.length; i++) {//Recorrer la Data Obtenida del servidor
        let existe = false;
        for (let j = 0; j < countListadoPds.length; j++) { //Recorrer Listado de punto de venta agrupados con cantidad de alertas
              
              //Si el punto de venta existe, entonces se procede agrupar y sumar en las cantidades de alertas, con la propiedad count
              if ( countListadoPds[j].pdv.trim() == dataAlerta[i].pdv.trim() ) {
                  countListadoPds[j].count = countListadoPds[j].count + 1;
                  existe = true;
                  break;
              }//Fin if
          
         }//Fin for
        
        //Si la variable (existe) tiene valor falso, entonces se agrega un nuero registro al vector  countListadoPds
        if (!existe) {
          countListadoPds.push({
            pdv: dataAlerta[i].pdv,
            count: 1,
          });
        }
     }//Fin for Prinicipal
    
      //Almacenar en la variable pds la data de la consulta con las alertas
      pds = dataAlerta;
      let nuevoElemento = "";
      for (let i = 0; i < countListadoPds.length; i++ ) {
          
          //Crear en html el listado de los puntos de venta agrupados por cantidad
          listadoPuntosCantidad.innerHTML += `
          <li class="list-group-item d-flex justify-content-between align-items-center" > ${countListadoPds[i]["pdv"]}
          <span class="badge bg-primary rounded-pill" id="${countListadoPds[i]["pdv"]}">${countListadoPds[i]["count"]}</span></li>`;
      }//fin for

      for (let i = 0; i < pds.length; i++ ) {
        
        //Crear en HTML el listado de alertas detalladas por hora
        nuevoElemento = `<div class="alert alert-light" style="padding:3px;margin:10px;">
                             <div class="media-body"><p><img class="avatar" src="assets/img/logo/2278534.png"/>
                            <span class="meta">${pds[i]["hora"]}</span> Alerta en el punto de venta <strong> ${pds[i]["pdv"]}</stron></p></div></div>`;       
      
        listadoNotificaciones.innerHTML += `${nuevoElemento}`;
      }//fin for
      bajarScroll(); //Bajar Scroll Al final
      load.style.display = "none"; // Ocultar Loading

  });//Fin Evento Socket Alertas-hoy

  
  //Evento de Socket que captura los puntos de venta que han presionado el botón de pánico en tiempo real
  socket.on("mensajeAlarma", (dataAlerta) => {
        
     let existe = false;
     let newCount =  0;
    
     //Si la fecha del evento es diferente la fecha del campo Span fecha, entonces se procede a cambiar la fecha y vaciar el contenido de las alertas
    if( dataAlerta.fecha != fecha.innerText ){
       limpiarCampos();
       fecha.innerHTML = ''+dataAlerta.fecha+'';
    }//Fin if
    
    if( countListadoPds.length > 0 ){ 
      for (let i = 0; i < countListadoPds.length; i++) {//Recorrer Listado de punto de venta agrupados con cantidad de alertas
        
        //Si el punto de venta existe, entonces se procede agrupar y sumar en las cantidades de alertas, con la propiedad count
        if (countListadoPds[i]["pdv"].trim() == dataAlerta.pdv.trim() ) {
            countListadoPds[i].count =   countListadoPds[i].count +1;
            newCount                 =  countListadoPds[i].count;
            existe = true;
            break;
         }//fin if
      }//Fin for
    }//fin if
    
    //Si la variable (existe) tiene valor falso, entonces se agrega un nuero registro al vector  countListadoPds
    if (!existe) {
        countListadoPds.push({
          pdv: dataAlerta.pdv.trim(),
          count: 1,
        });

        listadoPuntosCantidad.innerHTML += `<li class="list-group-item d-flex justify-content-between align-items-center" >${dataAlerta.pdv}
                                                       <span class="badge bg-primary rounded-pill" id="${dataAlerta.pdv}">1</span></li>`;
    }//fin if 
    else {
        document.getElementById(`${dataAlerta.pdv}`).innerHTML = `${newCount}`;
    }//FIn else

    
    let nuevoElemento = `<div class="alert alert-light" style="padding:3px;margin:10px;">
                         <div class="media-body"><p><img class="avatar" src="assets/img/logo/2278534.png"/>
                        <span class="meta">${dataAlerta.hora}</span> Alerta en el punto de venta <strong> ${dataAlerta.pdv}</stron></p></div></div>`;
    
    bajarScroll(nuevoElemento);
    playOnStopAlerta(); //Reproducir alerta

    });//Fin Evento Socket mensajeAlarma

    

  }//Fin Funcion socketAlertasHoy


function socketAlertasRangoFecha(){
     
    let inputFecha  = document.getElementById("input-fecha");
    let msg         = document.getElementById("msg");
    let btnConsulta = document.getElementById("consultar");
    let btnExportar = document.getElementById("exportar");
    load.style.display = "block";
    msg.style.display = "none";

    console.log('socketAlertasRangoFecha');
   
    if( inputFecha.value == ""){
      msg.innerText = "* Debe seleccionar la fecha";
      msg.style.display = "block";
      load.style.display = "none";
      return;
    }

    btnConsulta.disabled = true; //Deshabilitar Boton 
    btnExportar.style.display = "none"; // Ocultar Boton Exportar 
    limpiarCampos();//Limpiar Campos
    
     
    let arrFecha = inputFecha.value.split('-');
    let anio     = arrFecha[0];
    let mes      = arrFecha[1];
    let dia      = arrFecha[2];
    
    let fechaDiaMesAnio = dia+"/"+mes+"/"+anio;

    console.log( fechaDiaMesAnio );

    socket.emit("alertas-rango-fechas",{
      fechaInicial: fechaDiaMesAnio,
      fechaFinal: fechaDiaMesAnio
    });

     //Obtener Todas las alertas del dia actual
     socket.on("alertas-rango-fechas", (dataAlerta) => {
     
      if( !dataAlerta || dataAlerta.length == 0){
        load.style.display = "none";
        msg.innerText = "No existen registros";
        msg.style.display = "block";
        btnConsulta.disabled = false; //Habilitar Boton 
        return;
      }
      
     
     
 
      //Crear el primer registro con listado de los puntos de venta y las cantidad de alerta realizadas ( inicialmente 1) 
      /*countListadoPds.push({
        pdv: dataAlerta[0].pdv,
        count: 1,
      });*/

      for (let i = 0; i < dataAlerta.length; i++) {//Recorrer la Data Obtenida del servidor
        let existe = false;
        for (let j = 0; j < countListadoPds.length; j++) { //Recorrer Listado de punto de venta agrupados con cantidad de alertas
              
              //Si el punto de venta existe, entonces se procede agrupar y sumar en las cantidades de alertas, con la propiedad count
              if ( countListadoPds[j].pdv.trim() == dataAlerta[i].pdv.trim() ) {
                  countListadoPds[j].count = countListadoPds[j].count + 1;
                  existe = true;
                  break;
              }//Fin if
          
         }//Fin for
        
        //Si la variable (existe) tiene valor falso, entonces se agrega un nuero registro al vector  countListadoPds
        if (!existe) {
          countListadoPds.push({
            pdv: dataAlerta[i].pdv,
            count: 1,
          });
        }
     }//Fin for Prinicipal
    
      //Almacenar en la variable pds la data de la consulta con las alertas
      pds = dataAlerta;

      for (let i = 0; i < countListadoPds.length; i++ ) {
          
          //Crear en html el listado de los puntos de venta agrupados por cantidad
          document.getElementById("listado").innerHTML += `
          <li class="list-group-item d-flex justify-content-between align-items-center" > ${countListadoPds[i]["pdv"]}
          <span class="badge bg-primary rounded-pill" id="${countListadoPds[i]["pdv"]}">${countListadoPds[i]["count"]}</span></li>`;
      }//fin for

      for (let i = 0; i < pds.length; i++ ) {
        
        //Crear en HTML el listado de alertas detalladas por hora
        let nuevoElemento = `<div class="alert alert-light" style="padding:3px;margin:10px;">
                             <div class="media-body"><p><img class="avatar" src="assets/img/logo/2278534.png"/>
                            <span class="meta">${pds[i]["hora"]}</span> Alerta en el punto de venta <strong> ${pds[i]["pdv"]}</stron></p></div></div>`;
        listadoNotificaciones.innerHTML += `${nuevoElemento}`;
      }//fin for

      //bajarScroll(); //Bajar Scroll Al final
      load.style.display = "none"; //Ocultar el loading
      fecha.innerHTML = `${fechaDiaMesAnio}`; //Cambiando la fecha del campo html fecha
      btnConsulta.disabled = false; //Habilitar Boton 
      btnExportar.style.display = "block"; // Habilitar Boton Exportar 
  });//Fin Evento Socket Alertas Por fecha

 }//Fin funcion



 function limpiarCampos(){
       
  countListadoPds = [];
  pds             = [];
  fecha.innerHTML = "";
  listadoPuntosCantidad.innerHTML = "";
  listadoNotificaciones.innerHTML = "";
     
 }

 function bajarScroll( nuevoElemento = null ){
  
  if( nuevoElemento ){
    listadoNotificaciones.innerHTML += `${nuevoElemento}`;
  }
  
  listadoNotificaciones.scrollTop = listadoNotificaciones.scrollHeight;
 }



 function exportarExcel(  ) {

    if( pds.length > 0 ){ 

      console.log( 'Exportando a Excel' );

      let   fechaReporte = fecha.innerText.replace('/','-');
      fechaReporte       = fechaReporte.replace('/','-');
      let filename       = 'Reporte_Alertas_'+fechaReporte+'.xlsx';

       var ws = XLSX.utils.json_to_sheet(pds);
       var wb = XLSX.utils.book_new();
       XLSX.utils.book_append_sheet(wb, ws, "Alertas");
       XLSX.writeFile(wb,filename);
    }
    else{
      let msg = document.getElementById("msg");
      msg.innerText("Error al exportar");
      msg.style.display = "block";
    }

 } 


  function playOnStopAlerta(){

    
    console.log(alertaSonora);

    if( alertaSonora && alertaSonora._state =="loaded"){
      alertaSonora.stop();
      console.log('Deteniendo Reproducción alarma');
    }
    
    alertaSonora = new Howl({
        src: ['../alarma.wav']
    });
    console.log('Reproduciendo alarma');
    alertaSonora.play();
    
    
   
  
    
  
  }

  function socketAlertaPlay(){

    socket.on("mensajeAlarma", (dataAlerta) => {
      playOnStopAlerta();
    });
  }

 


 
