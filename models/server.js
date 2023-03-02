require("dotenv").config();
const { dbConnection } = require("../database/config");
const growl = require("notify-send");
const nodemailer = require("nodemailer");
const express = require('express');
//const cors    = require('cors');
const TelegramBot = require('node-telegram-bot-api');
const  { getPuntoVentaByMAC, insertAlerta }  = require("./bdAlerta");


class Server {
  constructor() {

    this.app  = express();
    this.port = process.env.PUERTOSERVERSOCKET || 3000;

    this.server =  require("http").Server( this.app );
    this.listen();

    //Socket
    this.io = require("socket.io")( this.server );
    this.conexionSocket();

    //Conexión a la base de datos
    this.conectionBD = this.conectarDB();

    //Middelwares
    //this.middlewares();

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
    this.app.use( express.static('public') );
  }

  routes() {
    /*his.app.use('/auth',require('../routes/auth'));*/
  }

  obtenerFechaCompleta() {
    let date = new Date();
    let day = `0${date.getDate()}`.slice(-2); //("0"+date.getDate()).slice(-2);
    let month = `0${date.getMonth() + 1}`.slice(-2);
    let year = date.getFullYear();
    let fechaCompleta = `${day}/${month}/${year}`;

    return fechaCompleta;
  }

  notificaciones(msg = "", title = "Alerta", time = 5000) {
    growl.timeout(time).notify(title, "msg");
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
        subject: title + " " + this.obtenerFechaCompleta() + " ", // Subject line
        text: "texto plano del correo", // plain text body
        html: "Cordial saludo, <br><br>  " + body,
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

  
  enviarMensajeSpark( msg='Mensaje Desde NODEJS'){

    const axios    = require('axios');
    const streamID = process.env. STREAMIDSPARK;
    const url      = process.env. URLAPIOPENFIRE;
    const token    = process.env.TOKENSPARK;
    process.env["NODE_TLS_REJECT_UNAUTHORIZED"] = 0;
   
    let destinos   = new Array();

    destinos[0]  = "jhon.rendon@internet";
    destinos[1]  = "andres.saa@internet";

    
    
    for( let i=0; i < destinos.length; i ++ ){
      
      console.log( "Enviando Mensaje por el spark a "+destinos[i]);
      axios.post(url+streamID+"/messages/"+destinos[i],{
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



  
  conexionSocket  () {
  
   const obj = this;

   console.log( 'Iniciando SOcket'); 
   this.io.on("connection", function (socket) {
      console.log("Un cliente se ha conectado");
   
      socket.on('alarma', async ( resp ) => {
        console.log(''+ resp.mac +' '+' '+ resp.ip+' '+resp.msg);

        let  dataPDv = await getPuntoVentaByMAC(  resp.mac );
        if( dataPDv ){
          console.log( dataPDv.codigo + ' '+dataPDv.nombre );
          await insertAlerta( resp.mac, dataPDv.codigo, dataPDv.nombre, resp.ip);
        }

        socket.broadcast.emit('mensajeAlarma', resp.msg + dataPDv.codigo + ' '+dataPDv.nombre);
        
        //Bot Telegram
         //await bot.sendMessage('6230786982', "Mensaje: "+resp.msg + dataPDv.codigo + ' '+dataPDv.nombre);
         
        await obj.enviarMensajeTelegram('6230786982', "Mensaje: "+resp.msg + dataPDv.codigo + ' '+dataPDv.nombre);
        await obj.enviarEmail(); 
        await obj.enviarMensajeSpark( resp.msg + dataPDv.codigo + ' '+dataPDv.nombre );

      
        
      });
    
    });
  
  }
}

module.exports = Server;
