<?php

/**
 * Gustavo Granados
 * code is poetry
 */

$workActive = "active";
require_once 'header.php';
$data = $db->getData("content('{key}')", array('key'=>'organization'), true);
$organization = $data['content'];
?>

<?php
require_once 'side_menu.php';
?>

<section>
<article>

<h1>Nuestro Trabajo</h1>

<h2>Organización:</h2><p><?php echo $organization; ?></p>

<table class="table-line">
    <tr>
        <th>Grupo de Trabajo</th>
        <th>Resumen</th>
    </tr>
    <?php
    $groups = $db->getData("groups()");
    foreach ($groups as $group)
    {
        echo "<tr>";
        echo "<td><a href='group.php?id=".$group['id']."'>".$group['name']."</a></td>";
        echo "<td>".$group['summary']."</td>";
        echo "</tr>";
    }
    ?>

</table>

</article>
</section>

<?php
require_once 'footer.php';
?>