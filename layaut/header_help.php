<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Выбор шаблона</title>
	<link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="../bootstrap/css/dashboard.css" rel="stylesheet">
  <script type="text/javascript" src="../js/jquery-1.12.1.js"></script>
  <script type="text/javascript" src="../js/modul/script.js"></script>
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../index.php">Sework</a>
        </div>
        <div class="navbar-collapse collapse">
          
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
<?php
  if (!isset($_GET['help'])) 
  {
    print '<li><h4>&nbsp Методы поиска</h4></li>
            <li class="active"><a href="help.php">Простой поиск</a></li>
            <li><a href="help.php?help=1">Динамический поиск</a></li>
            <li><a href="help.php?help=2">Поиск по фильтрам</a></li>'; 
  }
  else
  { $help = $_GET['help'];
    switch ($help) 
    {
      case '1':
        {
          print '<li><h4>&nbsp Методы поиска</h4></li>
            <li><a href="help.php">Простой поиск</a></li>
            <li class="active"><a href="help.php?help=1">Динамический поиск</a></li>
            <li><a href="help.php?help=2">Поиск по фильтрам</a></li>';
        }
        break;
      
      case '2':
        {
          print '<li><h4>&nbsp Методы поиска</h4></li>
            <li><a href="help.php">Простой поиск</a></li>
            <li><a href="help.php?help=1">Динамический поиск</a></li>
            <li class="active"><a href="help.php?help=2">Поиск по фильтрам</a></li>';
        }
        break;
      
    }
  }

?>            
            
          </ul>

 
        </div>
