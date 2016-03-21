<?php
//include("security/control.php");	
require_once '../tcpdf/tcpdf.php'; // Подключаем библиотеку
if(isset($_GET['id']))
{
 	 $id = $_GET['id'];
 	 //$row = $_GET['row'];
 	$connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
	 $result_works = pg_query($connect,"SELECT  
 id,
subject, 
executor,
groups, 
date_def,
id_dep,
id_code,
id_qual,
id_head,
id_head_chair,
id_normal,
id_cons, 
sex, 
office,
id_template
 FROM  vkr_works where id=$id ");
    
    
    $mass_works = pg_fetch_row($result_works);// Запрос к выбраной работе
	
		//print_r($mass_works);exit();
	$result_tamplate = pg_query("SELECT * FROM templates WHERE id ='$mass_works[14]';");// Запрос к шаблону
		$mass_tamplate=pg_fetch_row($result_tamplate);
		//print_r($mass_works);exit;
	$html= strip_tags($mass_tamplate[2], '<p><a><colgroup><table><tbody><tr><td><b><strong><br>');

//-----------------------------------------------
	$result_departments = pg_query(" SELECT name_dep, abbreviation FROM departments WHERE id ='$mass_works[5]';");
		$mass_departments = pg_fetch_row($result_departments);

	$result_id_code = pg_query(" SELECT *FROM code_okso  WHERE id ='$mass_works[6]';");
		$mass_id_code = pg_fetch_row($result_id_code);

	$result_id_qual = pg_query(" SELECT name_qual, value FROM qualification  WHERE id ='$mass_works[7]';");
		$mass_id_qual = pg_fetch_row($result_id_qual);		

	$result_id_head = pg_query(" SELECT name_com, value FROM ped_composition WHERE id ='$mass_works[8]';");
		$mass_id_head = pg_fetch_row($result_id_head);	

	$result_id_head_chaid = pg_query(" SELECT name_com, value FROM ped_composition WHERE id ='$mass_works[9]';");
		$mass_id_head_chaid = pg_fetch_row($result_id_head_chaid);		
	
	$result_id_normal = pg_query(" SELECT name_com, value FROM ped_composition WHERE id ='$mass_works[10]';");
		$mass_id_normal = pg_fetch_row($result_id_normal);	

	$result_id_cons = pg_query(" SELECT * FROM consultants WHERE id ='$mass_works[11]';");
		$mass_id_cons = pg_fetch_row($result_id_cons);
 		
 		//$consultants = '<>';
		for ($i=1; $i <=4 ; $i++) 
		{ 
			if($mass_id_cons[$i] !='NULL')
			{


				$arrayCons[$i] = preg_replace('(:)' , '<br><b>' ,$mass_id_cons[$i]);	
				$arrayCons[$i] = $arrayCons[$i].'</b><br>';
			}else break;
			
		}
		switch (count($arrayCons)) 
		{
			case 1:
	$consultant =$arrayCons[1];
				break;
			
			case 2:
	$consultant =$arrayCons[1].$arrayCons[2];
				break;
			case 3:
	$consultant =$arrayCons[1].$arrayCons[2].$arrayCons[3];
				break;
			case 4:
	$consultant =$arrayCons[1].$arrayCons[2].$arrayCons[3].$arrayCons[4];
				break;
		}

		
	
//-----------------------------------------------

	$arrayTag = array(
	'1' =>'(ТЕМА)' ,'2' => '(ИСПОЛНИТЕЛЬ)' ,'3' => '(ГРУППА)','4' => '(ДАТАЗАЩИТЫ)',
	'5' => '(КАФЕДРА)','6' => '(КОДОКСО)','7' => '(КВАЛИФИКАФИЯ)','8' => '(РУКОВОДИТЕЛЬ)',
	'9' => '(ЗАВ.КАФЕДРЫ)' ,'10' => '(НОРМАКОНТРОЛЕР)' ,'11' => '(КОНСУЛЬТАНТЫ)' ,'12' => '(ПОЛ)','13' => '(ОТДЕЛЕНИЕ)','14'=>'(ДАТА)');
	for ($i=1; $i <= 3; $i++) 
	{ 
				//$html = str_replace($arrayTag[$i] , $mass_works[$i], $html);
				 $html = preg_replace($arrayTag[$i] , $mass_works[$i], $html);	
		//print $arrayTag[$i] .'-'. $mass_works[$i];
	} 


	$html = preg_replace($arrayTag[5] , $mass_departments[0], $html);
	$html = preg_replace($arrayTag[6] , $mass_id_code[1].' «'.$mass_id_code[2].'»', $html);
	$html = preg_replace($arrayTag[7] , $mass_id_qual[0], $html);
	$html = preg_replace($arrayTag[8] , $mass_id_head[1].'<br><b>'.$mass_id_head[0].'</b>', $html);
	$html = preg_replace($arrayTag[9] , $mass_id_head_chaid[1].'<br><b>'.$mass_id_head_chaid[0].'</b>', $html);
	$html = preg_replace($arrayTag[10] , $mass_id_normal[1].'<br><b>'.$mass_id_normal[0].'</b>', $html);
	$html = preg_replace($arrayTag[11] , $consultant, $html);
	if($mass_works[12]=='0')
	{
		 $html = preg_replace($arrayTag[12] , '', $html);
	}else  $html = preg_replace($arrayTag[12] , 'ка', $html);

	if($mass_works[13]=='0')
	{
		$html = preg_replace($arrayTag[13] , 'очного', $html);
	}else $html = preg_replace($arrayTag[13] , 'заочного', $html);
	
	 $d = substr($mass_works[4], 8, 10);
	 $m = substr($mass_works[4], 5, -3);
	 $g = substr($mass_works[4], 0, 4);

	$date_def ='«'.$d.'» '.$m.' '.$g.' год'; 
	$html = preg_replace($arrayTag[4] , $date_def, $html);
	$html = preg_replace($arrayTag[14] , $g, $html);
	//exit;
} elseif (isset($_GET['show'])) 
{
	 $show = $_GET['show'];
 	 //$row = $_GET['row'];
 	$connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");

	$result_tamplate = pg_query("SELECT id, name_tem, value FROM templates WHERE id ='$show';");// Запрос к шаблону
		$mass_tamplate=pg_fetch_row($result_tamplate);
		//print_r($mass_works);exit;
	$html= strip_tags($mass_tamplate[2], '<p><a><colgroup><table><tbody><tr><td><b><strong><br>');


}
else
{
	print'<div class="alert alert-success"> <h1 align="center"> ERROR 402</h1>	</div>';
    header( "Refresh:2; url=adminka.php", true, 303); 
    exit;
}	


	/*$connect= pg_connect("host=localhost port=5432 dbname=sework user=postgres password=postgres");
	$result2 = pg_query($connect, "SELECT  *FROM setting WHERE id ='$html'");
	$row2=pg_fetch_row($result2);
	$html= strip_tags($row2[2], '<p><a><colgroup><table><tbody><tr><td><b>');*/

//exit;

  	$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Pavel Archenkov');
	$pdf->SetTitle($mass_tamplate[1]);
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(true);

	//$pdf->AddPage();
	$pdf->SetTextColor(0, 0, 0); 
	$pdf->SetFont('dejavuserif', '', 10);
	//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	// $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$pdf->AddPage();
	$pdf->writeHTML($html, true, 0, true, 0);




	$pdf->Output('test.pdf','I');
?>
