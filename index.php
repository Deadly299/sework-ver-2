<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Выбор шаблона</title>
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="bootstrap/css/dashboard.css" rel="stylesheet">

	<script type="text/javascript" src="js/jquery-1.12.1.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/jquery.ui.datepicker-ru.js"></script>
	
	<link rel="stylesheet" href="css/jquery-ui.css">
	<script src="js/modul/search.js"></script> 

 
	
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
				<a class="navbar-brand" href="../index.php">Sework</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Советы по проекту</a></li>
					<li><a href="modul/authorization.php">Управление</a></li>
					<li><a href="#">Help</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3 col-md-2 sidebar">
				<ul class="nav nav-sidebar">
					<li><h4>&nbspМетоды поиска</h4></li>

					<?php 

						if(isset($_GET['search_method']))
						{
							if($_GET['search_method']==1)
							{
							  print'<li><a href="index.php">Простой</a></li>
									<li  class="active"><a href="index.php?search_method=1">Динамический</a></li>
									<li><a href="index.php?search_method=2">По фильтрам</a></li>';
							}
							else if($_GET['search_method']==2)
							{
							  print'<li><a href="index.php">Простой</a></li>
									<li><a href="index.php?search_method=1">Динамический</a></li>
									<li class="active"><a href="index.php?search_method=2">По фильтрам</a></li>';
							}else
							{
							  print'<li class="active"><a href="index.php">Простой</a></li>
									<li><a href="index.php?search_method=1">Динамический</a></li>
									<li><a href="index.php?search_method=2">По фильтрам</a></li>';							
								}
						}
						else
						{

							  print'<li class="active"><a href="index.php">Простой</a></li>
									<li><a href="index.php?search_method=1">Динамический</a></li>
									<li><a href="index.php?search_method=2">По фильтрам</a></li>';						
						}


					 ?>
					

				</ul>
				<!-- <ul class="nav nav-sidebar">
					<li><h4>&nbspУправление шаблонами</h4></li>
					<li><a href="#">Создать</a></li>
					<li><a href="#">Настроить шаблон работы</a></li>
				
				</ul> -->

			</div>
		</div>
	</div><!-- Коонец Шапки  -->      




<div class="container" >
	<div align="center"  >
