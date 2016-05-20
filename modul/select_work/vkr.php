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
												

												

												<p align="center">Руководители</p> 
												 <hr>
												<p class="leftstr">Научный руководитель:</p>
												<p class="rightstr">Нормаконтролер:</p>
												<select name="head" class="form-control-smile">
												<option value="0" style="background-color:#A88F8F;">Научный руководитель</option>
<?php 
$result_cod = pg_query($connect,"SELECT  *FROM ped_composition");
    while ($row_cod = pg_fetch_row($result_cod))
    {
      print '<option style ="background-color:#DDCECE;" value="'.$row_cod[0].'">';
        print $row_cod[1];
      print"</option>";
    }


 ?>		
												</select>

							<select name="normative" class="form-control-smile">
												<option value="0" style="background-color:#A88F8F;">Нормаконтролер</option>
<?php 
$result_cod = pg_query($connect,"SELECT  *FROM ped_composition");
    while ($row_cod = pg_fetch_row($result_cod))
    {
      print '<option style ="background-color:#DDCECE;" value="'.$row_cod[0].'">';
        print $row_cod[1];
      print"</option>";
    }


 ?>		
												</select>


												

												<p align="center">Консультант(ы):</p> 
												<p class="leftstr">Ф.И.О</p>
												<p class="rightstr">Ученая степень / ученое звание</p>
<?php 
for ($c=1; $c <= 4 ; $c++) 
{ 
	if($c==1) $check = 'checked'; else $check = '';
	print '
	<div>
	<label class="checkbox-inline">
	<input type="checkbox" id="radio-inline" '.$check.' name="s_cons_'.$c.'" >№'.$c.':
	</label>
	<input type="text" name="subject" id="searchbox" class="form-control-cons" placeholder="Консультант №'.$c.'. ">
	</div>';
}
 ?>
	



												<p align="center">Зав.Кафедрой:</p> 
												<p class="leftstr">Ф.И.О</p>
												<p class="rightstr">Ученая степень / ученое звание</p>
												<div>
													<select name="head_chair" class="form-control-cons">
												<option value="0" style="background-color:#A88F8F;">Зав.Кафедрой</option>
<?php 
$result_cod = pg_query($connect,"SELECT  *FROM ped_composition");
    while ($row_cod = pg_fetch_row($result_cod))
    {
      print '<option style ="background-color:#DDCECE;" value="'.$row_cod[0].'">';
        print $row_cod[1];
      print"</option>";
    }


 ?>		
												</select>
												</div>

												<p class="rightstr">Допущен(a) к защите</p>
												
											    <input type="text" name="filter-n-1-'.$i.'" id="datepicker-d-1" placeholder="Дата">

												


											</div>

										</div>