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
	<?php include("security/control.php"); ?>
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
            <li class="active"><a href="adminka.php">Добавить работу</a></li>
            <?php 

              if ($_SESSION['user'][1]=='Admin')
                {
                  print'<li><a href="archive_vkr_works.php">Архив дипломных работ</a></li>
                  <li><a href="archive_kurs_works.php">Архив курсовых работ</a></li>';
                }

             ?>
            
            
          </ul>
          
           <?php 
              
              if ($_SESSION['user'][1]=='Admin')
              {
                print'<ul class="nav nav-sidebar">
                <li><h4>&nbspУправление пользователями</h4></li>
                <li><a href="create_users.php">Добавить пользователя</a></li>
                <li><a href="list_users.php">Список пользователей</a></li>
              </ul>';
              }

               ?>
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
					<h3 class="page-header" align="center">Добавление работы</h3>
					

					<div class="row placeholders ">
					<?php if(!isset($_GET['type'])) exit; ?>

						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Внимание! Заполните все необходимые поля, и проверте их достоверность. </h3>
							</div>
							<div class="panel-body">
								<div align="center">
									<form action="" method="GET">
										
										<?php 
										if(isset($_GET['type']))
										{
											$type = $_GET['type'];
											switch ($type) {
												case '1':
													include('vkr.php');	
													break;
												
												case '0':
													include('course_work.php');	
													break;
											}
										}
										//include('vkr.php');	

										 ?>	

										
										<div class="form_submit" align="center">
										  <div class="form-group">
										    <label >Загрузка текстового файла работы</label>
										    <input type="file" id="exampleInputFile">

										  </div>
										    <div class="form-group">
										    <label for="exampleInputFile">Загрузка программного продукта работы</label>
										    <input type="file" id="exampleInputFile">
										    
										  </div>
										  <div class="form-group">
										    <label for="exampleInputFile">Загрузка титултной страницы</label>
										    <input type="file" id="exampleInputFile">
										    
										  </div>
											<button type="submit" name="Save" class="btn btn-primary">Сохранить</button>
											<button type="submit" name="Prewi" class="btn btn-default">Предварительный просмотр</button>

										</div>
									</form>
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
				
			</div>
		</div>
	</div>



		
		
	</body>
	</html>

