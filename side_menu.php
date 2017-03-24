
<nav>
    <ul>
        <li>Organización</li>
        <?php
        $db = DB::getInstance();
        $groups = $db->getData("groups()");
        foreach ($groups as $group)
        {
          echo "<li><a href=\"group.php?id=".$group['id']."\">".$group['name']."</a></li>";
        }
        ?>

    </ul>
</nav>