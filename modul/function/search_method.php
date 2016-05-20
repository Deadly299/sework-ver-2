<?php 
function FuncSearch($search,$method)
{

    $connect = pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
    $db_referal = pg_query($connect, "SELECT  COUNT(subject) FROM vkr_works where subject  ilike '%$search%' ");
    $row_col = pg_fetch_row($db_referal);
    $col = $row_col[0];
         //$col Это кол-во записей в таблице.
    
        /*if($col > 10)
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
                print '<a href="modul/open.php?id='.$row[0].'"><h4 class="page-header" align="center">'.$row[2].'</h4></a>  ';
                //print' <h3 class="page-header" align="center">Добавление пользователя</h3>';
                print '<p align="left"><b>Автор:</b> '.$row[5].'</p>';
                print '<p align="left"><b>Кафедра:</b> '.$row[1].'</p>';
                print '<p align="left"><b>Группа:</b> '.$row[6].'</p>';
                print '<p align="left"><b>Год:</b> '.$row[18].'</p>';
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
        }else//если меньше 10*/
        {   
             
                 $arrayFilter = array('1' => 'Название работы', '2' => 'Автор работы',
                                 '3' => 'Дата создания', '4' => 'Группа' , '5' => 'Нормаконтролер'
                                 , '6' => 'Зав.кафедрой', '7' => 'Научный руководитель', '8' => 'факультет',
                                  '9' => 'Кафедра', '10' => 'Специальность' );
                $db_referal = pg_query($connect, "SELECT  * FROM vkr_works where subject  ilike '%$search%' ");
                    //print $row[1];$col=0;
                print '<h4 class="page-header" align="center">Сортировка </h4><br>';
                print'<div class="filter">
                          <div class="box"><form id="form">';
                            for ($x=1; $x <=8 ; $x++) 
                            { 
                                print'<div class="box-filter"><input type="button" name="n" class="but-1"
                                 value="'.$arrayFilter[$x].'"> <form> </div>';
                            }
                          print'</div>
                        </div><br>';
                




                print '<p class="page-header" align="center">Результатов: <b>'.$col.'</b> </p>';
                print'<div class="a">';
///////////////////////////////////
$connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");

//SELECT * FROM pages WHERE id IN(".implode(',',$pages_id).")


    $search = $_GET['search'];
    $search = explode(" ", $search);//Массив со словами

    $object_search = $_GET['object_search'];
    switch ($object_search) 
    {
        case '1':
          $object_search_n ='subject';
        break;
        case '2':
          $object_search_n ='executor';  
        break;
        case '3':
          $object_search_n ='date_def';
        break;
        case '4':
          $object_search_n ='faculty';
        break;
        case '5':
          $object_search_n ='Дате';
        break;
        case '6':
          $object_search_n ='Дате';
        break;
        case '7':
          $object_search_n ='Дате';
        break;
    }
    
   

    $result_v = array ();
for ($i=0; $i <= count($search)-1; $i++) 
{ 
    $select_s = pg_query($connect, "SELECT * FROM vkr_works
    WHERE $object_search_n iLIKE '%$search[$i]%' ");
    $b=0;
    while ($row_s=pg_fetch_row($select_s))
    {
     $array_s ='ide-'.$row_s[0].' : Имя-'.$row_s[2].' ------Работа///////'. $row_s[1].'<br>';
      $array_w[$b]=$row_s[0];

     $b++;
    }
   $result_v = array_merge ($result_v, $array_w);
    
}
 $result_v = array_count_values($result_v);
 arsort($result_v); 
$o = 0;
foreach ($result_v as $key => $value) 
{
   $array_new[$o]=$key;
   $o++;
}

for ($h=0; $h < count($array_new); $h++) 
{ 
    $id = (int) $array_new[$h];
   $selects = pg_query($connect, "SELECT * FROM vkr_works WHERE id =$id  ");

    while ($row_e=pg_fetch_row($selects))
    {

     switch ($object_search) 
    {
        case '1':
                $text = $row_e[$object_search];//название темы 
         
             $n=0;

             foreach ($search as $key => $value) 
             {
                //print_r($search[$n]);
                 
                 $text = preg_replace('('.$value.')iu','<b style="color:yellow;">'.$value.'</b>',$text).'<br>';
                 
                 $n++;
             }
                
                
                print'<div class="sort_result"></div>';
                print '<div class="result_div" align="center">';
                print '<a href="modul/open.php?id='.$row_e[0].'"><h4 class="page-header" align="center">'.$text.'</h4></a>   ';
                //print' <h3 class="page-header" align="center">Добавление пользователя</h3>';
                print '<p align="left"><b>Автор:</b> '.$row_e[2].'</p>';
                print '<p align="left"><b>Группа:</b> '.$row_e[5].'</p>';
                print '<p align="left"><b>Год:</b> '.$row_e[13].'</p>';
                print '<div align="right">
                 
                 <button type="submit" class="save_button"><span class="glyphicon glyphicon-save"></span> Скачать</button>
                </div>
            ';
                
                                                    
                print '</div>';
                print'</br>';
            break;
        case '2':
                $text = $row_e[$object_search];//название темы 
             $n=0;
             foreach ($search as $key => $value) 
             {
                //print_r($search[$n]);
                 
                 $text = preg_replace('('.$value.')iu','<b style="color:yellow;">'.$value.'</b>',$text).'<br>';
                 
                 $n++;
             }
                
                
                print'<div class="sort_result"></div>';
                print '<div class="result_div" align="center">';
                print '<a href="modul/open.php?id='.$row_e[0].'"><h4 class="page-header" align="center">'.$row_e[1].'</h4></a>   ';
                //print' <h3 class="page-header" align="center">Добавление пользователя</h3>';
                print '<p align="left"><b>Автор:</b> '.$text.'</p>';
                print '<p align="left"><b>Группа:</b> '.$row_e[5].'</p>';
                print '<p align="left"><b>Год:</b> '.$row_e[13].'</p>';
                print '<div align="right">
                 
                 <button type="submit" class="save_button"><span class="glyphicon glyphicon-save"></span> Скачать</button>
                </div>
            ';
                
                                                    
                print '</div>';
                print'</br>';
            break;
        case '3':
                print $text = $row_e[$object_search];//название темы 
                
             $n=0;

             foreach ($search as $key => $value) 
             {
                //print_r($search[$n]);
                 
                 $text = preg_replace('('.$value.')iu','<b style="color:yellow;">'.$value.'</b>',$text).'<br>';
                 
                 $n++;
             }
                
                
                print'<div class="sort_result"></div>';
                print '<div class="result_div" align="center">';
                print '<a href="modul/open.php?id='.$row_e[0].'"><h4 class="page-header" align="center">'.$text.'</h4></a>   ';
                //print' <h3 class="page-header" align="center">Добавление пользователя</h3>';
                print '<p align="left"><b>Автор:</b> '.$row_e[2].'</p>';
                print '<p align="left"><b>Группа:</b> '.$row_e[5].'</p>';
                print '<p align="left"><b>Год:</b> '.$row_e[13].'</p>';
                print '<div align="right">
                 
                 <button type="submit" class="save_button"><span class="glyphicon glyphicon-save"></span> Скачать</button>
                </div>
            ';
                
                                                    
                print '</div>';
                print'</br>';
            break;
        case '4':
                $text = $row_e[$object_search];//название темы 
         
             $n=0;
             foreach ($search as $key => $value) 
             {
                //print_r($search[$n]);
                 
                 $text = preg_replace('('.$value.')iu','<b style="color:yellow;">'.$value.'</b>',$text).'<br>';
                 
                 $n++;
             }
                
                
                print'<div class="sort_result"></div>';
                print '<div class="result_div" align="center">';
                print '<a href="modul/open.php?id='.$row_e[0].'"><h4 class="page-header" align="center">'.$text.'</h4></a>   ';
                //print' <h3 class="page-header" align="center">Добавление пользователя</h3>';
                print '<p align="left"><b>Автор:</b> '.$row_e[2].'</p>';
                print '<p align="left"><b>Группа:</b> '.$row_e[5].'</p>';
                print '<p align="left"><b>Год:</b> '.$row_e[13].'</p>';
                print '<div align="right">
                 
                 <button type="submit" class="save_button"><span class="glyphicon glyphicon-save"></span> Скачать</button>
                </div>
            ';
                
                                                    
                print '</div>';
                print'</br>';
            break;
        case '5':
                $text = $row_e[$object_search];//название темы 
         
             $n=0;
             foreach ($search as $key => $value) 
             {
                //print_r($search[$n]);
                 
                 $text = preg_replace('('.$value.')iu','<b style="color:yellow;">'.$value.'</b>',$text).'<br>';
                 
                 $n++;
             }
                
                
                print'<div class="sort_result"></div>';
                print '<div class="result_div" align="center">';
                print '<a href="modul/open.php?id='.$row_e[0].'"><h4 class="page-header" align="center">'.$text.'</h4></a>   ';
                //print' <h3 class="page-header" align="center">Добавление пользователя</h3>';
                print '<p align="left"><b>Автор:</b> '.$row_e[2].'</p>';
                print '<p align="left"><b>Группа:</b> '.$row_e[5].'</p>';
                print '<p align="left"><b>Год:</b> '.$row_e[13].'</p>';
                print '<div align="right">
                 
                 <button type="submit" class="save_button"><span class="glyphicon glyphicon-save"></span> Скачать</button>
                </div>
            ';
                
                                                    
                print '</div>';
                print'</br>';
            break;
        case '6':
                $text = $row_e[$object_search];//название темы 
         
             $n=0;
             foreach ($search as $key => $value) 
             {
                //print_r($search[$n]);
                 
                 $text = preg_replace('('.$value.')iu','<b style="color:yellow;">'.$value.'</b>',$text).'<br>';
                 
                 $n++;
             }
                
                
                print'<div class="sort_result"></div>';
                print '<div class="result_div" align="center">';
                print '<a href="modul/open.php?id='.$row_e[0].'"><h4 class="page-header" align="center">'.$text.'</h4></a>   ';
                //print' <h3 class="page-header" align="center">Добавление пользователя</h3>';
                print '<p align="left"><b>Автор:</b> '.$row_e[2].'</p>';
                print '<p align="left"><b>Группа:</b> '.$row_e[5].'</p>';
                print '<p align="left"><b>Год:</b> '.$row_e[13].'</p>';
                print '<div align="right">
                 
                 <button type="submit" class="save_button"><span class="glyphicon glyphicon-save"></span> Скачать</button>
                </div>
            ';
                
                                                    
                print '</div>';
                print'</br>';
            break;
        case '7':
                $text = $row_e[$object_search];//название темы 
         
             $n=0;
             foreach ($search as $key => $value) 
             {
                //print_r($search[$n]);
                 
                 $text = preg_replace('('.$value.')iu','<b style="color:yellow;">'.$value.'</b>',$text).'<br>';
                 
                 $n++;
             }
                
                
                print'<div class="sort_result"></div>';
                print '<div class="result_div" align="center">';
                print '<a href="modul/open.php?id='.$row_e[0].'"><h4 class="page-header" align="center">'.$text.'</h4></a>   ';
                //print' <h3 class="page-header" align="center">Добавление пользователя</h3>';
                print '<p align="left"><b>Автор:</b> '.$row_e[2].'</p>';
                print '<p align="left"><b>Группа:</b> '.$row_e[5].'</p>';
                print '<p align="left"><b>Год:</b> '.$row_e[13].'</p>';
                print '<div align="right">
                 
                 <button type="submit" class="save_button"><span class="glyphicon glyphicon-save"></span> Скачать</button>
                </div>
            ';
                
                                                    
                print '</div>';
                print'</br>';
            break;
    }
          /*$text = $row_e[$object_search_n];//название темы 
         
             $n=0;
             foreach ($search as $key => $value) 
             {
                //print_r($search[$n]);
                 
                 $text = preg_replace('('.$value.')iu','<b style="color:yellow;">'.$value.'</b>',$text).'<br>';
                 
                 $n++;
             }
                
                
                print'<div class="sort_result"></div>';
                print '<div class="result_div" align="center">';
                print '<a href="modul/open.php?id='.$row_e[0].'"><h4 class="page-header" align="center">'.$text.'</h4></a>   ';
                //print' <h3 class="page-header" align="center">Добавление пользователя</h3>';
                print '<p align="left"><b>Автор:</b> '.$row_e[2].'</p>';
                print '<p align="left"><b>Группа:</b> '.$row_e[5].'</p>';
                print '<p align="left"><b>Год:</b> '.$row_e[13].'</p>';
                print '<div align="right">
                 
                 <button type="submit" class="save_button"><span class="glyphicon glyphicon-save"></span> Скачать</button>
                </div>
            ';
                
                                                    
                print '</div>';
                print'</br>';*/
    } 
}










exit;
function key_compare_func($key1, $key2)
{
    if ($key1 == $key2)
        return 0;
    else if ($key1 > $key2)
        return 1;
    else
        return -1;
}
//var_dump($array_s2);
if(isset($array_s2) and isset($array_e2))
{
$result= array_intersect_ukey($array_e2, $array_s2, 'key_compare_func');

for ($f=0; $f <count($result); $f++) 
{ //вывод еси равны 2 параметра
    $select = pg_query($connect, "SELECT * FROM vkr_works
    WHERE id=$result[0]  ");
     $row=pg_fetch_row($select);
     print $row[1].$row[2];
}
}else
{//вывод еси равны 1 из 2 параметров
    if(isset($array_s2))
    {
        $else_serch = $array_s2;
    }

    if(isset($array_e2))
    {
        $else_serch = $array_e2;
    }
    
for ($r=0; $r < count($else_serch); $r++) 
{ 


    $selects = pg_query($connect, "SELECT * FROM vkr_works WHERE id = $else_serch[$r] ");

    while ($row_e=pg_fetch_row($selects))
    {
          $text = $row_e[1]; 
             
                $text = preg_replace('('.$searchx.')iu','<b style="color:yellow;">'.$searchx.'</b>',$text);
                print'<div class="sort_result"></div>';
                print '<div class="result_div" align="center">';
                print '<a href="modul/open.php?id='.$row_e[0].'"><h4 class="page-header" align="center">'.$text.'</h4></a>   ';
                //print' <h3 class="page-header" align="center">Добавление пользователя</h3>';
                print '<p align="left"><b>Автор:</b> '.$row_e[2].'</p>';
                print '<p align="left"><b>Группа:</b> '.$row_e[5].'</p>';
                print '<p align="left"><b>Год:</b> '.$row_e[13].'</p>';
                print '<div align="right">
                 
                 <button type="submit" class="save_button"><span class="glyphicon glyphicon-save"></span> Скачать</button>
                </div>
            ';
                
                                                    
                print '</div>';
                print'</br>';
    }

}


}
                ///////////////////////////////////
            /*while ($row2=pg_fetch_row($db_referal))
            {   
                $text = $row2[1]; 
             
                $text = preg_replace('('.$search.')iu','<b style="color:yellow;">'.$search.'</b>',$text);
                print'<div class="sort_result"></div>';
                print '<div class="result_div" align="center">';
                print '<a href="modul/open.php?id='.$row2[0].'"><h4 class="page-header" align="center">'.$text.'</h4></a>   ';
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
            }       */
        } //else
    }
      


?>
