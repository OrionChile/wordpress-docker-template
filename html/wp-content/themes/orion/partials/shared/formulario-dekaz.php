<div class="contenedor">
    <div class="formulario-dekaz">
        <div class="input-box-dekaz" id="nombre">
            <input type="text" name="nombre" class="input-text-dekaz" id="nombre" placeholder="NOMBRE">
        </div>
        <div class="input-box-dekaz" id="email">
            <input type="text" name="email" class="input-text-dekaz" id="email" placeholder="EMAIL">
        </div>
        <div class="input-box-dekaz" id="telefono">
            <input type="text" name="telefono" class="input-text-dekaz" id="telefono" placeholder="TELÉFONO">
        </div>
        <div class="input-box-dekaz area" id="asunto">
            <textarea name="asunto" class="input-text-dekaz" id="asunto" placeholder="ASUNTO" cols="30" rows="10"></textarea>
        </div>
        
        <?php 
        if(!get_field('recatchpa','option') || ($_SERVER["SERVER_NAME"]) != "localhost"){
        ?>
        <input type="hidden" name="token" id="token">
        <script src="https://www.google.com/recaptcha/api.js?render=6LecWsUUAAAAAIPDYI3nuquXhERd04vL6SEACDPc"></script>
        <?php } else {
            ?>
            <input type="hidden" name="token" id="token" value='no'>
            <?php
        } ?>
        <div class="btnenviar button">
            <div class="fondo"></div>
            <div class="tx">Enviar</div>
        </div>
    </div>
</div>