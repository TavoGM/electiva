<?php

/**
 * Gustavo Granados
 * code is poetry
 */

?>

<br /><br />
Organización<br />
<?php
$db = DB::getInstance();
$groups = $db->getData("groups()");
foreach ($groups as $group)
{
  echo "<a href='group.php?id=".$group['id']."'>".$group['name']."</a><br />";
}
?>
