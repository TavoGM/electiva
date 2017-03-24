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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="css.css">.
    <title>Proyecto HTML5</title>
</head>
<body>

<div class="container">

    <header>
        <h1><?php echo $name; ?></h1>
    </header>

    <div class="topnav">
        <a class="<?php echo $contactActive ?>"  href="nosotros.php">Trabaje con Nosotros</a>
        <a class="<?php echo $workActive ?>"  href="trabajo.php">Nuestro Trabajo</a>
        <a class="<?php echo $usActive ?>"  href="quienes.php">Quienes Somos?</a>
        <a class="<?php echo $indexActive ?>"  href="index.php">Inicio</a>
    </div>
