<?php

/**
 * Gustavo Granados
 * code is poetry
 */

require_once 'header.php';
$id = $_REQUEST['id'];
$data = $db->getData("groupById('{id}')", array('id'=>$id), true);
$name = $data['name'];
$summary = $data['summary'];
?>

<?php
require_once 'side_menu.php';
?>

<h3><?php echo $name;  ?></h3>
  <h4>
    Resumen:<br /><?php echo $summary;  ?>
  </h4>

    <h4>Objetivos:</h4>
    <?php
    $objectives = $db->getData("objectivesById('{id}')", array('id'=>$id));
    echo "<ul>";
    foreach ($objectives as $objective)
    {
      echo "<li>".$objective['content']."</li>";
    }
    echo "</ul>";
    ?>

    <h4>Actividades:</h4>
    <?php
    $activities = $db->getData("activitiesById('{id}')", array('id'=>$id));
    echo "<ul>";
    foreach ($activities as $activity)
    {
      echo "<li>".$activity['name']."</li>";
    }
    echo "</ul>";
    ?>

<?php
require_once 'footer.php';
?>