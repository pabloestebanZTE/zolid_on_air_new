<?php

/*
 * @author Starlly Software (John Jaider Vanegas)
 * https://starlly.com
 */

class Artisan {

    protected $args;

    function __construct($args) {
        $this->args = $args;
    }

    function run() {
        if (count($this->args) > 1) {
            $type = $this->args[1];
            //Obtenemos el comando.
            $command = $this->args[1];
            $args = [];
            $i = 0;
            //Obtenemos los argumentos (parámetros).
            foreach ($this->args as $arg) {
                if ($i > 1) {
                    $args[] = $arg;
                }
                $i++;
            }
            $p = new Process($command, $args);
            $p->run();
        } else {
            $lines = "Use:\n"
                    . " command [options] [arguments]\n\n"
                    . " Opciones:\n"
                    . " -h --help               \tMuestra el mensaje de ayuda\n"
                    . " -V --version            \tMuestra la version de deplyn\n\n\n"
                    . "Comandos:\n"
                    . " make:\n"
                    . "     make:auth           \tGenera el modulo del login, el registro y la recuperacion de clave.\n"
                    . "     make:controller     \tCrear un controlador.\n"
                    . "     make:middleware     \tCrear un middleware (no lo registra, el registro es manual).\n"
                    . "     make:validation     \tCrear un interuptor de validacion.\n"
                    . "     make:model          \tCrea un modelo(clase) de la(s) tabla(s) de la base de datos.";
            echo $lines;
        }
    }

}
