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
          <ul class="nav nav-sidebar">
            <li><h4>&nbspУправление шаблонами</h4></li>
            <li><a href="create_template.php">Создать</a></li>
            <li><a href="edit_template.php">Настроить шаблон работы</a></li>
        
          </ul>
          <ul class="nav nav-sidebar">
            <li><h4>&nbspУправление пользователями</h4></li>
            <li><a href="create_users.php">Добавить пользователя</a></li>
            <li><a href="list_users.php">Список пользователей</a></li>
          </ul>
             <ul class="nav nav-sidebar">
            <li><h4>&nbspДополнительные настройки</h4></li>
            <li><a href="faculties.php">Факультеты</a></li>
            <li><a href="departments.php">Кафедры</a></li>
            <li><a href="code_okso.php">Код ОКСО</a></li>
            <li><a href="ped_composition.php">Состав ШГПИ</a></li>
            <li class="active"><a href="studens.php">Студенты</a></li>
          </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h3 class="page-header" align="center">Список студентов</h3>
          <!-- <div class="alert alert-info" align="center">Внимание! Заполните все необходимые поля, и проверте их достоверность. </div>   -->


          <div class="row placeholders ">

<?php 
if(isset($_POST['insert']))
  {
    $p1 = $_POST['1'];
    $p2 = date('j,n,Y');
    $p3 = 'no';

    $connect= pg_connect("host=localhost port=5432 dbname=sework_new user=postgres password=postgres");
      $res=pg_query($connect,"INSERT INTO studens (name_stu, date_create, not_valid) 
        VALUES ('$p1','$p2','$p3');");
      print '<h3 align="center"> <b>Факультет</b></h3>';
      print '<h3 align="center"> Успешно добавлен в базу данных!</h3>';
      header( "Refresh:2; url=studens.php", true, 303); 
      exit;  
  }
if(isset($_POST['save']))
{ 
  $check = false;
  for ($i=0; $i <= 3 ; $i++) 
  { 
    if($_POST[$i] ==''){ $check = true;}
  }
  if ($check != true)
   {
    $id = $_POST['0'];
    $name_stu = $_POST['1'];
    $date_create = $_POST['2'];
    $not_valid = $_POST['3'];


$connect= pg_connect("host=localhost port=5432 dbname=sework_new user=postgres password=postgres");
$update_user = pg_query($connect,"UPDATE studens SET 
  name_stu = '$name_stu',
  date_create = '$date_create',
  not_valid = '$not_valid'
  WHERE id = '$id'
");

    print '<h3 align="center"> <b>Студент:</b> '.$name_stu.'</h3>';
    print '<h3 align="center"> Успешно изменен!</h3>';
    header( "Refresh:2; url=studens.php", true, 303); 
    exit;     
   }


}
  if(isset($_POST['esc']))
  { 
    print '<h3 align="center"> <b>Отмененно пользователем.</b></h3>';
    header( "Refresh:2; url=studens.php", true, 303); 
    exit;
  }

  if(isset($_GET['delete']))
  {
    $delete = $_GET['delete'];
    $connect= pg_connect("host=localhost port=5432 dbname=sework_new user=postgres password=postgres");
    $result_users = pg_query($connect,"DELETE FROM studens WHERE id ='$delete'");
     print '<h3 align="center"> <b>Студент</b></h3>';
      print '<h3 align="center"> Удален из базы данных!</h3>';
      header( "Refresh:2; url=studens.php", true, 303); 
      exit;     
  }

  if(isset($_GET['edit']))
  { 
    $edit = $_GET['edit'];
    $arrayRow = array('0' => 'ID пользователя','1' => 'Ф.И.О',
         '2' => 'Дата создания', '3' => 'Дата отменны'  );
 
    $connect= pg_connect("host=localhost port=5432 dbname=sework_new user=postgres password=postgres");
    $result_studens = pg_query($connect,"SELECT *FROM  studens WHERE id ='$edit'");
    print '<form class="form-horizontal" method ="POST">';
    
    $mass_studens = pg_fetch_row($result_studens);
   
      for ($i=1; $i <= 3 ; $i++) 
      { 
        print '<div class="form-group">
          <label class="control-label col-xs-3" for="lastName">'.$arrayRow[$i].':</label>
          <div class="col-xs-9">
            <input type="text" name="'.$i.'" class="form-control" id="login" align="left" value="'.trim($mass_studens[$i]).'" >
          </div>
        </div>';
      }
    
print'<input type="text" name= "0" value= "'.$edit.'" hidden="true" >';
print '
      <input type="submit" name="save" class="btn btn-primary" value="Сохранить">
      <input type="submit" name ="esc" class="btn btn-default" value="Отмена">
</form></br>';
   exit;
  }
if(isset($_GET['add']))
  {
    $connect= pg_connect("host=localhost port=5432 dbname=sework_new user=postgres password=postgres");
   
    print '<form class="form-horizontal" method ="POST">';
    $arrayRow = array('0' => 'ID пользователя','1' => 'Ф.И.О',
         '2' => 'Дата создания', '3' => 'Дата отменны'  );
    for ($i=1; $i <= 1 ; $i++) 
      { 
        print '<div class="form-group">
          <label class="control-label col-xs-3" for="lastName">'.$arrayRow[$i].':</label>
          <div class="col-xs-9">
            <input type="text" name="'.$i.'" class="form-control" id="login" align="left"  >
          </div>
        </div>';
       

      }
       print '
      <input type="submit" name="insert" class="btn btn-primary" value="Сохранить">
      <input type="submit" name ="esc" class="btn btn-default" value="Отмена">
      </form></br>';
      exit;
  }

  if(isset($_GET['up']))
  {
    $id = $_GET['up'];
    $connect= pg_connect("host=localhost port=5432 dbname=sework_new user=postgres password=postgres");
    $update_user = pg_query($connect,"UPDATE studens SET 
      not_valid='no'
      WHERE id ='$id' ");

    print '<h3 align="center"> <b>Студент Актуален!</b></h3>';
    header( "Refresh:2; url=studens.php", true, 303); 
    exit;     
  }
    if(isset($_GET['down']))
  {
    $id = $_GET['down'];
    $date_create = date("m.d.y");
    $connect= pg_connect("host=localhost port=5432 dbname=sework_new user=postgres password=postgres");
    $update_user = pg_query($connect,"UPDATE studens SET 
      not_valid='$date_create'
      WHERE id ='$id' ");

    print '<h3 align="center"> <b>Студент перстал быть актуальным!</b> </h3>';
    header( "Refresh:2; url=studens.php", true, 303); 
    exit;     
  }

?>

          

<!-- ///////////////////////////////////////////////////////////////////////////////////////// -->
<table class="table table-striped">
<?php
  $arrayRow = array('0' => 'ID пользователя','1' => 'Ф.И.О',
         '2' => 'Дата создания', '3' => 'Дата отменны'  );
  $connect= pg_connect("host=localhost port=5432 dbname=sework_new user=postgres password=postgres");

  $result_studens = pg_query($connect,"SELECT  * FROM  studens ORDER BY id ");
    for ($b=0; $b <= 3 ; $b++) 
    { 
       print '<td>'.trim($arrayRow[$b]).'</td>';
    }
    //print '<td> Добавить факультет</td>';
    print '<td  colspan="2"> <a href="studens.php?add=ok"><span class="glyphicon glyphicon-plus">Добавить</a></td>';
    print '<td  colspan="2"> <a href="studens.php?add=ok">Отменить: Да/Нет</a></td>';
  while ($mass_studens = pg_fetch_row($result_studens))
   {
      print '<tr>';
      for ($i=0; $i <= 3 ; $i++) 
      { 
        print '<td>'.trim($mass_studens[$i]).'</td>';
      }
      print '<td> <a href="studens.php?edit='.$mass_studens[0].'"><span class="glyphicon glyphicon-pencil  "></a></td>';
      print '<td> <a href="studens.php?delete='.$mass_studens[0].'"><span class="glyphicon glyphicon-remove"></a></td>';
      print '<td> <a href="studens.php?up='.$mass_studens[0].'"><span class="glyphicon glyphicon-thumbs-up"></a></td>';
      print '<td> <a href="studens.php?down='.$mass_studens[0].'"><span class="glyphicon glyphicon-thumbs-down"></a></td>';

  
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
