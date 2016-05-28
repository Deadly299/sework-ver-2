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
					  departments(id_from_edu_base,name_dep, date_create, toparent) 
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


	   $result_d = pg_query($connect, "SELECT  *FROM departments WHERE  change_history IS NULL AND date_expiration IS NULL  ORDER BY id_from_edu_base ");

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
			$number_d_m++;
		  } //Заполняю массив из mysql


		$raz_index_1 = array_diff($mass_d_id, $mass_d_id_m);
		$raz_index_2 = array_diff($mass_d_id_m, $mass_d_id);
		$merge_mass_id = array_merge($raz_index_1, $raz_index_2);
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
					$result = pg_query($connect, "SELECT  *FROM faculties WHERE change_history IS NULL AND date_expiration IS NULL AND id_from_edu_base =$toparent");
				  $row_2=pg_fetch_row($result);
				  $id_fs = $row_2[0];
					$result = pg_query($connect, "INSERT INTO departments(id_from_edu_base,name_dep, date_create, toparent,id_fac)
				VALUES ($id,'$name','$date_today',$toparent,$id_fs);");
			   
					
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
			  $result_d = pg_query($connect, "SELECT  *FROM departments WHERE  change_history IS NULL AND date_expiration IS NULL AND $zapros  ORDER BY id_from_edu_base ");
			}
		  while ($row_psql_d=pg_fetch_row($result_d))
		  {
			$mass_d_id = $row_psql_d[1];//массив с ID
			$update_user = pg_query($connect,"UPDATE departments SET 
			  date_expiration = '$date_today'
			  WHERE id_from_edu_base = $mass_d_id
			  ");
			$col_del++;
		  }

		 } //Конец удаления 
 //Изменения
$col_up = 0;
$result_d_up = pg_query($connect, "SELECT  *FROM departments WHERE  change_history IS NULL AND 	 date_expiration IS NULL  ORDER BY id_from_edu_base ");
		 $s=1;
		  while ($row_psql_d_up = pg_fetch_row($result_d_up))
		  {
			 $mass_d_up = $row_psql_d_up;//массив с ID
			 $id = $mass_d_up[7];
			 
			 //print 'pg: '.$mass_d_up[2].'-------';
			  

			  /*$check_status = pg_query($connect, "SELECT  *FROM faculties WHERE id=$id ");
			  $row=pg_fetch_row($check_status);*/
			  
			 //print 'my: '.$mass_d_m[$s][1].'-------';
			 //print 'pd: '.$mass_d_up[2].'-------<br>';
			  $id_f = $mass_d_up[7];
		 if($id_f!='')
		  {
			  
			  $new_toparent = $mass_d_up[6];
			  $result = pg_query($connect, "SELECT  *FROM faculties WHERE change_history IS NULL AND date_expiration IS NULL AND id_from_edu_base =$new_toparent");
			  $row_2=pg_fetch_row($result);
			  
			  if($row_2[0]!=$id AND $mass_d_up[2] == $mass_d_m[$s][1])
			  {
			  	if($mass_d_m[$s][0]!='')
			  	{
				  	$x = $mass_d_up[0];
				  	$new_id = $mass_d_up[1];
				  	$new_name = $mass_d_m[$s][1];
				  	
				  	$id_fs= $row_2[0];
				  	$update_user = pg_query($connect,"UPDATE departments SET 
				  date_expiration = '$date_today'
				  WHERE id = $x
				  ");
				  $result = pg_query($connect, "INSERT INTO departments(id_from_edu_base,name_dep, date_create, toparent,id_fac)
					VALUES ($new_id,'$new_name','$date_today',$new_toparent,$id_fs);");
				   $col_up++;
				}
				else
				{
					$x = $mass_d_up[0];		  	
				  	$id_fs= $row_2[0];
				  	$update_user = pg_query($connect,"UPDATE departments SET 
				  date_expiration = '$date_today'
				  WHERE id = $x
				  ");
				  	$col_up++;
				}
			  }
			  else if($row_2[0]!=$id AND $mass_d_up[2] != $mass_d_m[$s][1])
			  {$x = $mass_d_up[0];
			  	$new_id = $mass_d_up[1];
			  	$new_name = $mass_d_m[$s][1];
			  	
			  	$id_fs= $row_2[0];
			  	$update_user = pg_query($connect,"UPDATE departments SET 
			  date_expiration = '$date_today'
			  WHERE id = $x
			  ");
			  $result = pg_query($connect, "INSERT INTO departments(id_from_edu_base,name_dep, date_create, toparent,id_fac)
				VALUES ($new_id,'$new_name','$date_today',$new_toparent,$id_fs);");
			   $col_up++;
			  }
			  else if($row_2[0]!=$id )
			  {
			  		$new_id = $mass_d_up[1];
			  $new_name = $mass_d_m[$s][1];
			  $new_toparent = $mass_d_up[6];
			  $id_f = $mass_d_up[7];

			  $update_user = pg_query($connect,"UPDATE departments SET 
			  change_history = $new_id
			  WHERE id_from_edu_base = $new_id
			  ");
			  $result = pg_query($connect, "INSERT INTO departments(id_from_edu_base,name_dep, date_create, toparent)
				VALUES ($new_id,'$new_name','$date_today',$new_toparent);");
				 $col_up++;	
			  
			  }
			  else if($mass_d_up[2] != $mass_d_m[$s][1] )
			  {
				  $new_id = $mass_d_up[1];
				  $new_name = $mass_d_m[$s][1];
				  $new_toparent = $mass_d_up[6];
				  $id_f = $mass_d_up[7];
				  $x = $mass_d_up[0];

				  $update_user = pg_query($connect,"UPDATE departments SET 
				 change_history = $new_id
				  WHERE id = $x
				  ");
				  $result = pg_query($connect, "INSERT INTO departments(id_from_edu_base,name_dep, date_create, toparent)
					VALUES ($new_id,'$new_name','$date_today',$new_toparent);");
				  $col_up++;	
			  
			  }
			}
			$s++;



			
		  }

		  return $arrayDep = array('1' => $col_add,'2' => $col_del,'3' => $col_up );


}
 ?>