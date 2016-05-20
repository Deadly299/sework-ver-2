<!DOCTYPE>
<head>
  <meta charset="utf-8">
  
  <title>Добавление пользователей</title>


 </head>
 <body>
	
<?php 
  $text = 'hello everebody. this is test text for everebody. please read it and enjoy everebody and never ever missing'; 
  $search='ever'; 
  $pattern='|([^ ]*'.$search.'[^ .,:;]*)|is'; 
  $replace='<font color=red>\\1</font>'; 
  $text=preg_replace($pattern,$replace,$text); 
  echo $text;  
?> 
 </body>
 </html>