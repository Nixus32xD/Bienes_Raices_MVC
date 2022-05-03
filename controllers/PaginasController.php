<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;


class PaginasController
{

    public static function index(Router $router)
    {
        debuguear("Saludando desde el index");
        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }
    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros', []);
    }
    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::get(9);

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router)
    {
        $id = validarORedireccionar('/propiedades');

        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad',[
            'propiedad' => $propiedad

        ]);
        
        
    }
    public static function blog(Router $router)
    {
        $router->render('paginas/blog', [

        ]);
    }
    public static function entrada(Router $router)
    {
        $router->render('paginas/entrada', [

        ]);
    }
    public static function contacto(Router $router)
    {
        $mensaje = null;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $respuestas = $_POST['contacto'];


            //Crear una instancia de PHPmailer

            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail-> Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '8a10a5440bec37';
            $mail->Password = '61507246460c6c';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //Configura el contenido
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un Nuevo Mensaje';

            // Habilitar Html
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir Contenido
            $contenido = '<html>'; 
            $contenido .= '<p> Tienes un Nuevo Mensaje </p> '; 
            $contenido .= '<p> Nombre: ' . $respuestas['nombre'] .  ' </p> '; 
            

            //Enviar de forma condicional algunos campos
            if($respuestas['contacto'] === 'telefono'){

                $contenido .= '<p> Eligio ser contactado por telefono </p>';
                $contenido .= '<p> Telefono: ' . $respuestas['telefono'] .  ' </p> '; 
                $contenido .= '<p> Fecha de Contacto: ' . $respuestas['fecha'] .  ' </p> '; 
                $contenido .= '<p> Hora: ' . $respuestas['hora'] .  ' </p> '; 
            } else {
                //Es mail entonces agregamos el campo email
                $contenido .= '<p> Eligio ser contactado por email </p>';
                $contenido .= '<p> Email: ' . $respuestas['email'] .  ' </p> '; 
            }
            
            $contenido .= '<p> Mensaje: ' . $respuestas['mensaje'] .  ' </p> '; 
            $contenido .= '<p> Compra o Vende: ' . $respuestas['tipo'] .  ' </p> '; 
            $contenido .= '<p> Precio o Presupuesto: $' . $respuestas['precio'] .  ' </p> '; 
           
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';
            //Enviar el Mail
            if ($mail->send()) {
                $mensaje = "Mensaje Enviado Correctamente";
            } else {
                $mensaje = "El mensaje no se pudo enviar";
            }
        }
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}
