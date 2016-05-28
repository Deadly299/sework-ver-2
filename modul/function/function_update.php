<?php 

function Start_fac()
 {
		$connect= pg_connect("host=localhost port=5432 dbname=sework user=postgres password=postgres");
		$host='localhost'; // имя хоста (уточняется у провайдера)
		$database='kontract'; // имя базы данных, которую вы должны создать
		$user='root'; // заданное вами имя пользователя, либо определенное провайдером
		$pswd='max_ddlol'; // заданный вами пароль
		 
		$dbh = mysql_connect($host, $user, $pswd) or die("Не могу соединиться с MySQL.");
		mysql_query("SET NAMES utf8");
		mysql_select_db($database) or die("Не могу подключиться к базе.");



		  
	 
		 //КОНЕЦ Добавление

  $date_today = date("d/m/Y"); 
	  

  $chek_table = pg_query($connect, "SELECT  *FROM faculties"); $row_check_d = pg_fetch_row($chek_table);
  
  if($row_check_d =='')//Если в базе нету данных(перый запуск системы)
  {   
	$number_d_m=1;
	$check_d_m = "SELECT * FROM `faculties` ORDER BY id ASC"; $res = mysql_query($check_d_m);
	  while($check_row_mysql = mysql_fetch_array($res))
	  {
		
		$check_mass_d_m[$number_d_m] = $check_row_mysql;//массив весь
		$number_d_m++;
	  } //Заполняю массив из mysql
					

	$i=1;
	
	foreach ($check_mass_d_m as $key => $value) //Добавление
	{
	 
	  
				$id = $check_mass_d_m[$i]['id'];
				$name = $check_mass_d_m[$i]['name'];
				$short_name = $check_mass_d_m[$i]['shortname'];

					if($short_name!='')
					{
						$result = pg_query($connect, "INSERT INTO 
					  faculties(id_from_edu_base,name_fac, date_create,shortname) 
					  VALUES ($id,'$name','$date_today','$short_name');");
					}
					else
					{
						$result = pg_query($connect, "INSERT INTO 
					  faculties(id_from_edu_base,name_fac, date_create) 
					  VALUES ($id,'$name','$date_today');");
					}
				
				

			$i++;	  	

  } 

}

		  //return $arrayName = array('1' => $col_add,'2' => $col_del,'3' => $col_up );
		  if(isset($i))
		  {
			return $i;
		  }else return 'Нет';
		  

 }

 function Fun_upd_faculties()
 {
	 $connect= pg_connect("host=localhost port=5432 dbname=sework user=postgres password=postgres");
		$host='localhost'; // имя хоста (уточняется у провайдера)
		$database='kontract'; // имя базы данных, которую вы должны создать
		$user='root'; // заданное вами имя пользователя, либо определенное провайдером
		$pswd='max_ddlol'; // заданный вами пароль
		 
		$dbh = mysql_connect($host, $user, $pswd) or die("Не могу соединиться с MySQL.");
		mysql_query("SET NAMES utf8");
		mysql_select_db($database) or die("Не могу подключиться к базе.");


	   $result_f = pg_query($connect, "SELECT  *FROM faculties WHERE  change_history IS NULL AND date_expiration IS NULL  ORDER BY id_from_edu_base ");

		$number_f=1;
		$number_f_m=1;
		$date_today = date("d/m/Y");
		  while ($row_psql_f=pg_fetch_row($result_f))
		  {
			 $mass_f_id[$number_f] = $row_psql_f[1];//массив с ID
			 $mass_f[$number_f] = $row_psql_f;//массив весь
			 $number_f++;
		  } //Заполняю массив и факультетами, без историй 
		   $last_n = $mass_f_id[$number_f-1];

		$query = "SELECT * FROM `faculties` ORDER BY id ASC"; $res = mysql_query($query);
		  while($row_mysql = mysql_fetch_array($res))
		  {
			$mass_f_id_m[$number_f_m] = $row_mysql[0]; 
			$mass_f_m[$number_f_m] = $row_mysql;//массив весь
			$number_f_m++;
		  } //Заполняю массив из mysql
		  
		$raz_index_1 = array_diff($mass_f_id, $mass_f_id_m);
		$raz_index_2 = array_diff($mass_f_id_m, $mass_f_id);
		$merge_mass_id = array_merge($raz_index_1, $raz_index_2);
		//print_r($merge_mass_id);

	  
		$col_add = 0;
		foreach ($merge_mass_id as $key => $value) //Добавление
		{
		  if($value > $last_n)//добавление
		  {
			
	   
			for ($i=1; $i <= count($mass_f_id_m); $i++) 
			{ 
				if(isset($mass_f_m[$i]['id']))
				{
				  //print($mass_f_m[$i]['id']);
				  
				  if($mass_f_m[$i]['id'] == $value)
				  {
					$id = $mass_f_m[$i]['id'];
					$name = $mass_f_m[$i]['name'];

						if($mass_f_m[$i]['shortname']!='')
						{
							$shortname = $mass_f_m[$i]['shortname'];
							$result = pg_query($connect, "INSERT INTO faculties(id_from_edu_base,name_fac,date_create,shortname)
							VALUES ($id,'$name','$date_today','$shortname');");
							$col_add++;	
						}
						else
						{
							$result = pg_query($connect, "INSERT INTO faculties(id_from_edu_base,name_fac,date_create)
							 VALUES ($id,'$name','$date_today');");
							$col_add++;
							
						}
					
				  }
				}                
			}

		  }
	 
		} //КОНЕЦ Добавление

		$zapros='';//удаление/update 
		$i=0;
		$col_del = 0;
		foreach ($merge_mass_id as $key_s => $value_s)
		{
		  if($value_s <= $last_n)//добавление
		  {
			$merge_mass_id_sm[$i] =$value_s;
			$i++;
		  }
		}
		if(isset($merge_mass_id_sm))
		{
		  for ($i=0; $i < count($merge_mass_id_sm)-1; $i++) 
		  { 
			  if(count($merge_mass_id_sm)>=1)
			  {
				$zapros= $zapros.'id_from_edu_base = '.$merge_mass_id_sm[$i].' OR ';
			  }                       
		  }
			if(isset($merge_mass_id_sm[$i]))
			{
			  $zapros= $zapros.'id_from_edu_base = '.$merge_mass_id_sm[$i];
			  $result_f = pg_query($connect, "SELECT  *FROM faculties WHERE  change_history IS NULL AND date_expiration IS NULL AND $zapros  ORDER BY id_from_edu_base ");
			}
		  while ($row_psql_f=pg_fetch_row($result_f))
		  {
			$mass_f_id = $row_psql_f[1];//массив с ID
			$update_user = pg_query($connect,"UPDATE faculties SET 
			  date_expiration = '$date_today'
			  WHERE id_from_edu_base = $mass_f_id
			  ");
			$col_del++;
		  }

		 } //Конец удаления 
 //Изменения
$col_up = 0;
$result_f_up = pg_query($connect, "SELECT  *FROM faculties WHERE  change_history IS NULL AND date_expiration IS NULL  ORDER BY id_from_edu_base ");
		 $s=1;
		  while ($row_psql_f_up = pg_fetch_row($result_f_up))
		  {
			 $mass_f_up = $row_psql_f_up;//массив с ID

			 //print 'pg: '.$mass_f_up[2].'-------';
			 //print 'my: '.$mass_f_m[$s][1].'-------<br>';
			 if($mass_f_up[2] != $mass_f_m[$s][1])
			 {
			  $new_id = $mass_f_up[1];
			  $new_name = $mass_f_m[$s][1];
			  $update_user = pg_query($connect,"UPDATE faculties SET 
			  change_history = $new_id
			  WHERE id_from_edu_base = $new_id
			  ");

			  $result = pg_query($connect, "INSERT INTO faculties(id_from_edu_base,name_fac) VALUES ($new_id,'$new_name');");
			  $col_up++;
			  }
			$s++;
		  }

		  return $arrayFac = array('1' => $col_add,'2' => $col_del,'3' => $col_up );
		  

 }

 function Start_dep()
 {
		$connect= pg_connect("host=localhost port=5432 dbname=sework user=postgres password=postgres");
		$host='localhost'; // имя хоста (уточняется у провайдера)
		$database='kontract'; // имя базы данных, которую вы должны создать
		$user='root'; // заданное вами имя пользователя, либо определенное провайдером
		$pswd='max_ddlol'; // заданный вами пароль
		 
		$dbh = mysql_connect($host, $user, $pswd) or die("Не могу соединиться с MySQL.");
		mysql_query("SET NAMES utf8");
		mysql_select_db($database) or die("Не могу подключиться к базе.");



		  
	 
		 //КОНЕЦ Добавление

  $date_today = date("d/m/Y"); 
	  

  $chek_table = pg_query($connect, "SELECT  *FROM departments"); $row_check_d = pg_fetch_row($chek_table);
  
  if($row_check_d =='')//Если в базе нету данных(перый запуск системы)
  {   
	$number_d_m=1;
	$check_d_m = "SELECT * FROM `departments` ORDER BY id ASC"; $res = mysql_query($check_d_m);
	  while($check_row_mysql = mysql_fetch_array($res))
	  {
		
		$check_mass_d_m[$number_d_m] = $check_row_mysql;//массив весь
		$number_d_m++;
	  } //Заполняю массив из mysql
					

	$i=1;
	
	foreach ($check_mass_d_m as $key => $value) //Добавление
	{
	 
	  
				$id = $check_mass_d_m[$i]['id'];
				$name = $check_mass_d_m[$i]['name'];
				$toparent = $check_mass_d_m[$i]['toparent'];
				$short_name = $check_mass_d_m[$i]['shortname'];
				$chek_table_f = pg_query($connect, "SELECT  *FROM faculties WHERE id_from_edu_base =$toparent  ");
				$row_check_f = pg_fetch_row($chek_table_f);
				if($row_check_f!='')
				{
					$id_fac = $row_check_f[0];
					if($short_name!='')
					{
						$result = pg_query($connect, "INSERT INTO 
					  departments(id_from_edu_base,name_dep, date_create, toparent, id_fac,shortname) 
					  VALUES ($id,'$name','$date_today',$toparent, $id_fac,'$short_name');");
					}
					else
					{
						$result = pg_query($connect, "INSERT INTO 
					  departments(id_from_edu_base,name_dep, date_create,toparent,id_fac) 
					  VALUES ($id,'$name','$date_today',$toparent,$id_fac);");
					}
				}
				else
				{
					
					if($short_name!='')
					{
						$result = pg_query($connect, "INSERT INTO 
					  departments(id_from_edu_base,name_dep, date_create,toparent,shortname) 
					  VALUES ($id,'$name','$date_today',$toparent,'$short_name');");
					}
					else
					{
						$result = pg_query($connect, "INSERT INTO 
					  departments(id_from_edu_base,name_dep, date_create,toparent) 
					  VALUES ($id,'$name','$date_today',$toparent);");
					}
				}

			$i++;	  	

  } 

}

		  //return $arrayName = array('1' => $col_add,'2' => $col_del,'3' => $col_up );
		  
		if(isset($i))
		  {
			return $i;
		  }else return 'Нет';
  
 }
 function Fun_del_departments()
{
	$connect= pg_connect("host=localhost port=5432 dbname=sework user=postgres password=postgres");
		$host='localhost'; // имя хоста (уточняется у провайдера)
		$database='kontract'; // имя базы данных, которую вы должны создать
		$user='root'; // заданное вами имя пользователя, либо определенное провайдером
		$pswd='max_ddlol'; // заданный вами пароль
		 
		$dbh = mysql_connect($host, $user, $pswd) or die("Не могу соединиться с MySQL.");
		mysql_query("SET NAMES utf8");

		mysql_select_db($database) or die("Не могу подключиться к базе.");


	   $result_d = pg_query($connect, "SELECT  *FROM departments WHERE change_history IS NULL AND date_expiration IS NULL  ORDER BY id_from_edu_base ");

		$number_d=1;
		$number_d_m=1;
		$date_today = date("d/m/Y");
		  while ($row_psql_d=pg_fetch_row($result_d))
		  {
			 $mass_d_id[$number_d] = $row_psql_d[1];//массив с ID
			 $mass_d[$number_d] = $row_psql_d;//массив весь
			 $number_d++;
		  } //Заполняю массив и факультетами, без историй 
		   $last_n = $mass_d_id[$number_d-1];

		$query = "SELECT * FROM `departments` ORDER BY id ASC"; $res = mysql_query($query);
		  while($row_mysql = mysql_fetch_array($res))
		  {
			$mass_d_id_m[$number_d_m] = $row_mysql[0]; 
			$mass_d_m[$number_d_m] = $row_mysql;//массив весь
			$mass_d_m2[$number_d_m] = $row_mysql;
			$number_d_m++;
		  } //Заполняю массив из mysql


		$raz_index_1 = array_diff($mass_d_id, $mass_d_id_m);
		$raz_index_2 = array_diff($mass_d_id_m, $mass_d_id);
		$merge_mass_id = array_merge($raz_index_1, $raz_index_2);
		$merge_mass_id2 = $merge_mass_id;
		print_r($merge_mass_id);
		  

	  
		$zapros='';//удаление/update 
		$i=0;
		$col_del = 0;
		foreach ($merge_mass_id2 as $key_s => $value_s)
		{
		  if($value_s <= $last_n)//добавление
		  {
			$merge_mass_id_sm[$i] =$value_s;
			$i++;
		  }
		}
		if(isset($merge_mass_id_sm))
		{
			print_r($merge_mass_id_sm);
		  for ($i=0; $i < count($merge_mass_id_sm)-1; $i++) 
		  { 
			  if(count($merge_mass_id_sm)>=1)
			  {
				$zapros= $zapros.'id_from_edu_base = '.$merge_mass_id_sm[$i].' OR ';
			  }                       
		  }
			if(isset($merge_mass_id_sm[$i]))
			{
				//print $zapros;
			  $zapros= $zapros.'id_from_edu_base = '.$merge_mass_id_sm[$i];
			  $result_d = pg_query($connect, "SELECT  *FROM departments WHERE  change_history IS NULL AND date_expiration IS NULL AND $zapros  ORDER BY id_from_edu_base ");
			
		  while ($row_psql_d=pg_fetch_row($result_d))
		  {
		  	if($row_psql_d[5]=='')
		  	{
		  	print 'Да я ту был syka<br>';
			print $mass_d_id = $row_psql_d[0];//массив с ID
			$update_user = pg_query($connect,"UPDATE departments SET 
			  date_expiration = '$date_today'
			  WHERE id = $mass_d_id
			  ");
			$col_del++;
			}
		  }
		  }
		 } //Конец удаления 
 //Изменения
		 	
			
		



			
		  

		  return $col_del;
		  //return $arrayDep = array('1' => $col_add,'2' => $col_up);




}
function Fun_upd_departments()
{
		$connect= pg_connect("host=localhost port=5432 dbname=sework user=postgres password=postgres");
		$host='localhost'; // имя хоста (уточняется у провайдера)
		$database='kontract'; // имя базы данных, которую вы должны создать
		$user='root'; // заданное вами имя пользователя, либо определенное провайдером
		$pswd='max_ddlol'; // заданный вами пароль
		 
		$dbh = mysql_connect($host, $user, $pswd) or die("Не могу соединиться с MySQL.");
		mysql_query("SET NAMES utf8");
		mysql_select_db($database) or die("Не могу подключиться к базе.");


	   $result_d = pg_query($connect, "SELECT  *FROM departments WHERE change_history IS NULL AND date_expiration IS NULL  ORDER BY id_from_edu_base ");

		$number_d=1;
		$number_d_m=1;
		$date_today = date("d/m/Y");
		  while ($row_psql_d=pg_fetch_row($result_d))
		  {
			 $mass_d_id[$number_d] = $row_psql_d[1];//массив с ID
			 $mass_d[$number_d] = $row_psql_d;//массив весь
			 $number_d++;
		  } //Заполняю массив и факультетами, без историй 
		   $last_n = $mass_d_id[$number_d-1];

		$query = "SELECT * FROM `departments` ORDER BY id ASC"; $res = mysql_query($query);
		  while($row_mysql = mysql_fetch_array($res))
		  {
			$mass_d_id_m[$number_d_m] = $row_mysql[0]; 
			$mass_d_m[$number_d_m] = $row_mysql;//массив весь
			$mass_d_m2[$number_d_m] = $row_mysql;
			$number_d_m++;
		  } //Заполняю массив из mysql


		$raz_index_1 = array_diff($mass_d_id, $mass_d_id_m);
		$raz_index_2 = array_diff($mass_d_id_m, $mass_d_id);
		$merge_mass_id = array_merge($raz_index_1, $raz_index_2);
		$merge_mass_id2 = $merge_mass_id;
		//print_r($merge_mass_id);
		  

	  
		$col_add = 0;
		foreach ($merge_mass_id as $key => $value) //Добавление
		{
		  if($value > $last_n)//добавление
		  {
		
			for ($i=1; $i <= count($mass_d_id_m); $i++) 
			{ 
				if(isset($mass_d_m[$i]['id']))
				{
				  //print($mass_d_m[$i]['id']);
				  
				  if($mass_d_m[$i]['id'] == $value)
				  {
					$id = $mass_d_m[$i]['id'];
					$name = $mass_d_m[$i]['name'];
					$toparent = $mass_d_m[$i]['toparent'];
					$result = pg_query($connect, "SELECT  *FROM faculties WHERE change_history IS NULL AND date_expiration IS NULL AND id_from_edu_base =$toparent ORDER BY id_from_edu_base" );
				  $row_add_dep=pg_fetch_row($result);
				  $id_fs = $row_add_dep[0];
					$result = pg_query($connect, "INSERT INTO departments(id_from_edu_base,name_dep, date_create, toparent,id_fac)
				VALUES ($id,'$name','$date_today',$toparent,$id_fs);");
			   
					
					$col_add++;
				  }
				}                
			}

		  }
	 
		} //КОНЕЦ Добавление

		/*$zapros='';//удаление/update 
		$i=0;
		$col_del = 0;
		foreach ($merge_mass_id2 as $key_s => $value_s)
		{
		  if($value_s <= $last_n)//добавление
		  {
			$merge_mass_id_sm[$i] =$value_s;
			$i++;
		  }
		}
		if(isset($merge_mass_id_sm))
		{
			print_r($merge_mass_id_sm);
		  for ($i=0; $i < count($merge_mass_id_sm)-1; $i++) 
		  { 
			  if(count($merge_mass_id_sm)>=1)
			  {
				$zapros= $zapros.'id_from_edu_base = '.$merge_mass_id_sm[$i].' OR ';
			  }                       
		  }
			if(isset($merge_mass_id_sm[$i]))
			{
				//print $zapros;
			  $zapros= $zapros.'id_from_edu_base = '.$merge_mass_id_sm[$i];
			  $result_d = pg_query($connect, "SELECT  *FROM departments WHERE  change_history IS NULL AND date_expiration IS NULL AND $zapros  ORDER BY id_from_edu_base ");
			
		  while ($row_psql_d=pg_fetch_row($result_d))
		  {
		  	print 'Да я ту был syka<br>';
			print $mass_d_id = $row_psql_d[0];//массив с ID
			/*$update_user = pg_query($connect,"UPDATE departments SET 
			  date_expiration = '$date_today'
			  WHERE id = $mass_d_id
			  ");
			$col_del++;
		  }
		  }
		 }*/ 
		 //Конец удаления 
 //Изменения
		 	
$col_up = 0;
$result_d_up = pg_query($connect, "SELECT  *FROM departments WHERE  change_history IS NULL AND 	date_expiration IS NULL  ORDER BY id_from_edu_base ");
		 $s=1;
		  while ($row_psql_d_up = pg_fetch_row($result_d_up))
		  {
			  $mass_d_up = $row_psql_d_up;//массив с ID
			  $new_id = $mass_d_up[1];
			  $id_f = $mass_d_up[7];  
			  
			  $name_dep_mysql = $mass_d_m2[$s][1];
			  $new_toparent = $mass_d_up[6];
			 
			  
			  if($mass_d_up[2] != $mass_d_m2[$s][1] )
			  {	  
			  	print 'Да я тут был <br>';
			  	print 'mysql: '.$mass_d_m2[$s][1].'--- pgsql'.$mass_d_up[2];	
			  		  $new_id_from_edu = $mass_d_up[1];
					  $name_dep_mysql = $mass_d_m2[$s][1];
					  $new_toparent = $mass_d_up[6];
					  $id_f = $mass_d_up[7];
					  $x = $mass_d_up[0];
					  
			  	  if($mass_d_up[7]!='')
			  	  {
					  
					  
					  $update_user = pg_query($connect,"UPDATE departments SET 
					 change_history = $new_id_from_edu
					  WHERE id = $x
					  ");
					  $result = pg_query($connect, "INSERT INTO departments(id_from_edu_base,name_dep, date_create, toparent,id_fac)
						VALUES ($new_id_from_edu,'$name_dep_mysql','$date_today',$new_toparent, $id_f);");
					  $col_up++;	
				   }else
			  	  {
			  	  	 
					  $update_user = pg_query($connect,"UPDATE departments SET 
					 change_history = $new_id_from_edu
					  WHERE id = $x
					  ");
					  $result = pg_query($connect, "INSERT INTO departments(id_from_edu_base,name_dep, date_create, toparent)
						VALUES ($new_id_from_edu,'$name_dep_mysql','$date_today',$new_toparent);");
					  $col_up++;
			  	  }
			  	 
			  	  
			  
			  }

			  /*if($row_2	[3]!='')
			  {
				print 'Да Изменили';
					

			  $update_user = pg_query($connect,"UPDATE departments SET 
			  change_history = $new_id
			  WHERE id_from_edu_base = $new_id
			  ");
			  $result_new_d = pg_query($connect, "SELECT  *FROM faculties  WHERE  change_history IS NULL AND date_expiration IS NULL AND id_from_edu_base =$new_toparent");
				 $row_3=pg_fetch_row($result_new_d);
				 print $id_fac_new = $row_3[0];

			  $result = pg_query($connect, "INSERT INTO departments(id_from_edu_base,name_dep, date_create, toparent, id_fac_new)
				VALUES ($new_id,'$name_dep_mysql','$date_today',$new_toparent,$id_fac_new);");
				 $col_up++;	
			  }else if($row_2[5]!='')
			  {
				 
				$del = $mass_d_up[0];
				$delete_dep = pg_query($connect,"UPDATE departments SET 
				 date_expiration = '$date_today'
				  WHERE id = $del
				  ");
			  }

			 if($mass_d_up[2] != $mass_d_m[$s][1] )
			  {
				  $new_id = $mass_d_up[1];
				  $name_dep_mysql = $mass_d_m[$s][1];
				  $new_toparent = $mass_d_up[6];
				  $id_f = $mass_d_up[7];
				  $x = $mass_d_up[0];

				  $update_user = pg_query($connect,"UPDATE departments SET 
				 change_history = $new_id
				  WHERE id = $x
				  ");
				  $result = pg_query($connect, "INSERT INTO departments(id_from_edu_base,name_dep, date_create, toparent,id_fac)
					VALUES ($new_id,'$name_dep_mysql','$date_today',$new_toparent, $id_f);");
				  $col_up++;	
			  
			  }*/
			
			$s++;



			
		  }

		  //return $arrayDep = array('1' => $col_add,'2' => $col_del,'3' => $col_up );
		  return $arrayDep = array('1' => $col_add,'2' => $col_up);


}



function Start_spec()
 {
		$connect= pg_connect("host=localhost port=5432 dbname=sework user=postgres password=postgres");
		$host='localhost'; // имя хоста (уточняется у провайдера)
		$database='kontract'; // имя базы данных, которую вы должны создать
		$user='root'; // заданное вами имя пользователя, либо определенное провайдером
		$pswd='max_ddlol'; // заданный вами пароль
		 
		$dbh = mysql_connect($host, $user, $pswd) or die("Не могу соединиться с MySQL.");
		mysql_query("SET NAMES utf8");
		mysql_select_db($database) or die("Не могу подключиться к базе.");


  $date_today = date("d/m/Y"); 
  $chek_table = pg_query($connect, "SELECT  *FROM speciality"); $row_check_d = pg_fetch_row($chek_table);
  
  if($row_check_d =='')//Если в базе нету данных(перый запуск системы)
  {   
	$number_d_m=1;
	$check_d_m = "SELECT * FROM `spec` ORDER BY id ASC"; $res = mysql_query($check_d_m);
	  while($check_row_mysql = mysql_fetch_array($res))
	  {
		
		$check_mass_d_m[$number_d_m] = $check_row_mysql;//массив весь
		$number_d_m++;
	  } //Заполняю массив из mysql
					

	$i=1;
	
	foreach ($check_mass_d_m as $key => $value) //Добавление
	{
		$id = $check_mass_d_m[$i]['id'];
		$name = $check_mass_d_m[$i]['name'];

		$result = pg_query($connect, "INSERT INTO 
		speciality(id_from_edu_base,name_spec, date_create)	VALUES ($id,'$name','$date_today');");
		$i++;	  	

	} 

}

		  //return $arrayName = array('1' => $col_add,'2' => $col_del,'3' => $col_up );
		  if(isset($i))
		  {
			return $i;
		  }else return 'Нет';
		  

 }


function Fun_upd_speciality()
 {
	 $connect= pg_connect("host=localhost port=5432 dbname=sework user=postgres password=postgres");
		$host='localhost'; // имя хоста (уточняется у провайдера)
		$database='kontract'; // имя базы данных, которую вы должны создать
		$user='root'; // заданное вами имя пользователя, либо определенное провайдером
		$pswd='max_ddlol'; // заданный вами пароль
		 
		$dbh = mysql_connect($host, $user, $pswd) or die("Не могу соединиться с MySQL.");
		mysql_query("SET NAMES utf8");
		mysql_select_db($database) or die("Не могу подключиться к базе.");


	   $result_f = pg_query($connect, "SELECT  *FROM speciality WHERE  change_history IS NULL AND date_expiration IS NULL  ORDER BY id_from_edu_base ");

		$number_f=1;
		$number_f_m=1;
		$date_today = date("d/m/Y");
		  while ($row_psql_f=pg_fetch_row($result_f))
		  {
			 $mass_f_id[$number_f] = $row_psql_f[1];//массив с ID
			 $mass_f[$number_f] = $row_psql_f;//массив весь
			 $number_f++;
		  } //Заполняю массив и факультетами, без историй 
		   $last_n = $mass_f_id[$number_f-1];

		$query = "SELECT * FROM `spec` ORDER BY id ASC"; $res = mysql_query($query);
		  while($row_mysql = mysql_fetch_array($res))
		  {
			$mass_f_id_m[$number_f_m] = $row_mysql[0]; 
			$mass_f_m[$number_f_m] = $row_mysql;//массив весь
			$number_f_m++;
		  } //Заполняю массив из mysql
		  
		$raz_index_1 = array_diff($mass_f_id, $mass_f_id_m);
		$raz_index_2 = array_diff($mass_f_id_m, $mass_f_id);
		$merge_mass_id = array_merge($raz_index_1, $raz_index_2);
		//print_r($merge_mass_id);

	  
		$col_add = 0;
		foreach ($merge_mass_id as $key => $value) //Добавление
		{
		  if($value > $last_n)//добавление
		  {
			
	   
			for ($i=1; $i <= count($mass_f_id_m); $i++) 
			{ 
				if(isset($mass_f_m[$i]['id']))
				{
				  //print($mass_f_m[$i]['id']);
				  
				  if($mass_f_m[$i]['id'] == $value)
				  {
					$id = $mass_f_m[$i]['id'];
					$name = $mass_f_m[$i]['name'];
					$result = pg_query($connect, "INSERT INTO speciality(id_from_edu_base,name_spec,date_create)
					 VALUES ($id,'$name','$date_today');");
					$col_add++; 
				  }
				}                
			}

		  }
	 
		} //КОНЕЦ Добавление

		$zapros='';//удаление/update 
		$i=0;
		$col_del = 0;
		foreach ($merge_mass_id as $key_s => $value_s)
		{
		  if($value_s <= $last_n)//добавление
		  {
			$merge_mass_id_sm[$i] =$value_s;
			$i++;
		  }
		}
		if(isset($merge_mass_id_sm))
		{
		  for ($i=0; $i < count($merge_mass_id_sm)-1; $i++) 
		  { 
			  if(count($merge_mass_id_sm)>=1)
			  {
				$zapros= $zapros.'id_from_edu_base = '.$merge_mass_id_sm[$i].' OR ';
			  }                       
		  }
			if(isset($merge_mass_id_sm[$i]))
			{
			  $zapros= $zapros.'id_from_edu_base = '.$merge_mass_id_sm[$i];
			  $result_f = pg_query($connect, "SELECT  *FROM speciality WHERE  change_history IS NULL AND date_expiration IS NULL AND $zapros  ORDER BY id_from_edu_base ");
			
		  while ($row_psql_f=pg_fetch_row($result_f))
		  {
			$mass_f_id = $row_psql_f[1];//массив с ID
			$update_user = pg_query($connect,"UPDATE speciality SET 
			  date_expiration = '$date_today'
			  WHERE id_from_edu_base = $mass_f_id
			  ");
			$col_del++;
		  }
		  }

		 } //Конец удаления 
 //Изменения
$col_up = 0;
$result_f_up = pg_query($connect, "SELECT  *FROM speciality WHERE  change_history IS  NULL AND date_expiration IS  NULL  ORDER BY id_from_edu_base ");
		 $s=1;
		  while ($row_psql_f_up = pg_fetch_row($result_f_up))
		  {
			 $mass_f_up = $row_psql_f_up;//массив с ID

			 //print 'pg: '.$mass_f_up[2].'-------';
			 //print 'my: '.$mass_f_m[$s][1].'-------<br>';
			 if($mass_f_up[2] != $mass_f_m[$s][1])
			 {
			  $new_id = $mass_f_up[1];
			  $new_name = $mass_f_m[$s][1];
			  
			  $update_user = pg_query($connect,"UPDATE speciality SET 
			  change_history = $new_id
			  WHERE id_from_edu_base = $new_id
			  ");

			  $result = pg_query($connect, "INSERT INTO speciality(id_from_edu_base,name_spec,date_create) 
			  								VALUES ($new_id,'$new_name','$date_today');");
			  $col_up++;
			  }
			$s++;
		  }

		  return $arrayFac = array('1' => $col_add,'2' => $col_del,'3' => $col_up );
		  

 }

function Delete_fac_dep()
{
	$connect= pg_connect("host=localhost port=5432 dbname=sework user=postgres password=postgres");
		$host='localhost'; // имя хоста (уточняется у провайдера)
		$database='kontract'; // имя базы данных, которую вы должны создать
		$user='root'; // заданное вами имя пользователя, либо определенное провайдером
		$pswd='max_ddlol'; // заданный вами пароль
		 
		$dbh = mysql_connect($host, $user, $pswd) or die("Не могу соединиться с MySQL.");
		mysql_query("SET NAMES utf8");
		mysql_select_db($database) or die("Не могу подключиться к базе.");
		$number_d=1;
		$col_del=0;
		$date_today = date("d/m/Y");

	   $result_d = pg_query($connect, "SELECT  *FROM faculties WHERE change_history IS NULL AND date_expiration IS NOT NULL  ORDER BY id_from_edu_base ");
		  while ($row_psql_f=pg_fetch_row($result_d))
		  {
		  	 $mass_d_id = $row_psql_f[1];//массив с ID
			 $id_fac = $row_psql_f[0];//массив с ID
			 $result_ds = pg_query($connect, "SELECT  *FROM departments WHERE  change_history IS NULL AND date_expiration IS  NULL AND toparent = $mass_d_id ");
			 $row_psql_d=pg_fetch_row($result_ds);
			 
			 //var_dump($row_psql_d);
			 if($row_psql_d)
			 {
			 if($row_psql_d[5] =='')
			 {print 'wtf';

				$update_user = pg_query($connect,"UPDATE departments SET date_expiration = '$date_today'
		  		WHERE  toparent = $mass_d_id AND change_history IS NULL 
				  ");	
				$col_del++;  
			 }
			 }
			 /*
			 $update_user = pg_query($connect,"UPDATE departments SET 
			  date_expiration = '$date_today'
			  WHERE 
			  	toparent = $mass_d_id AND
			  	date_expiration IS NULL AND
			  	change_history IS NULL AND
			  	id_fac <> '$id_fac'
			  ");
			 
*/
			 $number_d++;
		  } //Заполняю массив и факультетами, без историй 
		   

	return $col_del;  
	
}

Function Upd_fac_dep()
{
	$connect= pg_connect("host=localhost port=5432 dbname=sework user=postgres password=postgres");
		$host='localhost'; // имя хоста (уточняется у провайдера)
		$database='kontract'; // имя базы данных, которую вы должны создать
		$user='root'; // заданное вами имя пользователя, либо определенное провайдером
		$pswd='max_ddlol'; // заданный вами пароль
		 
		$dbh = mysql_connect($host, $user, $pswd) or die("Не могу соединиться с MySQL.");
		mysql_query("SET NAMES utf8");
		mysql_select_db($database) or die("Не могу подключиться к базе.");
		$number_d=1;
		$col_up=0;
		$date_today = date("d/m/Y");

	   $result_d = pg_query($connect, "SELECT  *FROM faculties WHERE change_history IS NULL AND date_expiration IS NULL  ORDER BY id_from_edu_base ");
		  while ($row_psql_f=pg_fetch_row($result_d))
		  {
		  	 $mass_d_id = $row_psql_f[1];//массив с ID
			 $id_fac = $row_psql_f[0];//массив с ID
			 $result_ds = pg_query($connect, "SELECT  *FROM departments WHERE  change_history IS NULL AND date_expiration IS  NULL AND toparent = $mass_d_id ");
			 while($row_psql_d= pg_fetch_row($result_ds))
			 {
			 if($row_psql_d[7]!=$id_fac)
			 {
			 	
			 	$id = $row_psql_d[0];
			 	$id_from_edu_base = $row_psql_d[1];
			 	$name = $row_psql_d[2];
			 	$toparent = $row_psql_d[6];
				$update_user = pg_query($connect,"UPDATE departments SET change_history =$id_from_edu_base 
		  		WHERE  id =$id AND
		  				date_expiration IS NULL
				  ");	
				  $result = pg_query($connect, "INSERT INTO departments(id_from_edu_base,name_dep, date_create, toparent, id_fac)
						VALUES ($id_from_edu_base,'$name','$date_today',$toparent,$id_fac);");
				  $col_up++;
					
			 }
			}
			 
			 /*
			 $update_user = pg_query($connect,"UPDATE departments SET 
			  date_expiration = '$date_today'
			  WHERE 
			  	toparent = $mass_d_id AND
			  	date_expiration IS NULL AND
			  	change_history IS NULL AND
			  	id_fac <> '$id_fac'
			  ");
			 
*/
			 $number_d++;
		  } //
		  return $col_up;
}



 ?>