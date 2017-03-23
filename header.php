<?php

/**
 * Gustavo Granados
 * code is poetry
 */

require_once ('app/Startup.php');

$db = DB::getInstance();
$data = $db->getData("content('{key}')", array('key'=>'name'), true);
$name = $data['content'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="description" content="Curso de electiva">
  <meta name="author" content="Gustavo Granados">

  <title>Sistema para curso de electiva</title>
</head>
<body>
<h3><?php echo $name; ?></h3>
||
<a href="index.php">Inicio</a> ||
<a href="quienes.php">Quienes somos</a> ||
<a href="trabajo.php">Nuestro trabajo</a> ||
<a href="nosotros.php">Trabaje con nosotros</a> ||
