
/**
 * funciones.js
 * 
 * Created by: Jhon Rendon
 * Last Updated: Febrero 24, 2013
 */
 
function openVentanaModal(id)
{
    $('#'+id).lightbox_me({

		centered: true,
        closeEsc:true 
    });
}

function closeVentanaModal(id)
{
    $("#"+id).trigger('close');
}


function placeHolder()
{
    /***Efecto de placeholder con jquery ****/
    $('input[placeholder], textarea[placeholder]').placeholder();

}

function convierteMinuscula(txt)
{
    return txt.toLowerCase();
}

function convierteMayuscula(txt)
{
    return txt.toUpperCase();
}

function muestraReloj()
{
    // Compruebo si se puede ejecutar el script en el navegador del usuario
    if (!document.layers && !document.all && !document.getElementById) return;
    // Obtengo la hora actual y la divido en sus partes
    var fechacompleta = new Date();
    var horas    = fechacompleta.getHours();
    var minutos  = fechacompleta.getMinutes();
    var segundos = fechacompleta.getSeconds();
    var mt = "AM";
    // Pongo el formato 12 horas
    if (horas> 12) {
        mt = "PM";
        horas = horas - 12;
    }
    if (horas == 0) horas = 12;
    // Pongo minutos y segundos con dos digitos
    if (minutos <= 9) minutos = "0" + minutos;
    if (segundos <= 9) segundos = "0" + segundos;
    // En la variable 'cadenareloj' puedes cambiar los colores y el tipo de fuente
    //cadenareloj = "<font size='-1' face='verdana'>" + horas + ":" + minutos + ":" + segundos + " " + mt + "</font>";
    cadenareloj =horas + ":" + minutos + ":" + segundos + " " + mt;
    // Escribo el reloj de una manera u otra, segun el navegador del usuario
    if (document.layers) {
        document.layers.spanreloj.document.write(cadenareloj);
        document.layers.spanreloj.document.close();
    }
    else if (document.all) spanreloj.innerHTML = cadenareloj;
    else if (document.getElementById) document.getElementById("reloj").innerHTML = cadenareloj;
    // Ejecuto la funcion con un intervalo de un segundo
    setTimeout("muestraReloj()", 1000);
    
    /***Modo de implementar
    <body onLoad="muestraReloj()">
    <div id="spanreloj"></div>
    *****/
}

function getBrowser()
{
    
    /*if (navigator.userAgent.indexOf("MSIE")>0){ 
        return "IE";
    }
    else{ 
        return "Otro";
    }*/ 
                   
  var navegador = navigator.userAgent;
  var browser;
  if (navigator.userAgent.indexOf('MSIE') !=-1) {
    //document.write('está usando Internet Explorer ...');
    return "Explorer";
  } else if (navigator.userAgent.indexOf('Firefox') !=-1) {
    //document.write('está usando Firefox ...');
    return "Firefox";
  } else if (navigator.userAgent.indexOf('Chrome') !=-1) {
    //document.write('está usando Google Chrome ...');
    return "Chrome";
  } else if (navigator.userAgent.indexOf('Opera') !=-1) {
    //document.write('está usando Opera ...');
    return "Opera";
  } else {
    //document.write('está usando un navegador no identificado ...');
    return "Otro";
  }
   
}

/*function autoCompletar(campo,url,propiedades)
{
    if(propiedades!=NULL && isArray(propiedades) && propiedad.length>0){
        
        for(i=0;i<propiedades.length;i++)
        {
            datos+=propiedades[i]+',';
        }
    }
    else
    {
        datos = "";
    }
    $("#"+campo).autocomplete({
       
       //minLength: 3,
       source:url
       //delay: 1000,
       //select:select,
       //focus:foco
       //datos
      });
}*/

// ocurre cada vez que se marca un elemento de la lista  
/*function foco(event, ui)  
{  
    var valor = ui.item.value;  
    event.preventDefault();  
}*/ 
/**Ocurre cuando se selecciona un item de la lista de autocompletar ****/           
/*function select(event, ui)  
{  
    var id = ui.item.id;
                 

}*/

function ancla(elemento)
{
    $('html,body').animate({scrollTop: '+=' + $(elemento).offset().top + 'px'}, 'fast');
}


