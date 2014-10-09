<?php 
include ('../db.php');
include ('../functions.php');

//Check if user is logged in first
	if (checkStaffLoggedIn()) {
	header("Location: http://dashboard.kingdom-creative.co.uk/today/add"); }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
   <meta http-equiv="refresh" content="14400" />
    <meta name="description" content="">
    <meta name="author" content="">
<!--     <link rel="shortcut icon" href="assets/ico/favicon.ico"> -->

    <title>TODAY. by Kingdom Creative</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
    <link href="css/font.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    
	
  </head>

  <body>

  
     
    <nav class="navbar" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
       <i class="fa fa-bars"></i>
      </button>
      <a class="navbar-brand" href="#">TODAY. <span style="font-size: 10px;">1.0</span></a>
    </div>


     
       <!--
 <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><i class="fa fa-info"></i> Quick news for you</a></li>      </ul>
-->

  </div><!-- /.container-fluid -->
</nav>



    <div class="container" id="ticker-day">
      <!-- Example row of columns -->    
      <div id="project-full">
 

      
               
      
      <div class="col-xs-12 today">
     
     
     <h2>Newsflash.</h2>
       
      <span class="task-count"><?php  echo date("D d M Y"); ?></span>


     <ul id="vertical-ticker">
         
       
     <!-- AJAX LOADER CONTENT --> 
      
       <div id="today-output">
	   </div>
       
       
       </ul>
 
		
		
	
		
           </div>
            
      </div>

      
         
      </div> <!-- /ROW -->
    </div> <!-- /CONTAINER -->

      
   </div>

   </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>

    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <script src="js/plugins.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>
