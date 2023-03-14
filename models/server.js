require("dotenv").config();
const { dbConnection } = require("../database/config");
const growl = require("notify-send");
const nodemailer = require("nodemailer");
const express = require('express');
const cors    = require('cors');
const TelegramBot = require('node-telegram-bot-api');
const  { getPuntoVentaByMAC, insertAlerta,getAlertas }  = require("./bdAlerta");



class Server {
  constructor() {

    this.app  = express();
    this.port = process.env.PUERTOSERVERSOCKET || 3161;

    this.server =  require("http").Server( this.app );
    this.listen();

    //Socket
    this.io = require("socket.io")( this.server );
    this.conexionSocket();

    //Conexión a la base de datos
    this.conectionBD = this.conectarDB();

    //Middelwares
    this.middlewares();

    //Rutas de mi aplicación
    //this.routes();

    //Bot Telegram
    this.bot = new TelegramBot(process.env.TOKENTELEGRAM, { polling: true });
    
    
  }

  async conectarDB() {
    await dbConnection();
  }

  listen() {
    this.server.listen(this.port, () => {
      console.log(" Servidor Corriendo en el puerto ", this.port);
    });
  }

  middlewares() {
    //CORS
    this.app.use(cors());

    //Lectura y parseo del body
    this.app.use(express.json());

    // Directorio Público
    this.app.use( express.static('public/') );
  }

  routes() {
    /*this.app.get('/',( req,res )=>{
      res.sendFile(__dirname + '/index.html'); 
    });*/

  }
 

  obtenerFechaCompleta() {
    let date = new Date();
    let day = `0${date.getDate()}`.slice(-2); //("0"+date.getDate()).slice(-2);
    let month = `0${date.getMonth() + 1}`.slice(-2);
    let year = date.getFullYear();
    let fechaCompleta = `${day}/${month}/${year}`;

    return fechaCompleta;
  }

  obtenerHora(){
    let date = new Date();
    let hora = date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
    return hora;

  }

  notificaciones(msg = "", title = "Alerta", time = 5000) {
    growl.timeout(time).notify(title, msg);
  }

  configSmtp() {
    const transporter = nodemailer.createTransport({
      host: "smtp.gmail.com",
      port: 587,
      auth: {
        user: Buffer.from(process.env.USEREMAIL, "base64").toString("ascii"),
        pass: Buffer.from(process.env.PASSWORDEMAIL, "base64").toString(
          "ascii"
        ),
      },
    });

    return transporter;
  }

  async enviarEmail(title = "", body = "") {
    console.log("Enviando email..." + process.env.DESTINOSEMAIL);
    await this.configSmtp().verify().then(console.log).catch(console.error);
    await this.configSmtp()
      .sendMail({
        from: "Inversiondes del Pacifico", // sender address//,coordinador.aplicaciones@inverpacifico.com.co
        to: process.env.DESTINOSEMAIL, // list of receivers
        subject: title + " " + this.obtenerFechaCompleta() + " "+ this.obtenerHora()+" ", // Subject line
        text: "texto plano del correo", // plain text body
        html: " <h3> " + body+ "</h3>",
      })
      .then((info) => {
        console.log({ info });
      })
      .catch((e) => {
        console.log(e);
        this.notificaciones("Se presenta error al enviar la alerta");
      });
  }

  // función para enviar un mensaje por telegram
  async enviarMensajeTelegram (chatId, mensaje) {
    console.log('Enviando Mensaje por Telegram');
    await this.bot.sendMessage(chatId, mensaje);
  }

  async obtenerChatIDTelgram ( ) {
    
    const chatId = null;
    const obj = this;
    
    await this.bot.onText(/\/echo (.+)/, (msg, match) => {
      // 'msg' is the received Message from Telegram
      // 'match' is the result of executing the regexp above on the text content
      // of the message
    
       chatId = msg.chat.id;
       const resp = match[1]; // the captured "whatever"
    
      // send back the matched "whatever" to the chat
      //obj.sendMessage(chatId, resp);
      return chatId;
    });
    return chatId; 
  }

