<?php 
include("security/control.php");
include("../layaut/header.php");
//include("function/db_connection.php");
  
 ?>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header" align="center">Администрирование</h1>

          <div class="row placeholders">

<!-- ///////////////////////////////////////////////////////////////////////////////////////// -->

    <?php
  /*  $connect= pg_connect("host=localhost port=5432 dbname=sework user=postgres password=postgres");
       $result_f = pg_query($connect, "SELECT  *FROM faculties WHERE  change_history IS NULL ORDER BY id_from_edu_base ");
        $number_f=1;
        //$mass_f=array();
        while ($row_psql_f=pg_fetch_row($result_f))
        {
        	 $mass_f[$number_f] = $row_psql_f;
        	
        	$number_f++;
        }//Заполняю массив и факультетами, без историй 

       $result_d = pg_query($connect, "SELECT  *FROM departments WHERE  change_history IS NULL ORDER BY id_from_edu_base ");
        $number_d=1;
        //$mass_f=array();
        while ($row_psql_d=pg_fetch_row($result_d))
        {
          
         $mass_d[$number_d] = $row_psql_d;
         $number_d++;
        }//Заполняю массив и кафедрами, без историй 
       
       

        $host='localhost'; // имя хоста (уточняется у провайдера)
        $database='kontract'; // имя базы данных, которую вы должны создать
        $user='root'; // заданное вами имя пользователя, либо определенное провайдером
        $pswd='max_ddlol'; // заданный вами пароль
         
        $dbh = mysql_connect($host, $user, $pswd) or die("Не могу соединиться с MySQL.");
        mysql_query("SET NAMES utf8");
        mysql_select_db($database) or die("Не могу подключиться к базе.");

        $query = "SELECT * FROM `faculties`";
        $res = mysql_query($query);
        $id_m = 1;
        $col_d = 0;
        while($row_mysql = mysql_fetch_array($res))
        {
        	$id_mysql= $row_mysql['id'];
          	$name_mysql= $row_mysql['name'];
          	if(isset($mass_f[$id_m][0])AND isset($mass_f[$id_m][1]))
          	 {
	             $id_t= $mass_f[$id_m][0];
          	     $id_c= $mass_f[$id_m][1]; 	
          	 }
          	
          	//print 'id-mysql'.$row_mysql['id'].'---'; 
	         // 	print 'id-pgsql'.$mass_f[$id_m][1].'</br>';  
          if(isset($mass_f[$id_m][1]))
          {
          	if ($mass_f[$id_m][1]==$row_mysql['id'] AND $mass_f[$id_m][2]!=$row_mysql['name'] AND $mass_f[$id_m][3] ==''   )//Условие если изменилось название факльтета
          	{
	          	print 'Обновился'.'</br>'; 
	          	print 'id-mysql'.$row_mysql['id'].'</br>'; 
	          	print 'id-pgsql'.$mass_f[$id_m][1].'</br>';  
	          	print 'id'.$id_t.'</br>';
	          	print '-------------------------------------------</br>';
	          	
				$update_user = pg_query($connect,"UPDATE faculties SET 
				change_history =$id_c
				WHERE id = $id_t
				");
				
          		$result = pg_query($connect, "INSERT INTO faculties(id_from_edu_base,name_fac)
        		VALUES ($id_mysql,'$name_mysql');");	
          		
          	}

          }
          else
          {
          		
          		
          		$col_d++;
          		$result = pg_query($connect, "INSERT INTO faculties(id_from_edu_base,name_fac)
        VALUES ($id_mysql,'$name_mysql');");
          	
          	


          }
          $id_m++;
        }

        ///////////////////////////////////////////////////
         $query = "SELECT * FROM `departments`";
        $res = mysql_query($query);
        $id_m = 1;
        $col_f=0;
        while($row_mysql_d = mysql_fetch_array($res))
        {
        	 $id_mysql= $row_mysql_d['id'];
          	 $name_mysql= $row_mysql_d['name'];
          	 $toparent_mysql= $row_mysql_d['toparent'];
          	 if(isset($mass_d[$id_m][0])AND isset($mass_d[$id_m][1]))
          	 {
	             $id_t= $mass_d[$id_m][0];
	          	 $id_c= $mass_d[$id_m][1];  	
          	 }
          	//print 'id-mysql'.$row_mysql_d['id'].'---'; 
	         // 	print 'id-pgsql'.$mass_d[$id_m][1].'</br>';  
          if(isset($mass_d[$id_m][1]))
          {
          	if ($mass_d[$id_m][1]==$row_mysql_d['id'] AND $mass_d[$id_m][2]!=$row_mysql_d['name'] AND $mass_d[$id_m][3] ==''   )
          	{
	          	print 'Обновился'.'</br>'; 
	          	print 'id-mysql'.$row_mysql_d['id'].'</br>'; 
	          	print 'id-pgsql'.$mass_d[$id_m][1].'</br>';  
	          	print 'id'.$id_t.'</br>';
	          	print '-------------------------------------------</br>';
	          	
				$update_user = pg_query($connect,"UPDATE departments SET 
				change_history =$id_c
				WHERE id = $id_t
				");
				
          		$result = pg_query($connect, "INSERT INTO departments(id_from_edu_base,name_dep)
        		VALUES ($id_mysql,'$name_mysql');");	
          		
          	}

          }
          else
          {
          		
          		$col_r++;
          		$result = pg_query($connect, "INSERT INTO departments(id_from_edu_base,name_dep,toparent)
        		VALUES ($id_mysql,'$name_mysql',$toparent_mysql)");
          	
          	


          }
          $id_m++;
        }

        print '<h3> Добавленно факультетов: '.$col_f.'</h3>';
        print '<h3> Добавленно кафедр: '.$col_d.'</h3>';

       /*$result = pg_query($connect, "INSERT INTO faculties('id_from_edu_base,name_fac,change_history)
        VALUES ('$row['id']', '$row['name']') WHERE id =''");*/

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

        $query = "SELECT * FROM `faculties`"; $res = mysql_query($query);
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
                    $result = pg_query($connect, "INSERT INTO faculties(id_from_edu_base,name_fac) VALUES ($id,'$name');");
                    $col_add++;
                  }
                }                
            }

          }
     
        } //КОНЕЦ Добавление

        $zapros='';//удаление/update 
        $i=0;
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
             print $mass_f_id = $row_psql_f[1];//массив с ID

             
            $update_user = pg_query($connect,"UPDATE faculties SET 
              date_expiration = '$date_today'
              WHERE id_from_edu_base = $mass_f_id
              ");
          
          }

         } //Конец удаления 
          




//        print '<h4 align="left">Новых факультетов: '.$col_add.'</h4>';


        //print_r($raz_index);
        /*if($number_f_m >= $number_f)
        {
          $priority_n = 'mysql- '.$number_f_m;
        } 
          else $priority_n = 'pgsql- '.$number_f;
          
        print '<h3> Цикл строиться по: '.$priority_n.'</h3>';*/
        /* ///////////Условия/////////////Условия/////////////Условия/////////////Условия/////////////Условия*/






       /*$result = pg_query($connect, "INSERT INTO faculties('id_from_edu_base,name_fac,change_history)
        VALUES ('$row['id']', '$row['name']') WHERE id =''");*/
    ?>


<!-- ///////////////////////////////////////////////////////////////////////////////////////// -->
          </div>
          
          <div class="table-responsive">
           
			
          </div>
        </div>
      </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
 
  </body>
</html>
