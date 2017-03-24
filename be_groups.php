<?php

require_once ('app/Startup.php');

session_start();
$page = $_SERVER["REQUEST_URI"];
if (strpos($page, "login.php") === false)
{
  $account = $_SESSION['account'];
  if (!$account)
  {
    header("Location:login.php");
  }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="css.css">
    <title>Backend</title>

    <script src="js/functions.js" defer></script>

</head>
<body>

<div class="container">

    <header>
        <h1>Administrador de Contenido</h1>
    </header>

    <div class="topnav">
        <a class=""  href="logout.php">Cerrar Sesión</a>
        <a class="active"  href="be_groups.php">Grupos de Trabajo</a>
        <a class=""  href="be_content.php">Contenido</a>
    </div>

    <div class="row">

        <h2>Registrar un nuevo grupo:</h2>

        <div class="form-group">
            <label for="group">Grupo de Trabajo</label>
            <input type="text" class="form-control" id="group" placeholder="Grupo de Trabajo">
        </div>
        <div class="form-group">
            <label for="summary">Resumen</label>
            <textarea class="form-control" rows="4" id="summary" placeholder="Resumen"></textarea>
        </div>
        <button onclick="newGroup()">Guardar</button><div id="result"></div>

        <h2>Grupos actuales:</h2>
        <table class="table-line" id="groupsTable">
            <tr>
                <th>Grupo de Trabajo</th>
                <th>Resumen</th>
                <th>Acciones</th>
            </tr>
          <?php
          $db = DB::getInstance();
          $groups = $db->getData("groups()");
          foreach ($groups as $group)
          {
            echo "<tr>";
            echo "<td>".$group['name']."</td>";
            echo "<td>".$group['summary']."</td>";
            echo "<td><a href='be_group.php?id=".$group['id']."'>Modificar</a></td>";
            echo "</tr>";
          }
          ?>

        </table>

    </div>
  <footer>Copyright &copy;2017</footer>
</div>
</body>
</html>