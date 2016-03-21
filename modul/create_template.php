<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Выбор шаблона</title>
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bootstrap/css/dashboard.css" rel="stylesheet">
    
    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="../js/jquery-1.6.4.min.js"></script>
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
          <a class="navbar-brand" href="../index.php">Sework</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Профиль</a></li>
            <li><a href="#">Настроки</a></li>
            <li><a href="adminka.php?exit=1">Выйти</a></li>
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
            <li class="active"><a href="create_template.php">Создать</a></li>
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
            <li><a href="studens.php">Студенты</a></li>
          </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          

          <div class="row placeholders">

<!-- ///////////////////////////////////////////////////////////////////////////////////////// -->
<?php 


 if(isset($_POST['Save']))
  {  
    $id= $_POST['id'];
    $content= $_POST['content'];
    
      $connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
      $update_user = pg_query($connect,"UPDATE templates SET 
      value ='$content'

      WHERE id =$id
      ");
     print'<div class="alert alert-success">Внимание! Шаблон успешно загружен.</div>';
     header( "Refresh:2; url=edit_template.php?edit=$id", true, 303); 
     exit;
      
  }
  if(isset($_POST['esc']))
  { 
    $esc = $_POST['esc'];
    print'<div class="alert alert-success">Отменено пользователем</div>';
    header( "Refresh:1; url=edit_template.php?edit=$esc", true, 303); 
    exit;
  }

  if(isset($_POST['esc_adminka']))
  { 
    print'<div class="alert alert-success">Отменено пользователем</div>';
    header( "Refresh:1; url=adminka.php", true, 303); 
    exit;
  }
if(isset($_GET['edit']))
{ 
  print '<form name="myform" class="form_vkr" action="" method="POST" onsubmit="return save()">';
  $edit = $_GET['edit'];
  print '<h2 align="center">Правка шаблона</h2>';
  $connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
  $result_tem = pg_query($connect,"SELECT  id, value FROM templates WHERE id= $edit;");
  $row_tem = pg_fetch_row($result_tem);
  print'<input type="text" name= "id" value= "'.$edit.'" hidden="true" >';


  print'<div class="content" align="center">
  <textarea name="content" id="frameId" cols="45" rows="5">'.$row_tem[1].'</textarea>
</div>
<br>
<div class="form_submit">
      <button type="submit" name="Save" class="btn btn-primary">Создать шаблон</button>
      <button type="submit" name="esc" value="'.$edit.'" class="btn btn-default">Отменить</button>

     
  </div>
';

}

else 
{
  if(isset($_POST['content']) and isset($_POST['id_fac']))
  {  
    $id_fac = $_POST['id_fac'];
    $connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");

  $list_fac = pg_query($connect, "SELECT  id,abbreviation FROM faculties WHERE id= $id_fac ");
  $mass_fac=pg_fetch_row($list_fac);


     $date_create =date("d/m/Y");
     $html = $_POST['content'];
     $id_fac = $_POST['id_fac'];
     $type = $_POST['type'];
     $html= strip_tags($html, '<p><a><colgroup><table><tbody><tr><td><b><strong><br>style="text-align: center; vertical-align: bottom;"');
     $name_tem = 'Шаблон '.$mass_fac[1].'  от: '.$date_create;
    
 
      $connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
      $res=pg_query($connect,"INSERT INTO templates (name_tem, value, id_fac, date_create, type, not_valid) VALUES ('$name_tem','$html','$id_fac', '$date_create' ,$type, 'no');");
     print'<div class="alert alert-success">Внимание! Шаблон успешно загружен.</div>';
     header( "Refresh:3; url=create_template.php", true, 303);
      
  }
  print '<h2 align="center">Создание шаблонов, для факультетов ШГПИ</h2>';
  $connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
  $list_fac = pg_query($connect, "SELECT  *FROM faculties WHERE not_valid = 'no' ");
  print '<h3 class="page-header" align="center">Тип шаблона</h3>';
  print '<form name="myform" class="form_vkr" action="" method="POST" onsubmit="return save()">';
  print '     <label class="checkbox-inline">
                <input type="radio" id="radio-inline"  name="type" checked ="true" value="0"> - Курсовая работа  
              </label>
              <label class="checkbox-inline">
                <input type="radio" id="radio-inline"  name="type" value="1"> - Дипломная работа 
              </label></br></br>
                         ';
  print '<h3 class="page-header" align="center">Факультеты</h3>';
    while ($mass_fac=pg_fetch_row($list_fac))
    {     
      print'<label class="checkbox-inline">
                  <input type="radio" id="radio-inline"  name="id_fac" value="'.$mass_fac[0].'"> '.$mass_fac[2].'
            </label>';
    }
     print'<div class="content" align="center">
  <textarea name="content" id="frameId" cols="45" rows="5"></textarea>
</div>
<br>
<div class="form_submit">
      <button type="submit" name="Save_t" class="btn btn-primary">Создать шаблон</button>
       <button type="submit" name="esc_adminka" class="btn btn-default">Отменить</button>';


}
 ?>





  <script type="text/javascript">
    CKEDITOR.replace( 'frameId');
  </script>



  
</form>

      
 

 

<!-- ///////////////////////////////////////////////////////////////////////////////////////// -->
         
          
          
          <div class="table-responsive">
           
			
          
        </div>
    


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../bootstrap.min.js"></script>
    <script src="../docs.min.js"></script>
  </body>
</html>

