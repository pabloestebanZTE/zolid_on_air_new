<style type="text/css">
    *{
        font-family: sans-serif;        
        font-size: 16px;
    }
</style>
<?php

file_put_contents(".htaccess", "RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [NC,L,QSA]

php_value upload_max_filesize 100M
php_value post_max_size 100M");

echo "Se ha escrito el archivo de configuración correctamente.";