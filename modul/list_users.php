<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  
  <title>Добавление пользователей</title>
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">

  <script type="text/javascript" src="../js/jquery-1.6.4.min.js"></script>
  <link href="../bootstrap/css/dashboard.css" rel="stylesheet">
</head>

<body>
<?php include("security/control.php");?>

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
      <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-right">

          <li><a href="#">Профиль</a></li>
          <li><a href="#">Настроки</a></li>
          <li><a href="authorization.php">
          <?php print '<b style="color:#6D5FE7;">'.$_SESSION['user'].'</b>&nbsp' ; ?>Выйти
          </a></li>
          <li><a href="#">Help</a></li>
        </ul>

        
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
       <div class="col-sm-3 col-md-2 sidebar">
       <ul class="nav nav-sidebar">
          <li><h4>&nbspУправление работами</h4></li>
            <li><a href="adminka.php">Добавить работу</a></li>
            <li><a href="archive_vkr_works.php">Архив дипломных работ</a></li>
            <li><a href="archive_kurs_works.php">Архив курсовых работ</a></li>
            
          </ul>
       
         <?php 
             
              if ($_SESSION['user']=='Admin')
              {
                print'<ul class="nav nav-sidebar">
                <li><h4>&nbspУправление пользователями</h4></li>
                <li><a href="create_users.php">Добавить пользователя</a></li>
                <li class="active"><a href="list_users.php">Список пользователей</a></li>
              </ul>';
              }

               ?>
       
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h3 class="page-header" align="center">Список пользователей</h3>
          <!-- <div class="alert alert-info" align="center">Внимание! Заполните все необходимые поля, и проверте их достоверность. </div>   -->


          <div class="row placeholders ">

<?php 
if(isset($_POST['save']))
{ 
  $check = false;
  for ($i=0; $i <= 6 ; $i++) 
  { 
    if($_POST[$i] ==''){ $check = true;}
  }
  if ($check != true)
   {
    $id = $_POST['0'];
    $login = $_POST['1'];
    $role = $_POST['2'];
    $name = $_POST['3'];
    $date_bir = $_POST['4'];
    $email = $_POST['5'];
    $phone = $_POST['6'];

      $connect= pg_connect("host=localhost port=5432 dbname=sework_new user=postgres password=postgres");
      $update_user = pg_query($connect,"UPDATE users SET 
login='$login',
role='$role',
name_user='$name',
date_bir='$date_bir',
email='$email',
phonenumber='$phone'
WHERE id ='$id'
");

    print '<h3 align="center"> <b>Пользователь '.$name.'</b></h3>';
    print '<h3 align="center"> Успешно изменен!</h3>';
    header( "Refresh:3; url=list_users.php", true, 303); 
    exit;     
   }


}
  if(isset($_POST['esc']))
  { 
    print '<h3 align="center"> <b>Отмененно пользователем.</b></h3>';
    header( "Refresh:1; url=list_users.php", true, 303); 
    exit;
  }

  if(isset($_GET['delete']))
  {
    $delete = $_GET['delete'];
    $connect= pg_connect("host=localhost port=5432 dbname=sework_new user=postgres password=postgres");
    $result_users = pg_query($connect,"DELETE FROM users WHERE id ='$delete'");
     print '<h3 align="center"> <b>Пользователь </b></h3>';
      print '<h3 align="center"> Удален из базы данных!</h3>';
      header( "Refresh:3; url=list_users.php", true, 303); 
      exit;     
  }

  if(isset($_GET['edit']))
  { 
    $edit = $_GET['edit'];
    $arrayRow = array('0' => 'ID пользователя','1' => 'Логин', '2' => 'Права доступа',
     '3' => 'Ф.И.О пользователя', '4' => 'Дата рождения', '5' => 'Электронная Почта', '6' => 'Номер моб телефона'  );
    $connect= pg_connect("host=localhost port=5432 dbname=sework_new user=postgres password=postgres");
    $result_users = pg_query($connect,"SELECT id, login,role, name_user, date_bir, email, phoneNumber FROM  users WHERE id ='$edit'");
    print '<form class="form-horizontal" method ="POST">';
    
    $mass_users = pg_fetch_row($result_users);
   
      for ($i=1; $i <= 6 ; $i++) 
      { 
        print '<div class="form-group">
          <label class="control-label col-xs-3" for="lastName">'.$arrayRow[$i].':</label>
          <div class="col-xs-9">
            <input type="text" name="'.$i.'" class="form-control" id="login" align="left" value="'.trim($mass_users[$i]).'" >
          </div>
        </div>';
      }
    
print'<input type="text" name= "0" value= "'.$edit.'" hidden="true" >';
print '
      <input type="submit" name="save" class="btn btn-primary" value="Сохранить">
      <input type="submit" name ="esc" class="btn btn-default" value="Отмена">
</form></br>';
   
  }


?>

          

<!-- ///////////////////////////////////////////////////////////////////////////////////////// -->
<table class="table table-striped">
<?php
  $arrayRow = array('0' => 'ID пользователя','1' => 'Логин', '2' => 'Права доступа',
     '3' => 'Ф.И.О пользователя', '4' => 'Дата рождения', '5' => 'Электронная Почта', '6' => 'Номер моб телефона'  );
  $connect= pg_connect("host=localhost port=5432 dbname=sework_new user=postgres password=postgres");

  $result_users = pg_query($connect,"SELECT id, login,role, name_user, date_bir, email, phoneNumber FROM  users ORDER BY id");
    for ($b=0; $b <=6 ; $b++) 
    { 
       print '<td>'.trim($arrayRow[$b]).'</td>';
    }
  while ($mass_users = pg_fetch_row($result_users))
   {
      print '<tr>';
      for ($i=0; $i <= 6 ; $i++) 
      { 
        print '<td>'.trim($mass_users[$i]).'</td>';
      }
      print '<td> <a href="list_users.php?edit='.$mass_users[0].'"><span class="glyphicon glyphicon-pencil  "></a></td>';
      print '<td> <a href="list_users.php?delete='.$mass_users[0].'"><span class="glyphicon glyphicon-remove"></a></td>';
  
      print '</tr>';
   }  
 ?>  
</table>
 
<img src="" alt="">

          
<!-- ///////////////////////////////////////////////////////////////////////////////////////// -->    
        </div>
      </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    
    <script src="../docs.min.js"></script>
  </body>
</html>
