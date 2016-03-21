
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
            <li class="active"><a href="archive_kurs_works.php">Архив курсовых работ</a></li>
            
          </ul>
                <?php 
             
              if ($_SESSION['user']=='Admin')
              {
                print'<ul class="nav nav-sidebar">
                <li><h4>&nbspУправление пользователями</h4></li>
                <li><a href="create_users.php">Добавить пользователя</a></li>
                <li><a href="list_users.php">Список пользователей</a></li>
              </ul>';
              }

               ?>
             
             
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h3 class="page-header" align="center">Список шаблонов</h3>
          <!-- <div class="alert alert-info" align="center">Внимание! Заполните все необходимые поля, и проверте их достоверность. </div>   -->


          <div class="row placeholders ">

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

          

<!-- ///////////////////////////////////////////////////////////////////////////////////////// -->
<table class="table table-striped">
<?php
  $arrayRow = array('0' => 'ID пользователя','1' => 'Название Шаблона', '2' => 'Тип Шаблона',
    '3' => 'Для факультета', '4' => 'Дата создания', '5' => 'Дата отменны'  );
  $connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");

  $result_templates = pg_query($connect,"SELECT  id,name_tem,type,id_fac,date_create,not_valid FROM  templates ORDER BY id ");
  
    for ($b=0; $b <=5 ; $b++) 
    { 
      
       print '<td>'.trim($arrayRow[$b]).'</td>';
    }
    //print '<td> Добавить факультет</td>';
     print '<td  colspan="2"> <a href="create_template.php"><span class="glyphicon glyphicon-plus">Добавить</a></td>';
    print '<td  colspan="2"> Отменить: Да/Нет</td>';
  while ($mass_templates = pg_fetch_row($result_templates))
   {  
       $result_fac = pg_query($connect,"SELECT  id,abbreviation FROM  faculties WHERE id='$mass_templates[3]'");
       $mass_fac = pg_fetch_row($result_fac);
      print '<tr>';
      for ($i=0; $i <= 5 ; $i++) 
      { 
        if($i==3)
        {
           print '<td>'.trim($mass_fac[1]).'</td>';
           continue;
        }
        if($i==2)
        {
           if($mass_templates[2]=='0')
           {
              print '<td>Курсовая</td>';
              continue;
           }else 
            {
              print '<td>ВКР</td>';
              continue;
            }
        }
        print '<td>'.trim($mass_templates[$i]).'</td>';
      }
      print '<td> <a href="edit_template.php?edit='.$mass_templates[0].'"><span class="glyphicon glyphicon-pencil  "></a></td>';
      print '<td> <a href="edit_template.php?delete='.$mass_templates[0].'"><span class="glyphicon glyphicon-remove"></a></td>';
      print '<td> <a href="edit_template.php?up='.$mass_templates[0].'"><span class="glyphicon glyphicon-thumbs-up"></a></td>';
      print '<td> <a href="edit_template.php?down='.$mass_templates[0].'"><span class="glyphicon glyphicon-thumbs-down"></a></td>';

  
      print '</tr>';
   }  
 ?>  
</table>
 

          
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
