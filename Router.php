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
        // $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        // // $metodo = $_SERVER['REQUEST_METHOD'];    
        // //Metodo apache

        // // $urlActual = $_SERVER['REDIRECT_URL'] ?? '/';
        // $metodo = $_SERVER['REQUEST_METHOD'];

        if (isset($_SERVER['PATH_INFO'])) {
            $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        } else {
            $currentUrl = $_SERVER['REQUEST_URI'] === '' ? '/' : $_SERVER['REQUEST_URI'];
        }

        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'GET') {

            $funcion = $this->rutasGET[$currentUrl] ?? null;
        } else {

            $funcion = $this->rutasPOST[$currentUrl] ?? null;
        }

        //Proteger rutas
        if (in_array($currentUrl, $rutas_protegidas) && !$auth) {
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
