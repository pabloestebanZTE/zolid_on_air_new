<?php

//Configuración de carga.
define('PROJECT_NAME', 'Deplyn');
define('VERSION', '0.1');
define('APPPATH', './application/');
define('PATH_ROUTES', './routes/');
define('ASSETS', './assets/');
define('PATH_VIEWS', './resources/views/');
define('PATH_LANGS', './resources/langs/');
define('PATH_CONTROLLERS', './app/Http/Controllers/');
define('PATH_VALIDATIONS', './application/models/validations');
define('PATH_MODELS', './application/models/dto/');
define('PATH_DAO', './app/Dao/');
define('PATH_SRC', './src/');
define('PATH_LIBS', './src/libs/');
define('PATH_UTILS', './utils/');
define('PATH_MIDDLEWARES', './app/Http/Middleware/');
define('MAILSEND', './libs/MailSend/MailSend.php');
define('FACEBOOK', 'https://www.facebook.com/StarllyOfficial');
define('TWITTER', 'https://www.twitter.com/StarllyOfficial');
define('GOOGLEPLUS', 'https://www.googleplus.com/StarllyOfficial');
define('YOUTUBE', 'https://www.youtube.com/Starlly');

//Configuración URL y DEBUG de la aplicación.
define('PATH_CONFIG', './application/config/db.php');
//$app = require_once PATH_CONFIG . "app.php";
define('DEBUG', true);
define('URL_PROJECT', "https://deplyn.com");

//Configuración de la aplicación.
define("DATE_LONG", "Y-m-d H:i:s");
define("DATE_SHORT", "Y-m-d");
define("DATE_HOUR", "H:i:s");
