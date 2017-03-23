<?php

require_once 'config.php';

class Request
{
  private $params;

  function __construct($request)
  {
    $this->params = $request;
  }

  public function getParam($key, $default = null)
  {
    $v = $this->params[$key];
    return (!$v ? $default : $v);
  }

  public function requireNotNullOrEmpty($key)
  {
    $v = $this->getParam($key);
    if (!$v || empty($v))
    {
      throw new Exception("invalid param");
    }
    return $v;
  }

  public function requireNumericAndPositive($key)
  {
    $v = $this->getParam($key);
    if (!is_numeric($v) || $v <= 0)
    {
      throw new Exception("invalid param");
    }
    return $v;
  }
}

class Account
{
  private $accountId;
  private $user;
  private $isAuthenticated = false;

  function __construct($user)
  {
    $this->user = $user;
    $this->accountId = 1;
  }

  public function authenticate($pass)
  {
    $this->isAuthenticated = $pass == '123';
    return $this->isAuthenticated();
  }

  public function isAuthenticated()
  {
    return $this->isAuthenticated;
  }

  public function getAccountId()
  {
    return $this->accountId;
  }

  public function getUsername()
  {
    return $this->user;
  }

}

class ExceptionManager
{
  public function handleException($ex)
  {
    file_put_contents("logs.txt", $ex);
  }
}

class Manager
{
  private $account;

  function __construct($account)
  {
    $this->account = $account;
  }
}

class DB
{

  /**
   * @var DB
   */
  private static $db;

  private $conn;

  private function __construct(){}

  /**
   * @return DB
   */
  public static function getInstance()
  {
    if (!DB::$db)
    {
      DB::$db = new DB();
    }
    return DB::$db;
  }

  private function openConnection()
  {
    $this->conn = @mysqli_init();
    @mysqli_real_connect($this->conn, DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if (@mysqli_connect_errno())
    {
      throw new Exception('Could not connect: ' . @mysqli_connect_error());
    }
  }

  private function closeConnection($lastResultSet)
  {
    if ($lastResultSet)
    {
      @mysqli_free_result($lastResultSet);
    }

    while(@mysqli_more_results($this->conn))
    {
      if(@mysqli_next_result($this->conn))
      {
        $result = @mysqli_use_result($this->conn);
        if ($result)
        {
          @mysqli_free_result($result);
        }
      }
    }

    @mysqli_close($this->conn);
  }

  private function processParams($statement, $params)
  {
    if (is_array($params))
    {
      foreach ($params as $key=>$value)
      {
        $statement = str_replace("{".$key."}", @mysqli_escape_string($this->conn, $value), $statement);
      }
    }
    return $statement;
  }

  public function getData($statement, $params = array(), $single = false)
  {
    $this->openConnection();

    $statement = $this->processParams($statement, $params);
    @mysqli_query($this->conn, "SET NAMES 'UTF8'");
    $result = @mysqli_query($this->conn, "call $statement;");
    if ($result === FALSE)
    {
      throw new Exception('Sql execution error: ' . @mysqli_error($this->conn));
    }

    $data = array();
    if ($single)
    {
      $data = @mysqli_fetch_assoc($result);
    }
    else
    {
      for (; $currentRow = @mysqli_fetch_assoc($result);)
      {
        $data[] = $currentRow;
      }
    }

    //$this->closeConnection($result);
    return $data;
  }

}