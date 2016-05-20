<p align="center">Тема</p> 
	<input type="text" name="subject" id="searchbox" class="form-control" placeholder="Разработка системы управления курсовыми и дипломными работами. ">
	<div  align="center"> 

		<p align="center">Ф.И.О Исполнителя</p> 

	<select name="id_dep" class="form-control" align="center">
	<option value="0" style="background-color:#A88F8F;"></option>
<?php 
	$connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
	$result_dep = pg_query($connect,"SELECT  *FROM vkr_works ");
    while ($row_dep = pg_fetch_row($result_dep))
    {
      print '<option style ="background-color:#DDCECE;" value="'.$row_dep[0].'">';
        print $row_dep[2];
      print"</option>";
    }


 ?>

</select>

<p align="center">Проверил:</p> 

	<select name="id_dep" class="form-control" align="center">
	<option value="0" style="background-color:#A88F8F;"></option>
<?php 
	$connect= pg_connect("host=localhost port=5432 dbname=test_c user=postgres password=postgres");
	$result_dep = pg_query($connect,"SELECT  *FROM ped_composition ");
    while ($row_dep = pg_fetch_row($result_dep))
    {
      print '<option style ="background-color:#DDCECE;" value="'.$row_dep[0].'">';
        print $row_dep[1];
      print"</option>";
    }


 ?>

												

												
</select>
												
<p class="rightstr">Год</p>
<input type="text" name="filter-n-1-'.$i.'" id="datepicker-d-1" placeholder="Дата"><br>.


												

</div>
