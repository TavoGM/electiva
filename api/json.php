<?php

require_once '../app/Startup.php';

$db = DB::getInstance();

$userMessage = "Hubo un problema procesando solicitud!";
$data = json_decode(file_get_contents("php://input"), true);
$f = $data['f'];
if ($f == 'save')
{
  $id = $data['id'];
  $content = $data['content'];
  $record = $db->getData("updateContent('{id}','{content}')", array('id'=>$id,'content'=>$content), true);
  $userMessage = 'Cambios Actualizados';
}

if ($f == 'newGroup')
{
  $group = $data['group'];
  $summary = $data['summary'];
  $record = $db->getData("newGroup('{group}','{summary}')", array('group'=>$group,'summary'=>$summary), true);
  $userMessage = 'Nuevo Group Creado';
}

if ($f == 'saveGroup')
{
  $id = $data['id'];
  $group = $data['group'];
  $summary = $data['summary'];
  $record = $db->getData("updateGroup('{id}','{group}','{summary}')", array('id'=>$id,'group'=>$group,'summary'=>$summary), true);
  $userMessage = 'Los cambios han sido almacenados';
}

if ($f == 'newObjective')
{
  $id = $data['id'];
  $objective = $data['objective'];
  $record = $db->getData("newObjective('{id}','{objective}')", array('id'=>$id,'objective'=>$objective), true);
  $userMessage = 'El nuevo objetivo ha sido agregado';
}

if ($f == 'newActivity')
{
  $id = $data['id'];
  $name = $data['name'];
  $date = $data['date'];
  $location = $data['location'];
  $content = $data['content'];
  $record = $db->getData("newActivity('{id}','{name}','{date}','{location}','{content}')", array('id'=>$id,'name'=>$name,'date'=>$date,'location'=>$location,'content'=>$content), true);
  $userMessage = 'La nueva activity ha sido agregada';
}

if ($f == 'deleteActivity')
{
  $id = $data['id'];
  $record = $db->getData("deleteActivity('{id}')", array('id'=>$id), true);
  $userMessage = 'La activity ha sido eliminada';
}

?>
{
"userMessage": "<?php echo $userMessage; ?>"
}