<style type="text/css">
    *{
        font-family: sans-serif;        
    }
    form .controls *{
        font-size: 16px;
    }

</style>
<form action="cambiarDB.php" method="POST" style="display: block; margin: 0 auto; border-radius: 5px; box-shadow: 0px 0px 1px #000; width: 500px; margin-top: 25px; background: #efefef; padding: 30px;">
    <h1>Configuración del sistema</h1>
    <div class="controls">
        <p>Si desea actualizar la configuración actual de la base de datos, ingrese el nombre de la configuración en la caja de texto y haga clic en actualizar.</p>
        <input type="text" name="db" />
        <button type="submit">Actualizar</button>
        <hr/>
        <p>
            Si desea escribir el .htaccess haga clic en el siguiente enlace.
        </p>
        <a href="escribirCog.php" target="_blank">Escribir .htaccess</a>
    </div>
</form>
<br/>