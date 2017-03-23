<?php

/**
 * Gustavo Granados
 * code is poetry
 */

require_once ('app/Startup.php');

session_start();
$request = new Request($_REQUEST);

$userMessage = "";
try
{
  $login = $request->getParam('login');
  if ($login)
  {
    $username = trim($request->requireNotNullOrEmpty('username'));
    $password = trim($request->requireNotNullOrEmpty('password'));

    $account = new Account($username);
    $account->authenticate($password);

    if ($account->isAuthenticated())
    {
      $_SESSION['account'] = $account;
      header("Location:index.php");
    }
  }
}
catch (Exception $ex)
{
  ExceptionManager::handleException($ex);
  $userMessage = $ex->getMessage();
}
?>
<body>
<html>

  <form method="post" action="login.php">
    <fieldset>
      <div>
        <input placeholder="Usuario" name="username" autofocus>
      </div>
      <div>
        <input placeholder="Clave" name="password" type="password" value="">
      </div>
      <input name="login" type="submit" value="Iniciar Sesión">
    </fieldset>
  </form>
  <div><?php echo $userMessage; ?></div>

</html>
</body>