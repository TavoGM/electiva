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
        <a class=""  href="be_groups.php">Grupos de Trabajo</a>
        <a class="active"  href="be_content.php">Contenido</a>
    </div>

    <div class="row">

        <?php
        $db = DB::getInstance();
        $data = $db->getData('contentList()');
        foreach ($data as $d)
        {
          $id = $d['id'];
          $key = $d['key'];
          $content = $d['content'];
        ?>

            <div class="form-group">
                <label for="content_<?php echo $id; ?>">Nombre de la propiedad: <?php echo $key ?></label>
                <textarea class="form-control" cols="69" rows="6" id="content_<?php echo $id; ?>"><?php echo $content ?></textarea><br/>
                <button onclick="saveContent(<?php echo $id; ?>)">Guardar</button><div id="result_<?php echo $id; ?>"></div>
            </div>
        <?php
        }
        ?>
    </div>
  <footer>Copyright &copy;2017</footer>
</div>
</body>
</html>