<?php
if(!empty($_GET['query']))
{
    $query = (string)$_GET['query'];
    $array = array();
    //$array[] = $query;
   
 	$connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
	$db_referal = pg_query($connect, "SELECT  subject 	FROM vkr_works where subject  ilike '%$query%' LIMIT 20 ");


	while ($row=pg_fetch_row($db_referal))
	{
   		$array[] = $row[0];
   		
  	}
  	
   echo "['".implode("','", $array)."']";
   		
   
}
exit();
	


/*
$connect= pg_connect("host=localhost port=5432 dbname=sework user=postgres password=postgres");//делаем запрос на товары этой категории

$referal = trim(strip_tags(stripcslashes(htmlspecialchars($_POST["referal"]))));

$db_referal = pg_query($connect, "SELECT  *FROM tamplate_vkr where subject  ilike '%$referal%' LIMIT 5 ");


	   print'<h3>Результат поиска</h3>';
	while ($row=pg_fetch_row($db_referal))
	{
	
			print'
<div class="panel panel-default">
	<div class="panel-heading">
   		 <h3 class="panel-title"><a href="modul/open.php?id='.$row[0].'">'.$row[2].'</a></h3>
  	</div>
  	<div class="panel-body">
   		Кафедра: '.$row[1].' Автор: '.$row[5].' 
  	</div>
</div>';

}

		 
*/
	
	



	
	
	
	

