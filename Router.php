<?php

namespace MVC;

class Router
{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas()
    {
        session_start();

        $auth = $_SESSION['login'] ?? false;
        //Arreglos de rutas protegidas...
        $rutas_protegidas = ['/admin', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar'];

        //Metodo PHP
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        // $metodo = $_SERVER['REQUEST_METHOD'];    
        //Metodo apache

        // $urlActual = $_SERVER['REDIRECT_URL'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        echo $_SERVER['PATH_INFO'];
        echo $_SERVER['REDIRECT_URL'];

        
        if ($metodo === 'GET') {

            $funcion = $this->rutasGET[$urlActual] ?? null;
        } else {

            $funcion = $this->rutasPOST[$urlActual] ?? null;
        }

        //Proteger rutas
        if (in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /');
        }

        if ($funcion) {
            // Verifica si la URL existe y hay una funcion asociada
            call_user_func($funcion, $this);
        } else {
            echo "Pagina no Encontrada";
        }
        
    }

    //Muestra una vista
    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean();

        include __DIR__ . "/views/layout.php";
    }
}
