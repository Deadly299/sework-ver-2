
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

<!-- <body style="background: url(../photo/fone4.jpg) top center ; opacity: 1">-->
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

  <div class="container-fluid" >
    <div class="row">
       <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><h4>&nbspУправление работами</h4></li>
            <li><a href="adminka.php">Добавить работу</a></li>
            <li class="active"><a href="archive_vkr_works.php">Архив дипломных работ</a></li>
            <li><a href="archive_kurs_works.php">Архив курсовых работ</a></li>
            
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

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" >
          <h3 class="page-header" align="center">Архив дипломных работ</h3>
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
      header( "Refresh:2; url=archive_vkr_works.php", true, 303); 
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
     $id_c = $_POST['5'];
     $id_dep =$_POST['id_dep'];
     $id_code =$_POST['id_code'];
     $id_qual =$_POST['id_qual'];
     $id_head =$_POST['id_head'];
     $id_head_chair =$_POST['id_head_chair'];
     $id_normal =$_POST['id_normal'];
     $id_tem =$_POST['id_tem'];
     $sex =$_POST['sex'];
     $office =$_POST['office'];
     $id_cons_1 = $_POST['id_cons_1'];
     $id_cons_2 = $_POST['id_cons_2'];
     $id_cons_3 = $_POST['id_cons_3'];
     $id_cons_4 = $_POST['id_cons_4'];
     


      $connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
      $update_user = pg_query($connect,"UPDATE vkr_works SET 
subject= '$par1',
executor = '$par2',
groups = '$par3',
date_def='$par4',
id_dep =$id_dep,
id_code =$id_code,
id_qual =$id_qual,
id_head =$id_head,
id_head_chair =$id_head_chair,
id_normal =$id_normal,
id_template =$id_tem,
sex =$sex,
office =$office
WHERE id ='$id'
");
            $update_user = pg_query($connect,"UPDATE consultants SET 
n_cons_1 = '$id_cons_1',
n_cons_2 = '$id_cons_2',
n_cons_3 = '$id_cons_3',
n_cons_4 = '$id_cons_4'
WHERE id =$id_c
");

    
  
        print '<h3 align="center"> <b>Работа успешно изменена</b></h3>';
        header( "Refresh:1; url=archive_vkr_works.php", true, 303);    
        exit; 
   }


}
  if(isset($_POST['esc']))
  { 
    print '<h3 align="center"> <b>Отмененно пользователем.</b></h3>';
    header( "Refresh:2; url=archive_vkr_works.php", true, 303); 
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
    $arrayRow = array(    '0' => 'ID',
    '1' => 'Название работы',
    '2' => 'Автор работы',
    '3' => 'Группа', 
    '4' => 'Дата защиты',
    '5' => 'Кафедра', 
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
id_dep,
id_code,
id_qual,
id_head,
id_head_chair,
id_normal,
id_template,
id_cons, 
sex, 
office FROM  vkr_works where id=$edit ");
    print '<form class="form-horizontal" method ="POST">';
    
    $mass_works = pg_fetch_row($result_works);
    $id_dep= $mass_works[5];
    $id_code= $mass_works[6];
    $id_qual= $mass_works[7];
    $id_head= $mass_works[8];
    $id_head_chair= $mass_works[9];
    $id_normal= $mass_works[10];
    $id_tem= $mass_works[11];
    $id_cons= $mass_works[12];
    $sex= $mass_works[13];
    $office= $mass_works[14];
    //$id_fac= $mass_works[12];
   
      for ($i=1; $i <= 4 ; $i++) 
      { 
        print '<div class="form-group">
          <label class="control-label col-xs-3" for="lastName">'.$arrayRow[$i].':</label>
          <div class="col-xs-9">
            <input type="text" name="'.$i.'" class="form-control" id="login" align="left" value="'.$mass_works[$i].'" >
          </div>
        </div>';
      }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        
   $result_tem_id = pg_query($connect,"SELECT  id_fac FROM  templates WHERE id =$id_tem ");
         $mass_tem_id = pg_fetch_row($result_tem_id);
         $id_fac = $mass_tem_id[0];

         $result_dep_id = pg_query($connect,"SELECT  id,abbreviation,id_fac,name_dep FROM  departments WHERE id =$id_dep ");
         $mass_dep_id = pg_fetch_row($result_dep_id);
         
         $connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
         $result_dep_vilid = pg_query($connect,"SELECT  id,abbreviation, name_dep FROM departments WHERE not_valid='not' AND id_fac=$id_fac");

      
 print '<div class="form-group">
          <label class="control-label col-xs-3" for="lastName">Кафедра:</label>
          <div class="col-xs-9">
            <select  name="id_dep" class="form-control">
      <option value="'.$mass_dep_id[0].'" style="background-color:#A88F8F;">'.$mass_dep_id[3].'</option>';

           while ($row_dep_id = pg_fetch_row($result_dep_vilid)) 
           {
              if($row_dep_id[0]!=$mass_dep_id[0])
              {
              print '<option style ="background-color:#DDCECE;" value="'.$row_dep_id[0].'">';
                print $row_dep_id[2];
              print"</option>";
              }
           }            
 
        print '</select>
          </div>
        </div>';//кафедры

$result_code_id = pg_query($connect,"SELECT  id,code,value FROM  code_okso WHERE id =$id_code ");
         $mass_code_id = pg_fetch_row($result_code_id);
         
         $connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
         $result_code_vilid = pg_query($connect,"SELECT id,code,value,id_fac  FROM code_okso WHERE id_fac= $id_fac ");

      
      print '<div class="form-group">
          <label class="control-label col-xs-3" for="lastName">Код ОКСО:</label>
          <div class="col-xs-9">
            <select  name="id_code" class="form-control">
      <option value="'.$mass_code_id[0].'" style="background-color:#A88F8F;">'.$mass_code_id[1].'/ '.$mass_code_id[2].'</option>';

           while ($row_code_id = pg_fetch_row($result_code_vilid)) 
           {
              if($row_code_id[0]!=$mass_code_id[0])
              {
              print '<option style ="background-color:#DDCECE;" value="'.$row_code_id[0].'">';
                print $row_code_id[1].'/ '.$row_code_id[2];
              print"</option>";
              }
           }            
 
        print '</select>
          </div>
        </div>';//код оксо
             
$result_qual_id = pg_query($connect,"SELECT  id,name_qual FROM  qualification WHERE id =$id_qual ");
         $mass_qual_id = pg_fetch_row($result_qual_id);
         
         
         $result_qual_vilid = pg_query($connect,"SELECT id,name_qual  FROM qualification  ");

      
      print '<div class="form-group">
          <label class="control-label col-xs-3" for="lastName">Квалификация:</label>
          <div class="col-xs-9">
            <select  name="id_qual" class="form-control">
      <option value="'.$mass_qual_id[0].'" style="background-color:#A88F8F;">'.$mass_qual_id[1].'</option>';

           while ($row_qual_id = pg_fetch_row($result_qual_vilid)) 
           {
              if($row_qual_id[0]!=$mass_qual_id[0])
              {
              print '<option style ="background-color:#DDCECE;" value="'.$row_qual_id[0].'">';
                print $row_qual_id[1];
              print"</option>";
              }
           }            
 
        print '</select>
          </div>
        </div>';//квалификация

$result_head_id = pg_query($connect,"SELECT  id,name_com, value FROM  ped_composition WHERE id =$id_head ");
       $mass_head_id = pg_fetch_row($result_head_id);
       
       
       $result_head_vilid = pg_query($connect,"SELECT id,name_com, value  FROM ped_composition ");

    
    print '<div class="form-group">
        <label class="control-label col-xs-3" for="lastName">Научный руководитель :</label>
        <div class="col-xs-9">
          <select  name="id_head" class="form-control">
    <option value="'.$mass_head_id[0].'" style="background-color:#A88F8F;">'.$mass_head_id[1].'</option>';

         while ($row_head_id = pg_fetch_row($result_head_vilid)) 
         {
            if($row_head_id[0]!=$mass_head_id[0])
            {
            print '<option style ="background-color:#DDCECE;" value="'.$row_head_id[0].'">';
              print $row_head_id[1];
            print"</option>";
            }
         }            

      print '</select>
        </div>
      </div>';//Науч руководитель

$result_head_chair_id = pg_query($connect,"SELECT  id,name_com, value FROM  ped_composition WHERE id =$id_head_chair ");
         $mass_head_chair_id = pg_fetch_row($result_head_chair_id);
         
         
         $result_head_chair_vilid = pg_query($connect,"SELECT id,name_com, value  FROM ped_composition ");

      
      print '<div class="form-group">
          <label class="control-label col-xs-3" for="lastName">Зав.кафедрой:</label>
          <div class="col-xs-9">
            <select  name="id_head_chair" class="form-control">
      <option value="'.$mass_head_chair_id[0].'" style="background-color:#A88F8F;">'.$mass_head_chair_id[1].'</option>';

           while ($row_head_chair_id = pg_fetch_row($result_head_chair_vilid)) 
           {
              if($row_head_chair_id[0]!=$mass_head_chair_id[0])
              {
              print '<option style ="background-color:#DDCECE;" value="'.$row_head_chair_id[0].'">';
                print $row_head_chair_id[1];
              print"</option>";
              }
           }            
 
        print '</select>
          </div>
        </div>';//зав.кафедрой

$result_normal_id = pg_query($connect,"SELECT  id,name_com, value FROM  ped_composition WHERE id =$id_normal ");
         $mass_normal_id = pg_fetch_row($result_normal_id);
         
         
         $result_normal_vilid = pg_query($connect,"SELECT id,name_com, value  FROM ped_composition ");

      
      print '<div class="form-group">
          <label class="control-label col-xs-3" for="lastName">Нормаконтролер:</label>
          <div class="col-xs-9">
            <select  name="id_normal" class="form-control">
      <option value="'.$mass_normal_id[0].'" style="background-color:#A88F8F;">'.$mass_normal_id[1].'</option>';

           while ($row_normal_id = pg_fetch_row($result_normal_vilid)) 
           {
              if($row_normal_id[0]!=$mass_normal_id[0])
              {
              print '<option style ="background-color:#DDCECE;" value="'.$row_normal_id[0].'">';
                print $row_normal_id[1];
              print"</option>";
              }
           }            
 
        print '</select>
          </div>
        </div>';//нормаконтролер

$result_tem_id = pg_query($connect,"SELECT  id,name_tem, value, id_fac, type FROM  templates WHERE id =$id_tem ");
         $mass_tem_id = pg_fetch_row($result_tem_id);
         
         
         $result_tem_vilid = pg_query($connect,"SELECT id,name_tem, value, id_fac, type  FROM templates
          WHERE id_fac=$id_tem AND type='$mass_tem_id[4]'");

      
      print '<div class="form-group">
          <label class="control-label col-xs-3" for="lastName">Шаблон титульной страницы:</label>
          <div class="col-xs-9">
            <select  name="id_tem" class="form-control">
      <option value="'.$mass_tem_id[0].'" style="background-color:#A88F8F;">'.$mass_tem_id[1].'</option>';

           while ($row_tem_id = pg_fetch_row($result_tem_vilid)) 
           {
              if($row_tem_id[0]!=$mass_tem_id[0])
              {
              print '<option style ="background-color:#DDCECE;" value="'.$row_tem_id[0].'">';
                print $row_tem_id[1];
              print"</option>";
              }
           }            
 
        print '</select>
          </div>
        </div>';//Шаблон

print' 
                        <p class="leftstr">Пол</p>
                        <p class="rightstr">Отделение </p>
                        <div class="leftstr">
                          <label class="checkbox-inline">';
if($sex=='0')
{
print'                      <input type="radio" checked id="radio-inline"  name="sex" value="0"> - М 
                          </label>
                          <label class="checkbox-inline">
                            <input type="radio" id="radio-inline"  name="sex" value="1"> - Ж 
                          </label>
                        </div>';
}else{
  print'                      <input type="radio"  id="radio-inline"  name="sex" value="0"> - М 
                          </label>
                          <label class="checkbox-inline">
                            <input type="radio" checked id="radio-inline"  name="sex" value="1"> - Ж 
                          </label>
                        </div>';
}//пол

if($office=='0')
{
print'     <div class="rightstr">
                          <label class="checkbox-inline">
                            <input type="radio"  id="radio-inline"  name="office" value="1"> - Заочное 
                          </label>
                          <label class="checkbox-inline">
                            <input type="radio" checked id="radio-inline"  name="office" value="0"> - Очное 
                          </label>
                        </div><hr>';
}else{
  print'     <div class="rightstr">
                          <label class="checkbox-inline">
                            <input type="radio" checked id="radio-inline"  name="office" value="1"> - Заочное 
                          </label>
                          <label class="checkbox-inline">
                            <input type="radio"  id="radio-inline"  name="office" value="0"> - Очное 
                          </label>
                        </div><hr>';
}//отделение обучения
                      
print'<h3 class="page-header" align="center">Консультатнты:</h3><h4>(Значение NULL- значит отсутствие)</h4><br>';
$result_cons_id = pg_query($connect,"SELECT  * FROM  consultants WHERE id =$id_cons ");
$mass_cons_id = pg_fetch_row($result_cons_id);

      for ($i=1; $i <=4 ; $i++) 
      { 
        $result_cons_vilid = pg_query($connect,"SELECT id,name_com, value  FROM ped_composition ");
        print '<div class="form-group">
          <label class="control-label col-xs-3" for="lastName">Консультатн №'.$i.':</label>
          <div class="col-xs-9">
            <select  name="id_cons_'.$i.'" class="form-control">
      <option value="'.$mass_cons_id[$i].'"  style="background-color:#A88F8F;">'.$mass_cons_id[$i].'</option>';
        print $mass_cons_id[1];
           while ($row_cons_id = pg_fetch_row($result_cons_vilid)) 
           {  
              print '<option style ="background-color:#DDCECE;" value="'.$row_cons_id[2].' : '.$row_cons_id[1].'">';
                print $row_cons_id[2].' : '.$row_cons_id[1];
              print"</option>";
           }
           print '<option value="NULL"  style="background-color:#D8B4B4;">NULL</option>';           
 
        print '</select>
          </div>
        </div>';
      }//Консультатнты
      





       print '<a href="create_template.php?edit='.$id_tem.'"><h4 style="margin-bottom:10px;">Изменить содержимое шаблона</h4></a>';
    
print'<input type="text" name= "0" value= "'.$edit.'" hidden="true" >';
print'<input type="text" name= "5" value= "'.$id_cons.'" hidden="true" >';

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
    header( "Refresh:2; url=archive_vkr_works.php", true, 303); 
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
    header( "Refresh:2; url=archive_vkr_works.php", true, 303); 
    exit;     
  }

?>       

<!-- ///////////////////////////////////////////////////////////////////////////////////////// -->
<table class="table table-striped" >
<?php
  $arrayRow = array(
    '0' => 'ID',
    '1' => 'Название работы',
    '2' => 'Автор работы',
    '3' => 'Группа', 
    '4' => 'Дата защиты',
    '5' => 'Кафедра', 
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
id_dep,
id_code,
id_qual,
id_head,
id_head_chair,
id_normal,
id_template,
id_cons, 
sex, 
office
 FROM  vkr_works ORDER BY id ");
  
    for ($b=0; $b <=4 ; $b++) 
    { 
      
       print '<td>'.trim($arrayRow[$b]).'</td>';
    }
    //print '<td> Добавить факультет</td>';
     print '<td  colspan="2"> <a href="create_template.php"><span class="glyphicon glyphicon-plus">Добавить</a></td>';
    print '<td  colspan="2"> Отменить: Да/Нет</td>';
  while ($mass_works = pg_fetch_row($result_works))
   {  
       $result_fac = pg_query($connect,"SELECT  id,abbreviation FROM  faculties WHERE id='$mass_works[3]'");
       $mass_fac = pg_fetch_row($result_fac);
      print '<tr>';
      for ($i=0; $i <= 4 ; $i++) 
      { 
        print '<td>'.trim($mass_works[$i]).'</td>';
      }
      print '<td> <a href="archive_vkr_works.php?edit='.$mass_works[0].'"><span class="glyphicon glyphicon-pencil  "></a></td>';
      print '<td> <a href="archive_vkr_works.php?delete='.$mass_works[0].'"><span class="glyphicon glyphicon-remove"></a></td>';
      print '<td> <a href="archive_vkr_works.php?up='.$mass_works[0].'"><span class="glyphicon glyphicon-thumbs-up"></a></td>';
      print '<td> <a href="archive_vkr_works.php?down='.$mass_works[0].'"><span class="glyphicon glyphicon-thumbs-down"></a></td>';

  
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
