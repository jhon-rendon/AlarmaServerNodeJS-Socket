const { runQuery } = require("../database/config");

const getPuntoVentaByMAC = async (mac = "") => {
  //mac = "2c-f0-5d-eb-5-a9";

  try {
    let dirMac = "";
    //Si existen una coma en el string de la mac, quiere decir que vienen varias mac anidadas
    if (mac.includes(",")) {
      //Si existe una coma al final del string
      if (mac.charAt(mac.length - 1) === ",") {
        //Eliminar la ultima coma del string
        dirMac = mac.substring(0, mac.length - 1);
      } else {
        dirMac = mac;
      }
    } else {
      dirMac = "'" + mac + "'";
    }
    sql = `
      SELECT PUNTOVENTA,nombre
      FROM GAMBLE.mac_punto_venta@apuestas, GAMBLE.territorios@apuestas 
      WHERE lower(DIRECCION_MAC_EQUIPO) in (${dirMac}) AND PUNTOVENTA = CODIGO
       `;
    //console.log(sql);
    result = await runQuery(sql);

    console.log(
      "Cantidad de registros consultados " + result.resultQuery.rows.length
    );

    let msg = "";
    let codigoPDv = null;
    let nombrePDV = null;

    if (result.resultQuery.rows.length > 0) {
      console.log("Listando los  Registros ");
      result.resultQuery.rows.map((data) => {
        console.log(data[0], data[1]);
        codigoPDv = data[0];
        nombrePDV = data[1];
      });
    } else {
      console.log(" La consulta no devolvio ningun registro");
    }

    return {
      nombre: nombrePDV,
      codigo: codigoPDv,
    };
  } catch (error) {
    console.log("Se presenta error al consultar la mac en BNET" + error);
  }
};

const insertAlerta = async (mac, codigoPDV, nombrePDV, ip = null) => {
  try {
    /***Registrar la alerta en la base de datos */
    sql = `
    INSERT INTO APPBOTONPANICO.ALERTA (FECHA, HORA,MAC,CODIGO_PDV,NOMBRE_PDV,IP) VALUES (SYSDATE,to_char(SYSDATE, 'HH24:MI:SS'),'${mac}','${codigoPDV}','${nombrePDV}','${ip}')
     `;
    result = await runQuery(sql, [], true);
  } catch (error) {
    console.log(
      "Se presenta error al Insertar el registro de la alerta en la base de datos" +
        error
    );
  }
};

module.exports = {
  getPuntoVentaByMAC,
  insertAlerta,
};
