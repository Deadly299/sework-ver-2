<?php 
include("security/control.php");
include("../layaut/header.php");
include("function/function_update.php");

//include("function/db_connection.php");
  
 ?>


		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		  <h1 class="page-header" align="center">Администрирование</h1>

		  <div class="row placeholders">

<!-- ///////////////////////////////////////////////////////////////////////////////////////// -->

	<?php

		  $return_s_f = Start_fac();	
		  $return_s_d = Start_dep();
		  $return_s_spec = Start_spec();	
		  $return_f = Fun_upd_faculties();
		  $return_del = Delete_fac_dep();
		  $return_upd = Upd_fac_dep();
		  $return_d_d = Fun_del_departments();
		  $return_d_up = Fun_upd_departments();
		  $return_spec = Fun_upd_speciality();		  





print '<h4 align="left">Первый старт факультетов: '.$return_s_f.'</h4>';
print '<h4 align="left">Первый старт кафедр: '.$return_s_d.'</h4>';
print '<h4 align="left">Первый старт Cпециальностей: '.$return_s_spec.'</h4>';

		  



		  print '<h4 align="left">Новых факультетов: '.$return_f[1].'</h4>';
		  print '<h4 align="left">Удалено факультетов: '.$return_f[2].'</h4>';
		  print '<h4 align="left">Изменено факультетов: '.$return_f[3].'</h4>';

		//  print '<h4 align="left">Новых кафедр: '.$return_d[1].'</h4>';
		 // print '<h4 align="left">Удалено кафедр: '.$return_d[2].'</h4>';
		 // print '<h4 align="left">Изменено кафедр: '.$return_d[3].'</h4>';

		  print '<h4 align="left">Новых специальностей: '.$return_spec[1].'</h4>';
		  print '<h4 align="left">Удалено специальностей: '.$return_spec[2].'</h4>';
		  print '<h4 align="left">Изменено специальностей: '.$return_spec[3].'</h4>';
		  print '<h4 align="left">Удаленно зависисотей: '.$return_del.'</h4>';
		  print '<h4 align="left">Изменено зависисотей: '.$return_upd.'</h4>';
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
