<?php 
include ('../db.php');
include ('../functions.php');

//Check if user is logged in first
	if (!checkStaffLoggedIn()) {
	header("Location: http://dashboard.kingdom-creative.co.uk/today/"); }
	
	//Then fetch the staff record from cookie or session variable
	if(isset($_COOKIE['staff-ID'])) {
	$staffData = fetchStaffviaID($_COOKIE['staff-ID']); } else {
	$staffData = fetchStaffviaID($_SESSION['staff-ID']);
	}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
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

  <body id="add">

  
     
    <nav class="navbar" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
      <a class="navbar-brand" href="#">TODAY. <span style="font-size: 10px;">1.1</span></a>

  </div><!-- /.container-fluid -->
</nav>

<div class="add_box">
<h3>Add news</h3>
<form id="addToday" method="post" action="../ajax/add_today.php" enctype="multipart/form-data" name="addToday">
<input type="hidden" value="<?php echo $staffData->shortname_STAFF; ?>" name="staff">
<p><input type="text" name="todayText" class="form-control"  data-maxsize="100" data-output="status1" maxlength="100" required></p>
<p class="note">You have used <span id="status1"></span> characters of 100</p>
<p><input type="file" name="image" class="custom-file-input form-control" title=""></p>
<input type="submit" class="btn btn-primary form-sub" value="POST TO TODAY" data-text-swap="Posting News..." id="postToday">
</form>

<form>



</form>

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
