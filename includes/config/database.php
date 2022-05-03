<?php

function conectarDB() : mysqli{

    $db = new mysqli('ec2-3-211-6-217.compute-1.amazonaws.com','jsmbqhiywvbuvb','ae70d1014203b621887635a743273ca094b4fa7016e6c8bfb8d0f25a8e164608','d6n7iq82veq322');

    if(!$db){
        echo "ERROR no se pudo conectar";
        exit;
    } 
    return $db;
}