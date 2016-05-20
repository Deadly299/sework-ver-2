<?php
if(!empty($_POST['sort_s']) and !empty($_POST['tag']))
{
   $tag = $_POST['tag']; 
   $sort_s = $_POST['sort_s']; 

   
 	$connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
	$db_referal = pg_query($connect, "SELECT  subject FROM vkr_works where subject  ilike '%$tag%' ORDER BY date_def ");

while ($row2=pg_fetch_row($db_referal))
				{	
					print '<div class="result_div" align="center">';
					print '<a href="modul/open.php?id='.$row2[0].'"><h4 class="page-header" align="center">'.$row2[1].'</h4></a>	';
					//print' <h3 class="page-header" align="center">Добавление пользователя</h3>';
					print '<p align="left"><b>Автор:</b> '.$row2[2].'</p>';
					print '<p align="left"><b>Группа:</b> '.$row2[5].'</p>';
					print '<p align="left"><b>Год:</b> '.$row2[13].'</p>';
					print '<div align="right">
					 
					 <button type="submit" class="save_button"><span class="glyphicon glyphicon-save"></span> Скачать</button>
					</div>
						';
					
														
					print '</div>';
					print'</br>';
				}		
   
   		
   
}

	




 ?>