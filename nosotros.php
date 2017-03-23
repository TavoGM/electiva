<?php

/**
 * Gustavo Granados
 * code is poetry
 */

require_once 'header.php';
$data = $db->getData("content('{key}')", array('key'=>'organization'), true);
$organization = $data['content'];
?>

    <h3>Trabaje con nosotros</h3>

    <h2>Grupos de Interés</h2>

    <form>
        <fieldset>
            <label>Nombre: </label><input placeholder="Nombre"> <br />
            <label>Correo: </label><input placeholder="Correo Electrónico">
        </fieldset>
    </form>

    <?php
    $groups = $db->getData("groups()");
    foreach ($groups as $group)
    {
      ?>
        <p>
            <input type="checkbox" id="groups" value="<?php echo $group['id'] ?>">
            <label for="groups"><?php echo $group['name'] ?></label>
        </p>
      <?php
    }
    ?>

<?php
require_once 'footer.php';
?>