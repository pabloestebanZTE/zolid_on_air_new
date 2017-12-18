<?php

class Process {

    private $command;
    private $args;

    function __construct($command, $args) {
        $this->command = $command;
        $this->args = $args;
    }

    public function run() {
        $this->startAction();
    }

    private function startAction() {
        switch ($this->command) {
            case "make:auth":
                echo "Generando módulo login.";
                break;
            case "make:controller":
                $this->createController();
                break;
            case "make:validation":
                $this->createValidation();
                break;
            case "make:middleware":
                $this->createMiddleware();
                break;
            case "make:model":
                $this->createModel();
                break;
            default :
                echo "Comando no encontrado.";
                break;
        }
    }

    private function createModel($nameTable = null) {
        $name_table = $this->args[0];
        if ($nameTable) {
            $this->args[0] = $nameTable;
        }
        require_once PATH_UTILS . "artisan/bin/ModelProcessor.php";
        $process = new ModelProccessor();
        if ($name_table == "-all") {
            //Procesar las tablas
            $tables = $process->getTables();
            $this->args[0] = null;
            foreach ($tables as $table) {
                $this->createModel($table->tablename);
            }
            return;
        }


        require_once PATH_UTILS . "artisan/bin/CamelTypes.php";
        $path = PATH_MODELS;
        $className = CamelTypes::camelCase($name_table) . "Model";
        $file = new File($path . "$className.php");
        $fileModel = PATH_UTILS . "artisan/source/Model.dpy";
        if (isset($this->args[1])) {
            //Nombre personalizado...
            $file = new File($path . $this->args[1] . ".php");
        }
        $content = file_get_contents($fileModel);
        $content = str_replace("ClassName", $className, $content);
        //Ahora consultamos los parámetros...
        $res = $process->getFields($name_table);
        $dbconfig = require PATH_CONFIG;
        $sqlLang = $dbconfig["connections"][$dbconfig["default"]]["driver"];
        $atributes = "";
        $getterandsetters = "";
        foreach ($res as $value) {
            $field = EQueries::getQuery(EQueries::FIELD_NAME, $sqlLang);
            $field = $value->{$field};
            $atributes .= "protected $$field;
    ";
            $fieldCS = CamelTypes::camelCase($field);
            $getterandsetters .= "    public function set$fieldCS($$field) {
        \$this->$field = $$field;
    }
";
            $getterandsetters .= "    public function get$fieldCS() {
        return \$this->$field;
    }
";
        }
        $content = str_replace("ATTRIBUTES", $atributes, $content);
        $content = str_replace("NAME_TABLE", $name_table, $content);
        $content = str_replace("GETTERANDSETTERS", $getterandsetters, $content);
        $file->write($content);
        echo $content;
        echo $className . " --> Creado correctamente.";
    }

    private function createMiddleware() {
        $className = $this->args[0];
        $path = PATH_MIDDLEWARES;
        $file = new File($path . "$className.php");
        $fileModel = PATH_UTILS . "artisan/source/Middleware.dpy";
        $content = file_get_contents($fileModel);
        $content = str_replace("ClassName", $className, $content);
        $file->write($content);
        echo $className . " --> Creado correctamente.";
    }

    private function createValidation() {
        $className = $this->args[0];
        $path = PATH_VALIDATIONS;
        $file = new File($path . "$className.php");
        $content = null;
        $fileModel = PATH_UTILS . "artisan/source/Validation.dpy";
        $content = file_get_contents($fileModel);
        $content = str_replace("ClassName", $className, $content);
        $file->write($content);
        echo $className . " --> Creado correctamente.";
    }

    private function createController() {
        $nameController = $this->args[0];
        $path = PATH_CONTROLLERS;
        $file = new File($path . "$nameController.php");
        $content = null;
        $fileModel = null;
        if ((isset($this->args[1])) ? $this->args[1] == "-r" : false) {
            $fileModel = PATH_UTILS . "artisan/source/FullController.dpy";
        } else {
            $fileModel = PATH_UTILS . "artisan/source/SimpleController.dpy";
        }
        $content = file_get_contents($fileModel);
        $content = str_replace("ClassName", $nameController, $content);
        $file->write($content);
        echo $nameController . " --> Creado correctamente.";
    }

}
