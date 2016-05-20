<!DOCTYPE>

<head>
  <meta charset="utf-8">
  
  <title>Добавление пользователей</title>
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">

  <script type="text/javascript" src="../js/jquery-1.12.1.js"></script>
  <link href="../bootstrap/css/dashboard.css" rel="stylesheet">

  <link href="../sort/themes/blue/style.css" rel="stylesheet">
  <script type="text/javascript" src="../sort/jquery.tablesorter.js"></script>

</head>

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

          <li><a href="setting_user.php">Профиль</a></li>
          <li><a href="authorization.php">
          <?php print '<b style="color:#5FA6E7;">'.$_SESSION['user'][1].'</b>&nbsp' ; ?>Выйти
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
          <li class="active"><a href="archive_vkr_works.php">Архив дипломных работ</a></li>
          <li><a href="archive_kurs_works.php">Архив курсовых работ</a></li>';    
        </ul>
        
        <ul class="nav nav-sidebar">
          <li><h4>&nbspУправление пользователями</h4></li>
          <li><a href="create_users.php">Добавить пользователя</a></li>
          <li><a href="list_users.php">Список пользователей</a></li>
        </ul>
           
                
             
             
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h3 class="page-header" align="center">Архив выпускных квалификационных работ</h3>
          <!-- <div class="alert alert-info" align="center">Внимание! Заполните все необходимые поля, и проверте их достоверность. </div>   -->


          <div class="row placeholders ">
    <form action="index.php" method="GET" >
              <input type="text" name="page" value="1" hidden="true">
              <input type="text" name="search_method" value="1" hidden="true">

        <input type="text" name="search" class="form-control-serch" placeholder="Поиск....." autocomplete="off">
      <button type="submit" class="search_button"><span class="glyphicon glyphicon-search"></span> Найти</button>
    <div class="search_area" >
        <div id="search_advice_wrapper" ></div>
      </div>
        </form>
