<?php 

function Serch_string_html($html) /*Назначение этой функции- это узнать кол-во вводимых параметорв в шаблоне ВКР */
{
	//$html;
$col = 0;
		$html= strip_tags($html, '<p><a><colgroup><table><tbody><tr><td><b>');
        for ($i=1; $i < 20; $i++)
        { 
            
            $serch_string   = 'param'.$i.'.';//Увеличиваем №param на 1, для проверки на наличие
            $rezult_serch_string = strripos($html, $serch_string);//Поиск по шаблоны на наличие

            if ($rezult_serch_string == true) //Если такой параметр есть, то увеличиваем $col
            {
             	$col++;
             	//print $col;
            } 
        }
        	return $col;
}

?>