function validateForms(){
    
    $.extend(jQuery.validator.messages, {
        required: "* EL Campo Es Requerido(a).",
        remote: "El Registro ya existe.",
        email: "Please enter a valid email address.",
        url: "Please enter a valid URL.",
        date: "Please enter a valid date.",
        dateISO: "Please enter a valid date (ISO).",
        number: "*Debe ingresar un número.",
        digits: "Please enter only digits.",
        creditcard: "Please enter a valid credit card number.",
        equalTo: "Ingresa el mismo valor.",
        accept: "Please enter a value with a valid extension.",
        maxlength: $.validator.format("Please enter no more than {0} characters."),
        minlength: $.validator.format("Please enter at least {0} characters."),
        rangelength: $.validator.format("Please enter a value between {0} and {1} characters long."),
        range: $.validator.format("Please enter a value between {0} and {1}."),
        max: $.validator.format("Please enter a value less than or equal to {0}."),
        min: $.validator.format("Please enter a value greater than or equal to {0}.")
    });
    
    /**Formulario del login ****/
    $('#acceso').validate();
    
    
   /**Registro de Orientador****/
    $('#formRegistroOrientador').validate();
    
    /***Formulario Recepcionista *****/
    $('#formRecepcionista').validate();
    
     /***Formulario Tipo Habitacion *****/
    $('#formTipoHabitacion').validate();
    
     /***Formulario Habitacion *****/
    $('#formHabitacion').validate();
    
    
     /***Formulario Reserva *****/
    $('#form-reserva').validate();
     
     
     
    if($("#id_cliente").length>0){
        id_cliente="&id_cliente="+$("#id_cliente").val();
    }
    else{
        id_cliente='';
    }
    $('#formClienteReserva').validate({
           /*rules: {
           'cliente_nombre': 'required',
           'cliente_apellido': 'required',
           'cliente_cedula': { required: true, number: true },
           'cliente_placa':  'required',
           //'email': { required: true, email: true },
           //'tipo_identidad': 'required',
           //'deportes[]': { required: true, minlength: 1 }
           },
       messages: {
           'cliente_nombre': '*Debe ingresar el nombre',
           'cliente_apellido': '*Debe ingresar el apellido',
           'cliente_cedula': { required: '*Debe ingresar el número de documento de identidad', number: 'Debe ingresar un número' },
           'cliente_placa': { required: '*Debe ingresar la Placa'}
           //'tipo_identidad': 'Debe ingresar el número de documento',
           //'deportes[]': 'Debe seleccionar mínimo un deporte'
       },
       debug: true,
       /*errorElement: 'div',*/
       //errorContainer: $('#errores'),
       
       rules: {
        'select_habit': 'required',
        'cliente_cedula':{
               // required: true,
                remote:
                {   url: 'ajax.php?action=verificarExistenciaCliente'+id_cliente,
                    type: "post",
                    data:
                    {   
                        'cliente_cedula': function()
                        {   
                            
                            return $('#admin_cliente :input[name="cliente_cedula"]').val();
                        }
                      }
                    }
            },
       },
       messages: {
        'select_habit': '*Debe Seleccionar una Habitaci&oacute;n',
        'cliente_cedula':{remote:"El cliente ya existe."},
       },
       submitHandler: function(form){
           //alert('El formulario ha sido validado correctamente!');
           form.submit();
       }
       
       
    
    }); 
    
    
    
    
    
    
    
    
    $("input[name='check_articulo[]']").click(function(e){
        
       if($(this).is(":checked")){
            //alert('checked');
            
            if(parseInt($(this).next().next().attr('value'))<1 || $(this).next().next().attr('value')==""){
                
                 //$(this).next().next().removeAttr('value');
                 $(this).next().next().attr('value','1');
            
            }
            
        }
        
        else{
                //alert('pailas');
                $(this).next().next().removeAttr('value');
            }
        //alert($(this).val());
    });
    
    $("input[name='cantidad_articulo[]']").keyup(function(e){
       
        if(parseInt($(this).val())<1){
           $(this).prev().prev().attr('checked',false);
           //$(this).removeAttr('value'); 
           //alert('<1');
        } 
        
         if(parseInt($(this).val())>0){
           $(this).prev().prev().attr('checked',true); 
           //alert('>0');
        } 
    });
  
}

function validarFormComprarArticuloHuesped(){
    
     cont = 0;
    for (i=0;i<document.formComprarArticuloHuesped.elements.length;i++)
    {
        if(document.formComprarArticuloHuesped.elements[i].type == "checkbox")
        {
          if(document.formComprarArticuloHuesped.elements[i].checked == 1)
          {
            
            cont = cont + 1;
          }
        }
    }   
   
    if (cont>0){
        //if(confirm("desea borrar?")){
            document.formComprarArticuloHuesped.submit();
        //}
       // else{
          //  alert("cancelado");
            //return false;
        //}
    }
    else{
        alert("debe seleccionar uno al menos");
        return false;
    }
       
}

