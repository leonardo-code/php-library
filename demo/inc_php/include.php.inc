<?php
$TMPL_DIR = "tmpl/";
$PHPCLASSPATH = "classes/";
//error_reporting(E_ERROR|E_WARNING);

//$PHPCLASSPATH = $HTTP_SERVER_VARS['DOCUMENT_ROOT']."/classes/";
include ($PHPCLASSPATH."classTemplate.php");

$tmpl=new classTemplate;

function mysql_open () {
  // connessione db 

  $sqluser = '***';
  $sqlpassword = '***';
  $sqldatabase = '***';
  $sqlhost = '***';

  $db = @mysql_connect($sqlhost,$sqluser,$sqlpassword);
  if (!$db) {
    print "Error connecting to DB, try again later!";
    exit;
  }
  mysql_select_db($sqldatabase,$db);

  return $db;
}

$db = mysql_open();

?>
