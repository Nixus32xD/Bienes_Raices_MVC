<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController
{

    public static function crear(Router $router)
    {
        $vendedor = new Vendedor;

        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Crea una nueva instancia
            $vendedor = new Vendedor($_POST['vendedor']);

            // Validar que no haya campos vacios
            $errores = $vendedor->validar();

            //No hay errores
            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('/vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/admin');

        $vendedor = Vendedor::find($id);

        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignar los valores
            $args = $_POST['vendedor'];

            // Sincronizar objeto en memoria con lo del objeto en memmoria
            $vendedor->sincronizar($args);

            //Validacion
            $errores = $vendedor->validar();

            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('/vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }
    public static function eliminar()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Validar id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {

                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}
