<?php

if(!empty($_POST['sort_s']) and !empty($_POST['tag']))
{
    print $tag = $_POST['tag']; 
    $sort_s = $_POST['sort_s']; 
	$arrayFilter = array('0' => 'subject','1' => 'executor', '2' => 'date_def',
								     '3' => 'groups', '4' => 'Нормаконтролер' , '4' => 'Консультант'
								     , '5' => 'Зав.кафедрой', '6' => 'Научный руководитель' );
   print $as = $arrayFilter[$tag];
 	$connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
	$db_referal = pg_query($connect, "SELECT  * FROM vkr_works where subject  ilike '%$sort_s%' ORDER BY $as ");

while ($row2=pg_fetch_row($db_referal))
				{	
				  $text=$row2[1]; 
				 
				  $text=str_replace($sort_s,'<b style="color:yellow;">'.$sort_s.'</b>',$text); 
				  //////////////////////////////////////////////////
					print '<div class="result_div" align="center">';
					print '<a href="modul/open.php?id='.$row2[0].'"><h4 class="page-header" align="center">'.$text.'</h4></a>	';
					//print' <h3 class="page-header" align="center">Добавление пользователя</h3>';
					print '<p align="left"><b>Автор:</b> '.$row2[2].'</p>';
					print '<p align="left"><b>Группа:</b> '.$row2[5].'</p>';
					print '<p align="left"><b>Год:</b> '.$row2[13].'</p>';
					print '<div align="right">
					 
					 <button type="submit" class="save_button"><span class="glyphicon glyphicon-save"></span> Скачать</button>
					</div>
					</div>
						';
					
														
					
					print'</br>';
				}		
   
   		
   
}




exit;
 ?>