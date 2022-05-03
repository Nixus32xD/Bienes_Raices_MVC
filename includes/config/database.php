<?php

function conectarDB() : mysqli{

    $db = new mysqli('exbodcemtop76rnz.cbetxkdyhwsb.us-east-1.rds.amazonaws.com','ku5s4zc1bj3tp0ck','snszxbhkhjj7geg6','s79kca9swbvvcymf');

    if(!$db){
        echo "ERROR no se pudo conectar";
        exit;
    } 
    return $db;
}