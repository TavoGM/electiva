<?php

/**
 * Gustavo Granados
 * code is poetry
 */

require_once 'header.php';
$data = $db->getData("content('{key}')", array('key'=>'mission'), true);
$mission = $data['content'];

$data = $db->getData("content('{key}')", array('key'=>'vision'), true);
$vision = $data['content'];

$data = $db->getData("content('{key}')", array('key'=>'values'), true);
$values = $data['content'];
?>

<h3>Quienes somos</h3>
  <p>
    Misión:<br /><?php echo $mission;  ?>
  </p>
  <p>
    Visión:<br /><?php echo $vision;  ?>
  </p>
  <p>
    Valores:<br /><?php echo $values;  ?>
  </p>

<?php
require_once 'footer.php';
?>