<?php
if(isset($_GET['clear']))
{
	header( "Refresh:0; url=index.php?search_method=2.php", true, 303); 
}
if(!isset($_GET['search_method']))
{
	print'	
<form action="index.php" method="GET" >
		 <h3 align="center">Выберете место поиска</h3><br> 
		<div align="center">
			<label class="checkbox-inline">
				<input type="checkbox" id="checkbox-inline" checked name="vkr" value="1"> - Выпускная квалификационная работа 
			</label>
			<label class="checkbox-inline">
				<input type="checkbox" id="checkbox-inline" checked name="kurs" value="1"> - Курсовая работа(проект) 
			</label>
		</div><br>
		 <h3 align="center">Выберете облать поиска по: </h3><br> 
	 <select name="table" class="form-control-1">
		 <option value="1" > Ключевым словам</option>
		 <option value="2" > Дате</option>
		 <option value="3" > Автору работы</option>
		 <option value="4" > Факультету </option>
		 <option value="5" > Кафедре</option>
		 <option value="6" > Названию темы</option>
		 <option value="7" > Группе</option>
		 <option value="8" > Персоналу ШГПУ</option>
	 </select> 
	 <h3 align="center">Что искать</h3><br> 
	 <input type="text" name="search" class="form-control-serch-1" placeholder="Поиск....." autocomplete="off">
	 <input type="text" name="page" value="1" hidden="true">
 		<button type="submit" class="search_button"><span class="glyphicon glyphicon-search"></span> Найти</button>							</form>';

 	}else
{
		 switch ($_GET['search_method']) 
{

	
	case 1:
	{
	print'
			<h3 align="center">Вводите слова или фразы которые хотите найти</h3><br> 
		<form action="index.php" method="GET" >
             	<input type="text" name="page" value="1" hidden="true">
             	<input type="text" name="search_method" value="1" hidden="true">

			  <input type="text" name="search" class="form-control-serch" placeholder="Поиск....." autocomplete="off">
		  <button type="submit" class="search_button"><span class="glyphicon glyphicon-search"></span> Найти</button>
		<div class="search_area" >
        <div id="search_advice_wrapper" ></div>
			</div>
        </form>
		
		  
			
		    <div class="search_result" align="center" ></div>';


	}
		
		break;
	case 2:
	{
		print'<form action="index.php" method="GET" ><div class="tabs">
<h4>Поиск по нескольким фильтрам</h4>
<ul class="nav nav-tabs">
  <li class="active"><a href="#tab-1" data-toggle="tab" >Фильтр №1</a></li>
  <li><a href="#tab-2" data-toggle="tab" >Фильтр №2</a></li> 
  <li><a href="#tab-3" data-toggle="tab" >Фильтр №3</a></li>
</ul>

<div class="tab-content"><br>
 		
		  
	
	<div class="tab-pane fade in active" id="tab-1">

      <table class="table table-striped">';
      $arrayRow = array('1' => 'Название работы', '2' => 'Автор работы',
     '3' => 'Дата создания', '4' => 'Нормаконтролер' , '4' => 'Консультант'
     , '5' => 'Зав.кафедрой', '6' => 'Научный руководитель', '7' => 'факультет',
      '8' => 'Кафедра', '9' => 'Специальность' );
      for ($i=1; $i <= 9; $i++) 
      { 
		 print '<tr>';

       
      
      		print '<td>';
      		print $arrayRow[$i];
      		print '</td>';

		     		 print '<td>';
		      		if($i==3){
		      			print'<input type="text" name="filter-n-1-'.$i.'" id="datepicker-d-1" placeholder="Дата">';
		      		}else
					print'<input type="text" name="filter-n-1-'.$i.'" placeholder="Вводите">';

	      
		   		print'</td>';
 			
      		print '<td>';
 			

		     		 print '
		      
		     
		      	<select name="filter-s-1-'.$i.'" >
		      		<option value="1">Не выбранно</option>
					<option value="2">И</option>
					<option value="3">или</option>
					<option value="4">с</option>
					
				</select>
		      <td>
		   
		     ';
 			
 				print '<td>';
		      if($i==3){
		      			print'<input type="text" name="filter-n-2-'.$i.'" id="datepicker-d2-1" placeholder="Дата">';
		      		}else
					print'<input type="text" name="filter-n-2-'.$i.'" >';

		   		print'</td>';
 			
 			
			
      	
      print '</tr>';
      }
      print'</table>

	</div>
	<div class="tab-pane fade " id="tab-2"><!-- 2 -TAB  -->
		<table class="table table-striped">';
      $arrayRow = array('1' => 'Название работы', '2' => 'Автор работы',
     '3' => 'Дата создания', '4' => 'Нормаконтролер' , '4' => 'Консультант'
     , '5' => 'Зав.кафедрой', '6' => 'Научный руководитель', '7' => 'факультет',
      '8' => 'Кафедра', '9' => 'Специальность' );
      for ($i=1; $i <= 9; $i++) 
      { 
		 print '<tr>';
       
      		print '<td>';
      		print $arrayRow[$i];
      		print '</td>';

		     		print '<td>';
		      if($i==3){
		      			print'<input type="text" name="filter-n-2-'.$i.'" id="datepicker-d-2" placeholder="Дата">';
		      		}else
					print'<input type="text" name="filter-n-2-'.$i.'" >';

		   		print'</td>';
 			

		     		 print '
		      <td>
		     
		      	<select name="filter-s-2-'.$i.'" >
		      		<option value="1">Не выбранно</option>
					<option value="2">И</option>
					<option value="3">или</option>
					<option value="4">с</option>
					
				</select>
		      <td>
		   
		     ';
 			
 				print '<td>';
		      if($i==3){
		      			print'<input type="text" name="filter-n2-2-'.$i.'" id="datepicker-d2-2" placeholder="Дата">';
		      		}else
					print'<input type="text" name="filter-n-2-'.$i.'" >';

		   		print'</td>';
 			
 			
			
 			
 			
			
      	
      print '</tr>';
      }
      print'</table>
	</div>
	<div class="tab-pane fade " id="tab-3"><!-- 1 -TAB  -->
		<table class="table table-striped">';
       $arrayRow = array('1' => 'Название работы', '2' => 'Автор работы',
     '3' => 'Дата создания', '4' => 'Нормаконтролер' , '4' => 'Консультант'
     , '5' => 'Зав.кафедрой', '6' => 'Научный руководитель', '7' => 'факультет',
      '8' => 'Кафедра', '9' => 'Специальность' );
       print '<td>';

        $arrayName = array('0' => 'Название таблиц','1' => 'Параметр №1', '2' => 'Логическое выражение',
     '3' => 'Параметр №2');
        print '<tr>';
        for ($b=0; $b <=3 ; $b++) 
        { 
        	print '<td>';
      		print $arrayName[$b];
      		print '</td>';
        }
        print '</tr>';
       
      for ($i=1; $i <= 9; $i++) 
      { 
		 print '<tr>';
       
      		print '<tr>';
       
      		print '<td>';
      		print $arrayRow[$i];
      		print '</td>';

		     		print '<td>';
		      if($i==3){
		      			print'<input type="text" name="filter-n-3-'.$i.'" id="datepicker-d-3" placeholder="Дата">';
		      		}else
					print'<input type="text" name="filter-n-3-'.$i.'" >';

		   		print'</td>';
 			
      		print '<td>';
 			

		     		 print '
		      
		     
		      	<select name="filter-s-3-'.$i.'" >
		      		<option value="1">Не выбранно</option>
					<option value="2">И</option>
					<option value="3">или</option>
					<option value="4">с</option>
					
				</select>
		      <td>
		   
		     ';
 			
 				print '<td>';
		      if($i==3){
		      			print'<input type="text" name="filter-n2-3-'.$i.'" id="datepicker-d2-3" placeholder="Дата">';
		      		}else
					print'<input type="text" name="filter-n-3-'.$i.'" >';

		   		print'</td>';
 			
			
      	
      print '</tr>';
      }
      print'</table>
			
		  
			
	</div><!-- /tab-pane fade  -->
  </div><!-- /tab-content  -->
  <input type="text" name="page" value="1" hidden="true">
  <input type="text" name="search_method" value="2" hidden="true">
  <input type="submit">
  <input type="submit" name="clear" value="Очистить">
  </form>
</div>
			
';
	}
		
		break;

}		
} ?>


	<?php 
	if (isset($_GET['search']) AND isset($_GET['page'])) 
	{
		if($_GET['search'] != '' AND $_GET['page']!='')
		{
			$col=0;
		$search = $_GET['search'];
		$connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
		$db_referal = pg_query($connect, "SELECT  subject FROM vkr_works where subject  ilike '%$search%' ");
		   		//print $row[1];$col=0;
		while ($row2=pg_fetch_row($db_referal))
		{	
			$col;//$col Это кол-во записей в таблице.
		}
			if($col > 10)
			{
				$google = $col/10;//Это кол-во записей деленная на то, сколько ты хочешь выводить записей я 10 вывожу, 
							  //короче формируешь 1,2,3,4,5.... ну поймешь
					if(isset($_GET['page']))//Когда тыкнул на номер страницы page=номер страницы 
					{	
						$page = $_GET['page']-1;//Тут ты этот номер страныцы умножаешь на 10(так как 10 записей хочешь выводить) 
						$page = $page*10;
						$res=pg_query($connect," SELECT * FROM vkr_works  where subject  ilike '%$search%'
					   ORDER BY id 
					   OFFSET '$page' LIMIT 10;");//Вот тут в запросе ты и подставлеяешь $page(с какой строки начинать)
					
						//print'</br>';
						print '<p class="page-header" align="center">Результатов: примерно <b>'.$col.'</b> </p>';
						while ($row=pg_fetch_row($res))//И выводишь
						{	
							print '<div class="result_div" align="center">';
					print '<a href="modul/open.php?id='.$row[0].'"><h4 class="page-header" align="center">'.$row[2].'</h4></a>	';
					//print' <h3 class="page-header" align="center">Добавление пользователя</h3>';
					print '<p style="font-size: 17px;color:#160909;" align="left"><b>Автор:</b> '.$row[5].'</p>';
					print '<p style="font-size: 17px;color:#160909;" align="left"><b>Кафедра:</b> '.$row[1].'</p>';
					print '<p style="font-size: 17px;color:#160909;" align="left"><b>Группа:</b> '.$row[6].'</p>';
					print '<p style="font-size: 17px;color:#160909;" align="left"><b>Год:</b> '.$row[18].'</p>';
					print '</div>';
					print'</br>';
							
						}
					}
					//Пагинация
					print'<div align="center">';
					print'<ul class="pagination">';
					print'<li><a href="index.php?page= '.($page/10).'&search='.$_GET['search'].'">&laquo;</a></li>';
					for ($i=1; $i < $google; $i++) 
					{ 
							
						 	if ($page/10+1 == $i) 
						 	{
								print'
										  
		<li class="active"><a href="index.php?page= '.$i.'&search='.$_GET['search'].'">'.$i.' <span class="sr-only">(current)</span></a></li>
										';
								//print'<a href="index.php?page= '.$i.'&search='.$_GET['search'].'"  style="color:black;">'.$i.' </a>';//Тут ты список выводишь 1,2,3,4,5,..
						 	}
						 	else
						print '  <li><a href="index.php?page= '.$i.'&search='.$_GET['search'].'">'.$i.'</a></li>';
						 	//print'<a href="index.php?page= '.$i.'&search='.$_GET['search'].'" >'.$i.' </a>';//Тут ты список выводишь 1,2,3,4,5,..
						 	//print 'fds';
						 }
						
					print'<li><a href="index.php?page= '.($page/10+2).'&search='.$_GET['search'].'">&raquo;</a></li>';
					print'</ul>';
					print'</div>';
					//Пагинация
			}else//если меньше 10
		   	{	
				  	$search = $_GET['search'];
					$db_referal = pg_query($connect, "SELECT  *	FROM vkr_works where subject  ilike '%$search%' ");
				   		//print $row[1];$col=0;
					print '<p class="page-header" align="center">Результатов: <b>'.$col.'</b> </p>';
				while ($row2=pg_fetch_row($db_referal))
				{	
					print '<div class="result_div" align="center">';
					print '<a href="modul/open.php?id='.$row2[0].'"><h4 class="page-header" align="center">'.$row2[1].'</h4></a>	';
					//print' <h3 class="page-header" align="center">Добавление пользователя</h3>';
					print '<p style="font-size: 17px;color:#160909;" align="left"><b>Автор:</b> '.$row2[2].'</p>';
					print '<p style="font-size: 17px;color:#160909;" align="left"><b>Группа:</b> '.$row2[5].'</p>';
					print '<p style="font-size: 17px;color:#160909;" align="left"><b>Год:</b> '.$row2[13].'</p>';
					print '<div align="right">
					 
					 <button type="submit" class="save_button"><span class="glyphicon glyphicon-save"></span> Скачать</button>
					</div>
	';
					
														
					print '</div>';
					print'</br>';
				}		
		 	} 
		}
	}	
	?>
	 <!-- <div class="tabs">
	 			<ul class="nav nav-tabs nav-justified">
	 			  <li class="active"><a href="#tab-3-1" data-toggle="tab" >Фильтр №1</a></li>
	 			  <li><a href="#tab-3-2" data-toggle="tab" >Фильтр №2</a></li> 
	 			  <li><a href="#tab-3-3" data-toggle="tab" >Фильтр №3</a></li>
	 			</ul>	
	 		</div>/tabs in 3
	 
	 		<div class="tab-content">
	 			
	 				  <div class="tab-pane fade " id="tab-3-1">
	 				  <form action="index.php" method="GET" >
	 					<input type="text" name="1">
	 					<input type="submit" name="ok" value="click">
	 					</form>
	 				  </div>
	 
	 				  <div class="tab-pane fade " id="tab-3-2">
	 				  <form action="index.php" method="GET" >
	 				 	 <input type="text" name="2">
	 				 	 <input type="submit" name="ok" value="click">
	 					</form>
	 		 		  </div>
	 				  
	 				  <div class="tab-pane fade " id="tab-3-3">
	 				  <form action="index.php" method="GET" >
	 					<input type="text" name="3">
	 					<input type="submit" name="ok" value="click">
	 					</form>
	 				  </div>
	 			
	 		  </div>
	 	</div>
	 </div> -->
     
    

  









</body>
</html>


