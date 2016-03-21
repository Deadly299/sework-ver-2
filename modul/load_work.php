<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Добавление Работы</title>
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="../bootstrap/css/dashboard.css" rel="stylesheet">

	<script type="text/javascript" src="../js/jquery-1.12.1.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
	<script src="../js/jquery-ui.js"></script>
	<script src="../js/jquery.ui.datepicker-ru.js"></script>
	
	<link rel="stylesheet" href="../css/jquery-ui.css">
	<script src="../js/modul/search.js"></script> >
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
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Профиль</a></li>
					<li><a href="#">Настроки</a></li>
					<li><a href="#">Выйти</a></li>
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
		            <li class="active"><a href="adminka.php">Добавить работу</a></li>
		            <li><a href="archive_vkr_works.php">Архив дипломных работ</a></li>
		            <li><a href="archive_kurs_works.php">Архив курсовых работ</a></li>
		            
		          </ul>
		          <?php 
		          include("security/control.php");
		          //session_start();
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
					<h3 class="page-header" align="center">Добавление работы</h3>
					<div class="alert alert-info" align="center">Внимание! Заполните все необходимые поля, и проверте их достоверность. </div>	


					<div class="row placeholders ">
					<?php if(!isset($_GET['open'])) exit; ?>

						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Шаблон 21.01.2016</h3>
							</div>
							<div class="panel-body">
								<div align="center">
									<form action="" method="GET">
										<div class="well well-lg">
											

<!-- <select class="form-control">
<option value="0" style="background-color:#A88F8F;">Выберете кафедру</option>
</select> -->
											<!-- <input type="text" name="chair" class="form-control" placeholder="Кафедра программирования и автоматизации бизнес-процессов"> -->
											<p align="center">Тема</p> 
											<input type="text" name="subject" id="searchbox" class="form-control" placeholder="Разработка системы управления курсовыми и дипломными работами. ">
											<div  align="center"> 

												
												
												

												<p align="center">Ф.И.О Исполнителя</p> 
						
											<select name="id_dep" class="form-control">
											<option value="0" style="background-color:#A88F8F;">Исполнителя</option>
<?php 
	$connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
	$result_dep = pg_query($connect,"SELECT  *FROM vkr_works ");
    while ($row_dep = pg_fetch_row($result_dep))
    {
      print '<option style ="background-color:#DDCECE;" value="'.$row_dep[0].'">';
        print $row_dep[2];
      print"</option>";
    }


 ?>

</select>
												

												

												<p align="center">Руководители</p> 
												 <hr>
												<p class="leftstr">Научный руководитель:</p>
												<p class="rightstr">Нормаконтролер:</p>
												<select name="head" class="form-control-smile">
												<option value="0" style="background-color:#A88F8F;">Научный руководитель</option>
<?php 
$result_cod = pg_query($connect,"SELECT  *FROM ped_composition");
    while ($row_cod = pg_fetch_row($result_cod))
    {
      print '<option style ="background-color:#DDCECE;" value="'.$row_cod[0].'">';
        print $row_cod[1];
      print"</option>";
    }


 ?>		
												</select>

							<select name="normative" class="form-control-smile">
												<option value="0" style="background-color:#A88F8F;">Нормаконтролер</option>
<?php 
$result_cod = pg_query($connect,"SELECT  *FROM ped_composition");
    while ($row_cod = pg_fetch_row($result_cod))
    {
      print '<option style ="background-color:#DDCECE;" value="'.$row_cod[0].'">';
        print $row_cod[1];
      print"</option>";
    }


 ?>		
												</select>


												

												<p align="center">Консультант(ы):</p> 
												<p class="leftstr">Ф.И.О</p>
												<p class="rightstr">Ученая степень / ученое звание</p>
<?php 
for ($c=1; $c <= 4 ; $c++) 
{ 
	if($c==1) $check = 'checked'; else $check = '';
print '
<div>
<label class="checkbox-inline">
<input type="checkbox" id="radio-inline" '.$check.' name="s_cons_'.$c.'" >№'.$c.':
</label>
<input type="text" name="subject" id="searchbox" class="form-control-cons" placeholder="Консультант №'.$c.'. ">
</div>';

print'<input type="text" name="open" value="'.$_GET['open'].'" hidden="true" > ';

}
 ?>
	



												<p align="center">Зав.Кафедрой:</p> 
												<p class="leftstr">Ф.И.О</p>
												<p class="rightstr">Ученая степень / ученое звание</p>
												<div>
													<select name="head_chair" class="form-control-cons">
												<option value="0" style="background-color:#A88F8F;">Зав.Кафедрой</option>
