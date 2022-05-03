<?php

function conectarDB() : mysqli{

    $db = new mysqli('us-cdbr-east-05.cleardb.net','baef7357b19d94','179364d9','heroku_b91f8a5d089d054');
    //mysql://baef7357b19d94:179364d9@us-cdbr-east-05.cleardb.net/heroku_b91f8a5d089d054?reconnect=true

    if(!$db){
        echo "ERROR no se pudo conectar";
        exit;
    } 
    return $db;
}