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
      header("Location:be_index.php");
    }
  }
}
catch (Exception $ex)
{
  ExceptionManager::handleException($ex);
  $userMessage = $ex->getMessage();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="css.css">.
    <title>Backend</title>
</head>
<body>

<div class="container">

    <header>
        <h1>Iniciar Sesión</h1>
    </header>

    <div class="row">
    <div class="form">
      <form method="post" action="login.php">

          <div class="form-group">
              <label for="username">Usuario</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Usuario">
          </div>

          <div class="form-group">
              <label for="password">Clave</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Clave">
          </div>

          <button name="login" id="login" type="submit" value="1">Iniciar Sesión</button>

      </form>
      <p><?php echo $userMessage; ?></p>
    </div>
    </div>

  <footer>Copyright &copy;2017</footer>
</div>
</body>
</html>