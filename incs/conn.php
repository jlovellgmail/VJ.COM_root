<?php

ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
$rootpath = $_SERVER['DOCUMENT_ROOT'];
include($rootpath . '/core/Database.class.php');
include($rootpath . '/core/table.class.php');
require_once $rootpath . "/classes/Cart.class.php";
require_once $rootpath . "/classes/Product.class.php";
$hostname = "192.168.1.164";
$username = "web1";
$password = "1oneweb";
$dbName = "VirgilJames";

$dbo = database::getInstance();
$dbo->connect($hostname, $username, $password, $dbName);

/*
  $ip = $_SERVER['REMOTE_ADDR'];
  $query = "Select * from Ips where IPs = '" . $ip."'";
  $dbo = database::getInstance();
  $dbo->doQuery($query);
  $IPList = $dbo->loadObjectList();

  if (is_array($IPList))
  {
  $resultCount = sizeof(IPList);
  }
  else
  {
  $resultCount = 0;
  }

  if ($resultCount==0){
  include($rootpath.'/errors/error_handler.php');
  } */

function mssql_escape_string($data) {
    if (!isset($data) or empty($data))
        return '';
    if (is_numeric($data))
        return $data;

    $non_displayables = array(
        '/%0[0-8bcef]/', // url encoded 00-08, 11, 12, 14, 15
        '/%1[0-9a-f]/', // url encoded 16-31
        '/[\x00-\x08]/', // 00-08
        '/\x0b/', // 11
        '/\x0c/', // 12
        '/[\x0e-\x1f]/'             // 14-31
    );
    foreach ($non_displayables as $regex)
        $data = preg_replace($regex, '', $data);
    $data = str_replace("'", "''", $data);
    $data = str_replace("\"", "&quot;", $data);
    return $data;
}

?>