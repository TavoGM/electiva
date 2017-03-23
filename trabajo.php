<?php

/**
 * Gustavo Granados
 * code is poetry
 */

require_once 'header.php';
$data = $db->getData("content('{key}')", array('key'=>'organization'), true);
$organization = $data['content'];
?>

<?php
require_once 'side_menu.php';
?>

<h3>Nuestro Trabajo</h3>
  <h4>
    Organización:<br /><?php echo $organization;  ?>
  </h4>

  <h4>
    Grupos de Trabajo:<br />
    <?php
    $groups = $db->getData("groups()");
    foreach ($groups as $group)
    {
      echo "<a href='group.php?id=".$group['id']."'>".$group['name']."</a> - ".$group['summary']."<br />";
    }
    ?>
  </h4>

<?php
require_once 'footer.php';
?>