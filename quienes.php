<?php

/**
 * Gustavo Granados
 * code is poetry
 */

$usActive = "active";
require_once 'header.php';
$data = $db->getData("content('{key}')", array('key'=>'mission'), true);
$mission = $data['content'];

$data = $db->getData("content('{key}')", array('key'=>'vision'), true);
$vision = $data['content'];

$data = $db->getData("content('{key}')", array('key'=>'values'), true);
$values = $data['content'];
?>

    <div class="row">

    <h1>Quienes somos</h1>

    <h2>Misión:</h2><p><?php echo $mission;  ?></p>
    <h2>Visión:</h2><p><?php echo $vision;  ?></p>
    <h2>Valores:</h2><p><?php echo $values;  ?></p>

    </div>
<?php
require_once 'footer.php';
?>