<?php include ('db.php'); ?>
<?php include ('functions.php'); ?>


<?php

	$localPage="login";

	//Check if client is logged in first
	if (checkStaffLoggedIn()) {
	header("Location: /home"); }

	// Randomize background
  $bg = array('header-1.jpg', 'header-2.jpg' ); // array of filenames

  $i = rand(0, count($bg)-1); // generate random number size of the array
  $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen


?>


<script type="text/javascript" language="JavaScript1.2"><!--

var formVerify = function () {

	var errorMsgOrder = new Array();
	var errorMsg = '';
	
	//Username
	if (document.staffLogin['username'].value.length == 0)
		errorMsgOrder[errorMsgOrder.length] = 'Username not entered';
	//Password
	if (document.staffLogin['password'].value.length == 0)
		errorMsgOrder[errorMsgOrder.length] = 'Password not entered';
	
	if (errorMsgOrder.length != 0)
		errorMsg = 'Error: ' + errorMsgOrder.join(', ') + '.';
	if (errorMsg.length > 0) {
		alert(errorMsg);
		return false;
	}
	
	return true;
	
};


//-->
</script>

<!doctype html>
<html lang="en">
<?php include('includes/head.php'); ?>

<style>
/* SEARCHRESULTS */
#searchresults {
	border-width:1px;
	border-color:#919191;
	border-style:solid;
	width:330px;
	background-color:#a0a0a0;
	font-size:10px;
	line-height:14px;
	padding-bottom: 10px;
}
#searchresults a {
	display:block;
	background-color:#e4e4e4;
	clear:left;
	height:60px;
	text-decoration:none;
}
#searchresults a:hover {
	background-color:#b7b7b7;
	color:#ffffff;
}
#searchresults a img {
	position: relative;
	left: 50%;
	margin-left: -50px;
}
#searchresults a span.search-image {
	float:left;
	position:relative;
	margin:5px 10px 5px 5px;
	width: 50px;
	overflow: hidden;
	display: block;
	text-align: center;
}
#searchresults a span.searchheading {
	display:block;
	font-size: 11px;
	;
	font-weight:bold;
	padding-top:5px;
	color:#191919;
}
#searchresults a:hover span.searchheading {
	color:#ffffff;
}
#searchresults a span {
	color:#555555;
}
#searchresults a:hover span {
	color:#f1f1f1;
}
#searchresults span.category {
	font-size:12px;
	margin:5px;
	display:block;
	color:#ffffff;
}
#searchresults span.seperator {
	float:right;
	padding-right:15px;
	margin-right:5px;
	background-image:url(../images/shortcuts_arrow.gif);
	background-repeat:no-repeat;
	background-position:right;
}
#searchresults span.seperator a {
	background-color:transparent;
	display:block;
	margin:5px;
	height:auto;
	color:#ffffff;
}</style>


<style type="text/css">
body{
background: #f6f6f6 url(img/bg/<?php echo $selectedBg; ?>) no-repeat; }
</style>

<body>

  

  
    <div class="container">

      <form class="form-signin" action="login.php" method="post" name="staffLogin" enctype="multipart/form-data" onsubmit="return formVerify();">
        <h2 class="form-signin-heading">Dashboard</h2>
        <input type="text" class="input-block-level add-area" placeholder="Username" name="username">
        <input type="password" class="input-block-level add-area" placeholder="Password" name="password">
        <label class="checkbox">
          <input name="remember" id="remember" type="checkbox" value="" /> Remember me
        </label>
        <input name="submitButtonName" type="submit" value="Sign into Dashboard" class="btn btn-warning"/>
      </form>

    </div> <!-- /container -->

 
  
       
  </body>
</html>
