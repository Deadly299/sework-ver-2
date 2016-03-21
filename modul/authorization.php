<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Авторизация</title>

  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../bootstrap/signin.css" rel="stylesheet">
  </head>

  <body>

<?php
session_start();
unset($_SESSION['user']);

if(isset($_GET['user']) and isset($_GET['password']))
{
    $user = $_GET['user'];//user
    $password=$_GET['password'];    
    
    

  $connect = pg_connect("host=localhost port=5432 dbname=sework user=postgres password=postgres") ;
  $result_users = pg_query("SELECT id, login, password, role, name FROM users WHERE login = '$user' AND password = '$password'");
  $row_users = pg_fetch_row($result_users);
 
   if ($row_users!=false)
   {  

      if ($row_users[3] == 777 )//Вот как админ обозначаеться
      {
       print '<h3 align="center"> <b>Добро пожаловать! '.$row_users[4].'</b></h3>';
       print '<h3 align="center"> Вам доступны все права для управления системой Sework</h3>';
        
       
        $_SESSION['user']= $user;
        header( "Refresh:3; url=adminka.php", true, 303);
        exit;
      }
        else
        {
          print '<h3 align="center"> <b>Добро пожаловать! '.$row_users[4].'</b></h3>';
          print '<h3 align="center"> Вам доступны права для загрузки, студенческих работ на сервер.</h3>';
       
          $_SESSION['user']= $user;
          ini_set('session.gc_maxlifetime', 10);
          header( "Refresh:3; url=adminka.php", true, 303);
          exit;
        }       

         
    } 
    else print '<div class="alert alert-danger" align="center"> Неверные логин и/или пароль, попробуйте еще раз.</div>';      
  
}


?>
    <div class="container">

      <form class="form-signin" role="form" method="GET" action="authorization.php">
        <h2 class="form-signin-heading">Авторизация</h2>
        <input type="text" name="user" class="form-control" placeholder="Login..." required autofocus>
        <input type="password" name="password" class="form-control" placeholder="Password..." required>
        <label class="checkbox">
          <a href="../index.php">Вернуться</a>
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
      </form>

    </div> <!-- /container -->

  </body>
</html>