<?php 
$result_cod = pg_query($connect,"SELECT  *FROM ped_composition");
    while ($row_cod = pg_fetch_row($result_cod))
    {
      print '<option style ="background-color:#DDCECE;" value="'.$row_cod[0].'">';
        print $row_cod[1];
      print"</option>";
    }


 ?>		
												</select>
												</div>

												<p class="rightstr">Допущен(a) к защите</p>
												<input type="text" name="date_def" id="datepicker-d-1" placeholder="Дата">

												


											</div>

										</div>
										<div class="form_submit">
											<button type="submit" name="Save" class="btn btn-primary">Сохранить</button>
											<button type="submit" name="Prewi" class="btn btn-default">Предварительный просмотр</button>
										</div>
									</form>
								</div>


							</div>
						</div>
<?php 	

 



if(isset($_GET['Save']))
{							 
	if(
/*
$_GET['id_dep']!='' and 
$_GET['subject']!='' and
$_GET['code_okso']!='' and
$_GET['executor']!='' and
$_GET['groups']!='' and
$_GET['sex']!='' and
$_GET['office']!='' and
$_GET['id_qual']!='' and
$_GET['head']!='' and
$_GET['normative']!='' and
$_GET['n_cons_1']!='' and
$_GET['head_chair']!='' and
$_GET['open']!='' and*/

$_GET['s_cons_1']=='on' )


{
	$consultant='';
	
	$subject = $_GET['subject'];
	$executor = $_GET['executor'];
	$id_dep = $_GET['id_dep'];
	$id_code = $_GET['code_okso'];
	$groups = $_GET['groups'];
	$sex = $_GET['sex'];
	$office = $_GET['office'];
	$id_qual = $_GET['id_qual'];
	$id_head = $_GET['head'];
	$id_head_chair = $_GET['head_chair'];
	$id_normal = $_GET['normative'];
	$id_template = $_GET['open'];
	$date_def = $_GET['date_def'];

//print $consultant = $_GET['consultant_1'].'</br>';


for ($i=1; $i <= 4; $i++) 
{ 
	 if(isset($_GET['n_cons_'.$i.''])!='' AND isset($_GET['s_cons_'.$i.''])=='on' ) 
	 {
	 	//$arrayCons[$i] = preg_replace('(:)' , '<br><b>' , $_GET['n_cons_'.$i.'']);	
		//$arrayCons[$i] = $arrayCons[$i].'</b></br>';
		$arrayCons[$i] = $_GET['n_cons_'.$i.''];	 
	 } else $arrayCons[$i] = 'NULL';
}

	
$connect = pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");

		$insert_cons = pg_query($connect,"INSERT INTO consultants 
		(n_cons_1, n_cons_2, n_cons_3, n_cons_4) 
		VALUES 
		('$arrayCons[1]','$arrayCons[2]','$arrayCons[3]','$arrayCons[4]');");

$result_cons = pg_query($connect,"SELECT  id FROM  consultants ORDER BY id DESC  ");
$mass_cons = pg_fetch_row($result_cons);
$id_cons = $mass_cons[0];

		$insert_vkr = pg_query($connect,"INSERT INTO vkr_works 
(subject,executor,id_dep,id_code,groups,sex,office,id_qual,id_head,
id_head_chair,id_normal,id_template,id_cons,date_def) 
VALUES 
('$subject','$executor','$id_dep','$id_code','$groups','$sex','$office','$id_qual',
'$id_head','$id_head_chair','$id_normal','$id_template',$id_cons,'$date_def');");
  
  header( "location:load_work.php?open=$id_template"); 
  exit;  

	}
}

//$bodytag = str_replace("%body%", "black", "<body text='%body%'>");



 ?>



					</div>
				</div>
				<h2 class="sub-header">Section title</h2>
				<div class="table-responsive">


				</div>
			</div>
		</div>
	</div>



		
		<script src="bootstrap.min.js"></script>
		<script src="docs.min.js"></script>
	</body>
	</html>

