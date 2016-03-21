
<?php
	$connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
	
	if(isset($_POST['id']) and isset($_POST['type']))
	{
 
		if($_POST['id']=='')
		{

		}
		else
		{
			$id =$_POST['id'];	
			$type =$_POST['type'];

			switch ($type) 
			{

				case 'true':
					$type = 1;
					break;
				
				case 'false':
					$type = 0;
					break;
			}
			$result2 = pg_query($connect, "SELECT  *FROM departments WHERE id_fac='$id'");
			print'<h4>Выберите специальность</h4><br>';
			print'<select id="id_spec">
				<option value=""></option>';

			$connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
			   $result2 = pg_query($connect, "SELECT  id,value,id_fac FROM code_okso WHERE id_fac=$id");

				   while ($row2=pg_fetch_row($result2))
					{	
					      print "<option value=".$row2[0].">";
					        print $row2[1];
					      print"</option>";					  
		   			}
			    
				  print'</select>';
			    /*  print '<option value="1">';
			        print 'ПиВэ';
			      print'</option>';
			      print '<option value="2">';
			        print 'ПОВТ';
			      print'</option>';
			      print '<option value="3">';
			        print 'ПИВО';
			      print'</option>';
			    */
		
			
   			
 
		}


	}

/*	if(isset($_POST['id_spec']))

	{	
				//print''.$row2[1].' <a href="load_work.php?id_spec='.$row2[0].'" target="_blank">Выбрать</a>	';
				print'<h4>Fd</h4>';

			print'<select id="id_kurs">
				<option value=""></option>';
			    
			      print '<option value="1">';
			        print 'ПиВэ';
			      print'</option>';
			      print '<option value="2">';
			        print 'ПОВТ';
			      print'</option>';
			      print '<option value="3">';
			        print 'ПИВО';
			      print'</option>';
			    
				  print'</select>';
				  
   			
	}*/

	if(isset($_POST['id_spec']))

	{	
			print'<h4>Выберите курс</h4><br>';
			print'<select id="id_kurs">';
			      print '<option value="1">';
			        print '1-й курс';
			      print'</option>';
			      print '<option value="2">';
			        print '2-й курс';
			      print'</option>';
			      print '<option value="3">';
			        print '3-й курс';
			      print'</option>';
			      print '<option value="4">';
			        print '4-й курс';
			      print'</option>';
			      print '<option value="5">';
			        print '5-й курс';
			      print'</option>';
			    
				  print'</select>';
				  
   			
	}


	if(isset($_POST['id_kurs']))

	{	
				//print''.$row2[1].' <a href="load_work.php?id_spec='.$row2[0].'" target="_blank">Выбрать</a>	';
				$kurs=$_POST['id_kurs'];
			print'<h4>Выберите группу</h4><br>';

				print'<select id="id_group">
				<option value=""></option>';

				$connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
			   	$result2 = pg_query($connect, "SELECT  id,name_g,kurs FROM groups WHERE kurs='$kurs'");

				   while ($row2=pg_fetch_row($result2))
					{	
					      print "<option value=".$row2[2].">";
					        print $row2[1];
					      print"</option>";					  
		   			}
			    
				  print'</select>';
					

			
			/*print'<select id="id_group">';
	
			      print '<option value="1">';
			        print '384';
			      print'</option>';
			      print '<option value="2">';
			        print '382';
			      print'</option>';
			      print '<option value="3">';
			        print '381';
			      print'</option>';
			    
				  print'</select>';*/
	}
	

		
		if(isset($_POST['id_group']))

	{	
				//print''.$row2[1].' <a href="load_work.php?id_spec='.$row2[0].'" target="_blank">Выбрать</a>	';

				  
			switch ($_POST['id_group']) 
			{
				case '1':
					print'<h3><a href="load_work.php?open=1">Добавить</a></h3>';
					break;
				
				case '2':
					print'<h3><a href="load_work.php?open=1">Добавить</a></h3>';
					break;

				case '3':
				print'<h3><a href="load_work.php?open=1">Добавить</a></h3>';
				break;
			}
   			
	}
	
?>

