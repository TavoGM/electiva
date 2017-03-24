<?php

/**
 * Gustavo Granados
 * code is poetry
 */

$workActive = "active";
require_once 'header.php';
$id = $_REQUEST['id'];
$data = $db->getData("groupById('{id}')", array('id'=>$id), true);
$name = $data['name'];
$summary = $data['summary'];
?>

<?php
require_once 'side_menu.php';
?>

<section>
<article>

<h1><?php echo $name; ?></h1>
<h2>Resumen:</h2><p><?php echo $summary;  ?></p>

<h2>Objetivos:</h2>

    <?php
    $objectives = $db->getData("objectivesById('{id}')", array('id'=>$id));
    echo "<ul>";
    foreach ($objectives as $objective)
    {
      echo "<li>".$objective['content']."</li>";
    }
    echo "</ul>";
    ?>

<h2>Actividades:</h2>
        <?php
        $activities = $db->getData("activitiesById('{id}')", array('id'=>$id));
        foreach ($activities as $activity)
        {
          $date = date_create($activity['date']);
          ?>
          <table class="table-line">
            <tr>
                <th>Nombre: <?php echo $activity['name']; ?></th>
                <td rowspan="3"><img src="img/holder.png" alt="Beach View" style="width:150px;height:100px;"></td>
            </tr>
            <tr>
                <th>Fecha: <?php echo date_format($date, 'l jS F Y g:ia'); ?></th>
            </tr>
            <tr>
                <th>Lugar: <?php echo $activity['location']; ?></th>
            </tr>
            <tr>
                <td colspan="2">
                  <?php echo $activity['content']; ?>
                </td>
            </tr>
          </table>
          <br />
        <?php
        }
        ?>

</article>
</section>

<?php
require_once 'footer.php';
?>