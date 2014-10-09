<?php

include('db.php');

session_start();
session_destroy();

//see if cookie is set and kill it

if(isset($_COOKIE['staff-ID'])) {
	
	setcookie('staff-ID', $userDetail->email, time() - (86400 * 14));

	}

?>

<?php
$localPage = 'logged out'; ?>

<html>
 
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


<style type="text/css">
body{
background: #1f2c1a url(img/bg/login-bg.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;; }
</style>

<body>

  

  <div class="fold-full login">

    <div class="container">
<div class="span4 offset4">
	<div id="login-form">
		<h3>YOU ARE LOGGED OUT!</h3> 		<!-- <div id="last-staff"><img src="http://dashboard.circuitpro.co.uk/img/meet-Ben.png"></div> -->
      <form  action="login.php" method="post" name="staffLogin" enctype="multipart/form-data" onsubmit="return formVerify();">

        <input type="text" class="login-input" placeholder="Username" name="username">
        <input type="password" class="login-input" placeholder="Password" name="password">
        <label class="checkbox">
          <input name="remember" id="remember" type="checkbox" value="" /> Remember me for two weeks
        </label>
        <!-- <p class="last-login">Last Login Ben <span style="color: #777;">14 Aug 2013 - 16:12</span></p> -->
        <input name="submitButtonName" type="submit" value="Sign into Dashboard" class="btn btn-warning"/>
      </form>
</div></div>
    </div> <!-- /container -->

 </div>
  
       
  </body>
</html>

