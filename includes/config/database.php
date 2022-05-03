<?php

function conectarDB() : mysqli{

    $db = new mysqli('us-cdbr-east-05.cleardb.net','baef7357b19d94','179364d9','heroku_b91f8a5d089d054');

    if(!$db){
        echo "ERROR no se pudo conectar";
        exit;
    } 
    return $db;
}