<?php 
if(isset($_POST['insert']))
  {
    $p1 = $_POST['1'];
    $p2 = $_POST['2'];
    $p3 =date("d/m/Y");
    $p4 = 'no';

    $connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
      $res=pg_query($connect,"INSERT INTO templates (name_fac, abbreviation, date_create, not_valid) 
        VALUES ('$p1','$p2','$p3','$p4');");
      print '<h3 align="center"> <b>Факультет</b></h3>';
      print '<h3 align="center"> Успешно добавлен в базу данных!</h3>';
      header( "Refresh:2; url=edit_template.php", true, 303); 
      exit;  
  }
if(isset($_POST['save']))
{ 
  $check = false;
  for ($i=0; $i <= 5 ; $i++) 
  { 
    if($_POST[$i] ==''){ $check = true;}
  }
  if ($check != true)
   {
    $id = $_POST['0'];
     $par1 = $_POST['1'];
     $par2 = $_POST['2'];
     $par3 = $_POST['3'];
     $par4 = $_POST['4'];
     $par5 = $_POST['5'];


      $connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
      $update_user = pg_query($connect,"UPDATE templates SET 
name_tem='$par1',
type ='$par2',
id_fac=$par3,
date_create='$par4',
not_valid='$par5'
WHERE id ='$id'
");

    print '<h3 align="center"> <b>Факультет:</b> '.$par1.'</h3>';
    print '<h3 align="center"> Успешно изменен!</h3>';
    header( "Refresh:2; url=edit_template.php", true, 303); 
    exit;     
   }


}
  if(isset($_POST['esc']))
  { 
    print '<h3 align="center"> <b>Отмененно пользователем.</b></h3>';
    header( "Refresh:2; url=edit_template.php", true, 303); 
    exit;
  }

  if(isset($_GET['delete']))
  {
    $delete = $_GET['delete'];
    $connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
    $result_users = pg_query($connect,"DELETE FROM templates WHERE id ='$delete'");
     print '<h3 align="center"> <b>Факультет</b></h3>';
      print '<h3 align="center"> Удален из базы данных!</h3>';
      header( "Refresh:1; url=edit_template.php", true, 303); 
      exit;     
  }

  if(isset($_GET['edit']))
  { 
    $edit = $_GET['edit'];
    $arrayRow = array('0' => 'ID','1' => 'Название Шаблона', '2' => 'Тип Шаблона',
    '3' => 'Для факультета', '4' => 'Дата создания', '5' => 'Дата отменны'  );

    $connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
    $result_templates = pg_query($connect,"SELECT id,name_tem,type,id_fac,date_create,not_valid FROM  templates WHERE id ='$edit'");
    print '<form class="form-horizontal" method ="POST">';
    
    $mass_templates = pg_fetch_row($result_templates);
   
      for ($i=1; $i <= 5 ; $i++) 
      { 

        if($i==2)
        {
          print '<h4  align="center">Тип шаблона</h4>';

          print'<label class="checkbox-inline">
              <input type="radio" id="radio-inline"  name="'.$i.'" checked ="true" value="0"> - Курсовая работа  
            </label>
            <label class="checkbox-inline">
              <input type="radio" id="radio-inline"  name="'.$i.'" value="1"> - Дипломная работа 
            </label></br></br>';
            continue;
        }
        
        if($i==3)
        { $connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
      
      print '<div class="form-group">
          <label class="control-label col-xs-3" for="lastName">Факультеты:</label>
          <div class="col-xs-9">
            <select  name="id_dep" class="form-control">
      <option value="0" style="background-color:#A88F8F;">Выберете факультет</option>';

          $result_dep3 = pg_query($connect,"SELECT  *FROM faculties WHERE not_valid='no' ");
           while ($row_dep = pg_fetch_row($result_dep3)) 
           {
              print '<option style ="background-color:#DDCECE;" value="'.$row_dep[0].'">';
                print $row_dep[1];
              print"</option>";
           }            
 
        print '</select>
          </div>
        </div>';
      //print'<div align="center">';
          
        //print '</div>';
        continue;
        }


        print '<div class="form-group">
          <label class="control-label col-xs-3" for="lastName">'.$arrayRow[$i].':</label>
          <div class="col-xs-9">
            <input type="text" name="'.$i.'" class="form-control" id="login" align="left" value="'.trim($mass_templates[$i]).'" >
          </div>
        </div>';
      }
       print '<a href="create_template.php?edit='.$mass_templates[0].'"><h4 style="margin-bottom:10px;">Изменить содержимое шаблона</h4></a>';
    
print'<input type="text" name= "0" value= "'.$edit.'" hidden="true" >';

print '
      <input type="submit" name="save" class="btn btn-primary" value="Сохранить">
      <input type="submit" name ="esc" class="btn btn-default" value="Отмена">
</form></br>';
   exit;
  }



  if(isset($_GET['up']))
  {
    $id = $_GET['up'];
    $connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
    $update_user = pg_query($connect,"UPDATE templates SET 
      not_valid='no'
      WHERE id ='$id' ");

    print '<h3 align="center"> <b>Факультет Актуален!</b></h3>';
    header( "Refresh:2; url=edit_template.php", true, 303); 
    exit;     
  }
    if(isset($_GET['down']))
  {
    $id = $_GET['down'];
    $date_create =date("d/m/Y");
    $connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
    $update_user = pg_query($connect,"UPDATE templates SET 
      not_valid='$date_create'
      WHERE id ='$id' ");

    print '<h3 align="center"> <b>Факультет перстал быть актуальным!</b> </h3>';
    header( "Refresh:2; url=edit_template.php", true, 303); 
    exit;     
  }

?>

          

<body>

<!-- ///////////////////////////////////////////////////////////////////////////////////////// -->
<!-- <table class="table table-striped"> -->
<table id="myTable" class="tablesorter">

<?php
  $arrayRow = array(
    '0' => 'ID-работы',
    '1' => 'Название работы',
    '2' => 'Автор работы',
    '3' => 'Группа', 
    '4' => 'Дата защиты',
    '5' => 'Факультет', 
    '6' => 'Код ОКСО', 
    '7' => 'Квалификация',
    '8' => 'Руководитель',
    '9' => 'Зав. Кафедры',
    '10' => 'Нормаконтролер',
    '11' => 'Номер шаблона работы',
    '12' => 'Консультанты', 
    '13' => 'Пол', 
    '14' => 'Отделение' 
  );
  $connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");



  $result_works = pg_query($connect,"SELECT  

id,
subject, 
executor,
groups, 
date_def,
id_dep

 FROM  vkr_works ORDER BY id ");
  print'<thead>';
  print '<tr>';
    for ($b=0; $b <=5 ; $b++) 
    { 
      
       print '<th style="background-color: #685858;padding-rigth:1px;padding-right:18px;" align="center">'.trim($arrayRow[$b]).'</th>';
    }
 
    //print '<td> Добавить факультет</td>';
     print '<td  colspan="2"style="background-color: #685858; " align="center"> <a href="create_template.php"><span class="glyphicon glyphicon-plus">Добавить</a></td>';
  
   print '</tr>';
  print'</thead>';
   print'<tbody>';
  while ($mass_templates = pg_fetch_row($result_works))
   {  
       $result_fac = pg_query($connect,"SELECT  id,abbreviation FROM  faculties WHERE id='$mass_templates[5]'");
       $mass_fac = pg_fetch_row($result_fac);
      
      print '<tr>';
      for ($i=0; $i <= 5 ; $i++) 
      { 
        if($i==5)
        {
           print '<td>'.trim($mass_fac[1]).'</td>';
           continue;
        }
        
        print '<td>'.trim($mass_templates[$i]).'</td>';
      }
      print '<td> <a href="edit_template.php?edit='.$mass_templates[0].'"><span class="glyphicon glyphicon-pencil  "></a></td>';
      print '<td> <a href="edit_template.php?delete='.$mass_templates[0].'"><span class="glyphicon glyphicon-remove"></a></td>';
     

  
      print '</tr>';
      
   }  
    print'</tbody>';
 ?>  
</table>
 

          
<!-- ///////////////////////////////////////////////////////////////////////////////////////// -->    
        </div>
      </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
  </body>
</html>