  async reponderMensajeAutomticoTelegram ( ) {
    
    const obj = this;
    
    await this.bot.onText(/\/echo (.+)/, (msg, match) => {
      // 'msg' is the received Message from Telegram
      // 'match' is the result of executing the regexp above on the text content
      // of the message
    
      const chatId = msg.chat.id;
      const resp = match[1]; // the captured "whatever"
    
      // send back the matched "whatever" to the chat
      obj.sendMessage(chatId, resp);
    });
  }

  
  enviarMensajeSpark( msg=''){

    const axios    = require('axios');
    const streamID = process.env.STREAMIDSPARK;
    const url      = process.env.URLAPIOPENFIRE;
    const token    = process.env.TOKENSPARK;
    const dominio  = process.env.DOMINIOPENFIRE;

    process.env["NODE_TLS_REJECT_UNAUTHORIZED"] = 0;
   
    
    let destinos   = process.env.DESTINOSPARK.split(';');

    if(  destinos.length > 0 ){
      for( let i=0; i < destinos.length; i ++ ){
        
        console.log( "Enviando Mensaje por el spark a "+destinos[i]+dominio);
        axios.post(url+streamID+"/messages/"+destinos[i]+dominio,{
          body: msg   
        },{
            headers:{
                'Authorization': token,
                'Accept': 'application/json'
            }
        })
        .then((res)=>{
            console.log('RESP '+res);
        })
        .catch((error)=>{
          console.log(error.response);
        });


      }
    }
   

  }



  
  conexionSocket  () {
  
   const obj = this;

   

   console.log( 'Iniciando SOcket'); 
   this.io.on("connection", function (socket) {

   

      console.log("Un cliente se ha conectado "+socket.id+" "+" "+obj.obtenerFechaCompleta()+" "+obj.obtenerHora());
   
      socket.on('alarma', async ( resp ) => {
        console.log(''+ resp.mac +' '+' '+ resp.ip+' '+resp.msg);

        let  dataPDv = await getPuntoVentaByMAC(  resp.mac );
        let  mensajeResp ="";
        let  title = "";
        if( dataPDv ){
          console.log( dataPDv.codigo + ' '+dataPDv.nombre + " "+obj.obtenerFechaCompleta()+" "+obj.obtenerHora());
          await insertAlerta( resp.mac, dataPDv.codigo, dataPDv.nombre, resp.ip);

          mensajeResp = "ALERTA, se ha presionado el botón de pánico en el punto de venta "+dataPDv.codigo + ' - '+dataPDv.nombre;
          title       = "ALERTA BOTÓN DE PÁNICO EN EL PUNTO DE VENTA "+dataPDv.codigo + ' - '+dataPDv.nombre;
        }else{
          mensajeResp = "ALERTA, se ha presionado el botón de pánico en el punto de venta con Dirección MAC "+resp.mac +( resp.ip )? " y Dirección IP "+ip:"" ;
          title       = "ALERTA BOTÓN DE PÁNICO EN EL PUNTO DE VENTA "+resp.mac+" "+resp.mac +( resp.ip )? " -  IP "+ip:"";
        }

        //Mensaje via Sokcet a la aplicacion de monitreo
        socket.broadcast.emit('mensajeAlarma', {
          'hora':obj.obtenerHora(),
           pdv:dataPDv.nombre,
          'codigo':dataPDv.codigo,
          fecha:obj.obtenerFechaCompleta()
        }
        );//Enviar mensaje por socket

        console.log(mensajeResp) ;
       

        try {
          await obj.enviarEmail( title,mensajeResp ); 
        } catch (error) {
          console.log('Error al enviar email '+error);
        }

        try {
          await obj.enviarMensajeSpark( mensajeResp );
        } catch (error) {
          console.log('Error Openfire '+error);
        }
        

        //Bot Telegram
        try {
          await obj.enviarMensajeTelegram( process.env.IDGROUPCHATELEGRAM, mensajeResp);
        } catch (error) {
           console.log('Error Telegram '+error);
        }
        

   
        
      });//FIn evento sockt Alarma

      socket.on('fecha-actual',()=>{
        socket.emit('fecha-actual', obj.obtenerFechaCompleta());
      });//Obtener Fecha Actual del Servidor

      socket.on('alertas-hoy',async () =>{
           let  fecha = obj.obtenerFechaCompleta();
           let  dataHoy = await getAlertas(  fecha, fecha );
           socket.emit('alertas-hoy', dataHoy);
      });


      socket.on('alertas-rango-fechas',async ( rangoFecha ) =>{
        console.log('recibiendo evento alertas-rango-fechas '+rangoFecha.fechaInicial +" "+rangoFecha.fechaFinal);
        let  data = await getAlertas(  rangoFecha.fechaInicial, rangoFecha.fechaFinal );
        if( !data ){
          data =  null;
        }
        socket.emit('alertas-rango-fechas', data );
      });
     


      socket.on("disconnect",() => {
        console.log("Cliente Desconectado "+socket.id+" "+" "+obj.obtenerFechaCompleta()+" "+obj.obtenerHora());
        socket.disconnect();
      });
      
      socket.on("forceDisconnect",() => {
        console.log("Cliente Desconectado "+socket.id+" "+" "+obj.obtenerFechaCompleta()+" "+obj.obtenerHora());
        socket.disconnect();
      });
    
    });
  
  }
}

module.exports = Server;
