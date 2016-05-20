<!DOCTYPE>
  <head>
    <meta charset="utf8">
    <title>Выбор шаблона</title>
	<link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="../bootstrap/css/dashboard.css" rel="stylesheet">
  <script type="text/javascript" src="../js/jquery-1.12.1.js"></script>
  <script type="text/javascript" src="../js/modul/script.js"></script>
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../index.php">Sework</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
          
          
                 <li><a href="setting_user.php">Профиль</a></li>
            
            
            <li><a href="authorization.php">
          <?php print '<b style="color:#5FA6E7;">'.$_SESSION['user'][1].'</b>&nbsp' ; ?>Выйти
          </a></li>
            <li><a href="#">Help</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><h4>&nbspУправление работами</h4></li>
            <li class="active"><a href="adminka.php">Добавить работу</a></li>
            <?php 

              if ($_SESSION['user'][1]=='Admin')
                {
                  print'<li><a href="archive_vkr_works.php">Архив дипломных работ</a></li>
                  <li><a href="archive_kurs_works.php">Архив курсовых работ</a></li>';
                }

             ?>
            
            
          </ul>
          
           <?php 
             
              

              if ($_SESSION['user'][1]=='Admin')
              {
                print'<ul class="nav nav-sidebar">
                <li><h4>&nbspУправление пользователями</h4></li>
                <li><a href="create_users.php">Добавить пользователя</a></li>
                <li><a href="list_users.php">Список пользователей</a></li>
              </ul>';
              }

               ?>
            
        </div>
