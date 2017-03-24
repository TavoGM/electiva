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
</head>
<body>

<div class="container">

    <header>
        <h1>Administrador de Contenido</h1>
    </header>

    <div class="topnav">
        <a class="active"  href="logout.php">Cerrar Sesión</a>
        <a class=""  href="be_groups.php">Grupos de Trabajo</a>
        <a class=""  href="be_content.php">Contenido</a>
    </div>

    <div class="row">

        <h2>Sistema administrativo del contenido del frontend</h2>

    </div>
  <footer>Copyright &copy;2017</footer>
</div>
</body>
</html>