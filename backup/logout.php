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


<body>
    
    <h4>You are now logged out!</h4>
    
    <form action="login.php" method="post" name="staffLogin" enctype="multipart/form-data" onsubmit="return formVerify();">
    <label>Username</label>
    <input  name="username" type="text"  placeholder=" "/>
    <label>Password</label>
    <input  name="password" type="password" placeholder=" "/>
   
    <label for="remember">Remember my login (for two weeks):</label><input name="remember" id="remember" type="checkbox" value="" />


    <input name="submitButtonName" type="submit" value="Login to Dashboard" /></form>

    
       
  </body>
</html>


