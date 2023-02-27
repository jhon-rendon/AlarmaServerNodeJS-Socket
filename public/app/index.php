<?php

require_once("include/validate.php");

if(!$validate->checkLogin())
{
  header('location:'.URL_SITE.'login.php');
  
}

require_once("modelo.php");
require_once("vista.php");


?>

