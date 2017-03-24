<?php

/**
 * Gustavo Granados
 * code is poetry
 */

$contactActive = "active";
require_once 'header.php';
$data = $db->getData("content('{key}')", array('key'=>'organization'), true);
$organization = $data['content'];
?>
<div class="row">
    <h1>Trabaje con nosotros</h1>

    <div class="form">
    <form>

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" placeholder="Nombre">
        </div>
        <div class="form-group">
            <label for="email">Correo</label>
            <input type="email" class="form-control" id="email" placeholder="Correo">
        </div>
        <div class="form-group">
            <label for="phone">Teléfono</label>
            <input type="phone" class="form-control" id="phone" placeholder="Teléfono">
        </div>
        <div class="form-group">
            <label for="motivacion">Motivación</label>
            <textarea class="form-control" rows="4" id="motivacion"></textarea>
        </div>

        <div class="checkbox">
        <h2>Grupos de Interes</h2>

        <?php
        $groups = $db->getData("groups()");
        foreach ($groups as $group)
        {
          ?>
            <label>
                <input type="checkbox" id="groups"> <?php echo $group['name'] ?>
            </label>
          <?php
        }
        ?>
        </div>

        <button type="submit" onclick="validate()">Enviar</button>
    </form>
    </div>
</div>
<script src="js/functions.js" defer></script>

<?php
require_once 'footer.php';
?>