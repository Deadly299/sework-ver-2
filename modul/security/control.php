<?php 
session_start();

if (isset($_GET['exit']) or !isset($_SESSION['user']) ) 
{
  unset($_SESSION['user']);
  header ('Location:authorization.php'); 
}

