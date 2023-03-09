
const oracledb = require('oracledb');


try {
    oracledb.initOracleClient({libDir: '/opt/oracle/instantclient_19_8/'});
} catch (error) {
  console.log(error);
  throw new Error('Error al iniciar el oracle instantclient');
  process.exit(1);
}

dbConfig = {
    user          : Buffer.from(process.env.USERBD, "base64").toString("ascii"),
    password      : Buffer.from(process.env.PASSWORDBD, "base64").toString("ascii"),
    connectString : process.env.CONNECTSTRING
}

const dbConnection = async() => {

    try {
        await oracledb.getConnection(dbConfig);
        console.log('Base de datos online');
        
    } catch (error) {
        console.log(error);
        throw new Error('Error al iniciar la base de datos');
    }
}

const runQuery = async ( sql, params=null, autoCommit=null ) =>{
    
    let connection, resultQuery;

    
   
    try {
        connection  = await oracledb.getConnection(dbConfig);

        if( params && autoCommit ){
          resultQuery   = await connection.execute(sql,params, { autoCommit: true});
        }
        else{
            resultQuery = await connection.execute(sql);
        }
       
        
        return  {
            status : true,
            msg    : 'ok',
            error  : null,
            resultQuery
        }
        
    }//fin try
    catch (error) {
    
        console.log('error al ejecutar el sql',error);
        return  {
            status : false,
            msg    : 'Error al ejecutar el sql ',
            error  : ''+error
        }
    
    }//fin catch 
    finally {
        if (connection) {
            try {
                await connection.close();
            }
            catch (error) {
                
                console.log('error al conectar la BD');
                return  {
                    status : false,
                    msg    : 'Error al conectar la BD',
                    error  : ''+error
                }
                
            }//fin catch
        }//fin if
    }//fin finally
}



module.exports = {
    dbConnection,
    dbConfig,
    runQuery
}