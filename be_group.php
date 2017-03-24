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
$id = $_REQUEST['id'];
$db = DB::getInstance();
$group = $db->getData("groupById('{id}')", array('id'=>$id), true);
$name = $group['name'];
$summary = $group['summary'];
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

        <h2>Modificar la información del grupo de trabajo:</h2>

        <div class="form-group">
            <label for="group">Grupo de Trabajo</label>
            <input type="text" class="form-control" id="group" placeholder="Grupo de Trabajo" value="<?php echo $name; ?>">
        </div>
        <div class="form-group">
            <label for="summary">Resumen</label>
            <textarea class="form-control" rows="4" id="summary" placeholder="Resumen"><?php echo $summary; ?></textarea>
        </div>
        <button onclick="saveGroup(<?php echo $id?>)">Guardar</button><div id="result"></div>

        <h2>Agregar nuevo objetivo:</h2>
        <div class="form-group">
            <label for="objective">Objetivo</label>
            <textarea class="form-control" rows="4" id="objective" placeholder="Objetivo"></textarea>
        </div>
        <button onclick="newObjective(<?php echo $id?>)">Agregar Objetivo</button><div id="resultNewObjective"></div>

        <h2>Objetivos Actuales:</h2>
        <table class="table-line" id="objectivesTable">
            <tr>
                <th>Contenido</th>
            </tr>
          <?php
          $db = DB::getInstance();
          $objectives = $db->getData("objectivesById('{id}')", array('id'=>$id));
          foreach ($objectives as $objective)
          {
            echo "<tr>";
            echo "<td>".$objective['content']."</td>";
            echo "</tr>";
          }
          ?>

        </table>

        <h2>Agregar una nueva actividad:</h2>
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" placeholder="Nombre">
        </div>
        <div class="form-group">
            <label for="date">Fecha</label>
            <input type="text" class="form-control" id="date" placeholder="Fecha" value="<?php echo date("Y-m-d H:i:s");?>">
        </div>
        <div class="form-group">
            <label for="location">Lugar</label>
            <input type="text" class="form-control" id="location" placeholder="Lugar de la actividad">
        </div>
        <div class="form-group">
            <label for="content">Contenido</label>
            <textarea class="form-control" rows="4" id="content" placeholder="Contenido"></textarea>
        </div>
        <button onclick="newActivity(<?php echo $id?>)">Agregar Actividad</button><div id="resultNewActivity"></div>

        <h2>Actividades Actuales:</h2>
        <?php
        $activities = $db->getData("activitiesById('{id}')", array('id'=>$id));
        foreach ($activities as $activity)
        {
          $date = date_create($activity['date']);
        ?>
          <table class="table-line" id="activitiesTable_<?php echo $activity['id']?>">
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
          <button onclick="deleteActivity(<?php echo $activity['id']?>)">Eliminar Actividad</button><div id="resultDelActivity_<?php echo $activity['id']?>"></div>
          <br />
        <?php
        }
        ?>

    </div>
  <footer>Copyright &copy;2017</footer>
</div>
</body>
</html>