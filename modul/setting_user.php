<!DOCTYPE >
<head>
  <meta charset="utf-8">
  <title>Добавление Работы</title>

  <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="../bootstrap/css/dashboard.css" rel="stylesheet">



 
  
  <script type="text/javascript" src="../js/jquery-1.12.1.js"></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
  
  <link rel="stylesheet" href="../css/jquery-ui.css">
  <script src="../js/jquery-ui.js"></script>
  <script src="../js/jquery.ui.datepicker-ru.js"></script>
  
    <!-- <link rel="stylesheet" href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/themes/sunny/jquery-ui.css">
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/jquery-ui.min.js"></script> -->
  
  <script src="../js/modul/search.js"></script> 
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
        <a class="navbar-brand" href="#">Sework</a>
      </div>

    </div>
  </div>


        
          <div class="row placeholders ">
          <h3 class="page-header" align="center">Пользовательские настройки</h3>
          
<?php 
  session_start();
  if (isset($_POST['cancel'])) 
  {
    header( "Refresh:0; url=adminka.php", true, 303);
  }

  if (isset($_SESSION['user']))
  {
   $id = $_SESSION['user'][0];
    $connect = pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres") ;
    $result_users = pg_query("SELECT * FROM users WHERE id = '$id' ");
    $row_users = pg_fetch_row($result_users);
   
  }
  if(isset($_POST['save']))
  {
    $check ='false';

    if (
      $_POST['login']!='' AND 
      $_POST['lastName']!='' AND 
      $_POST['email']!='' AND 
      $_POST['phoneNumber']!='' AND 
      $_POST['date']!='' 
      ) 
    {
      $login = $_POST['login'];
      $lastName = $_POST['lastName'];
      $email = $_POST['email'];
      $phoneNumber = $_POST['phoneNumber'];
      $date = $_POST['date'];

    $update_user =pg_query($connect, "UPDATE users 
            SET 
                login = '$login',
                name_user = '$lastName',
                email = '$email',
                phonenumber = '$phoneNumber',
                date_bir = '$date'
                   WHERE id = '$id' "); 
      //header('location:add_admin.php');
    $check ='true';

  }
  else 
    {
      print '<div class="alert alert-danger" align="center"> Вы не заполнили все поля, попробуйте еще раз.</div>'; 
      header( "Refresh:2; url=setting_user.php", true, 303);
      exit;
    }
    if( $_POST['inputPassword']!='' AND $_POST['confirmPassword']!='')
    {
        if ( $_POST['inputPassword'] == $_POST['confirmPassword']) 
        { 
           $inputPassword = $_POST['inputPassword'];
           $update_user_p =pg_query($connect, "UPDATE users SET password = '$inputPassword' WHERE id = '$id' "); 
           header( "Refresh:2; url=setting_user.php", true, 303); 
        }
        else 
        {
          print '<div class="alert alert-danger" align="center"> Пароли не совпадают! Попробуйте еще раз.</div>'; 
          header( "Refresh:2; url=setting_user.php", true, 303);
          exit;
        }
    }
    if($check='true')
    {
      print '<div class="alert alert-danger" align="center"> Данные  успешно изменены</div>'; 
      header( "Refresh:2; url=setting_user.php", true, 303);
    }
    
  }
?>
          <!-- /////////////////////////////////////////////////////////////////////////// -->
          <form class="form-horizontal" method="POST">
<div class="form-group">
    <label class="control-label col-xs-3" for="lastName">Логин:</label>
    <div class="col-xs-9">
      <?php print' <input type="text" name="login" class="form-control" id="login" value="'.$row_users[1].'">';?>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-xs-3" for="lastName">Фамилия Имя отчество:</label>
    <div class="col-xs-9">
      <?php print' <input type="text" name="lastName" class="form-control" id="lastName" value="'.$row_users[2].'">';?>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-xs-3" for="inputEmail">Email:</label>
    <div class="col-xs-9">
      <?php print' <input type="email" name="email" class="form-control" id="inputEmail" value="'.$row_users[5].'">';?>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-xs-3" for="inputPassword">Введите новый пароль:</label>
    <div class="col-xs-9">
      <?php print' <input type="password" name="inputPassword" class="form-control" id="inputPassword" value="">';?>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-xs-3" for="confirmPassword">Подтвердите пароль:</label>
    <div class="col-xs-9">
      <?php print' <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" value="">';?>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-xs-3" for="phoneNumber">Телефон:</label>
    <div class="col-xs-9">
      <?php print' <input type="tel" name="phoneNumber"class="form-control" id="phoneNumber" value="'.$row_users[6].'">';?>
    </div>
  </div>
  <div class="form-group" >
    <label class="control-label col-xs-3">Дата рождения:</label>
    <div class="col-xs-9"  align="left">
    <?php print' <input type="text" name="date" id="datepicker-d-1" value="'.$row_users[4].'">';?>
    </div>
  </div>
  

  <br />
  <div class="form-group" align="left">
    <div class="col-xs-offset-3 col-xs-9">
      <input type="submit" name="save" class="btn btn-primary" value="Изменить">
      <input type="submit" name="cancel" class="btn btn-default" value="Вернуться">
    </div>
  </div>
</form>
          <!-- /////////////////////////////////////////////////////////////////////////// -->    
            </div>







    
    
  </body>
  </html>

