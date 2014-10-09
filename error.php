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
		<h3>ERROR!</h3> 		<p><?php print($thisException->getMessage()); ?></p>
		
		<p><input name="submitButtonName" type="submit" value="Back" onclick="history.back()" /></p>
		</div>
		 
		
    </div> <!-- /container -->

 </div>
  
       
  </body>
</html>
