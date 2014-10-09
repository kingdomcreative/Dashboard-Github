<?php 

include ('db.php');
include ('functions.php');

//Check if user is logged in first
	if (!checkStaffLoggedIn()) {
	header("Location: index.php"); }
	
//Then fetch the staff record from cookie or session variable
	if(isset($_COOKIE['staff-ID'])) {
	$staffData = fetchStaffviaID($_COOKIE['staff-ID']); } else {
	$staffData = fetchStaffviaID($_SESSION['staff-ID']);
	}

	$localPage="home";

?>

<!doctype html>
<html lang="en">

<?php include('includes/head.php'); ?>

<body>

  <?php include('includes/header.php'); ?> 

<div class="menu-header">
	<div class="container">

        <div class="span8 first">
		<h1>Key <span style="font-weight: 200;">INFORMATION</span></h1>
        </div>
	</div>
</div>

 


<! News n stuff !>
<div class="fold-full">
<div class="container fold-dash">
	    <div class="row">


<div class="span12 news-item">

<div class="latest-news">
<div class="accordion" id="accordion1">
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne">
        <h4>Emergency Info</h4>
      </a>
    </div>
    <div id="collapseOne" class="accordion-body collapse">
      <div class="accordion-inner">
        <p>Key information goes here</p>
      </div>
    </div>
  </div>
  
  
  <div class="accordion" id="accordion1">
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
        <h4>Showreels</h4>
      </a>
    </div>
    <div id="collapseTwo" class="accordion-body collapse">
      <div class="accordion-inner">
        <p>Aerial Showreel</p>
      </div>
    </div>
  </div>
  

    <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapseThree">
        <h4>How to connect to server from offsite</h4>
      </a>
    </div>
    <div id="collapseThree" class="accordion-body collapse">
      <div class="accordion-inner">
        <p>When connected to an external internet connection off-site, <a href="afp://server.kingdom-creative.co.uk"> Click here</a> or in the Finder application menu, click 'Go' and then 'Connect to Server'</p>
        <p><img src="/img/info/server1.jpg" alt="Connect to Server" /></p>
        <p>In the dialog that appears type in "afp://server.kingdom-creative.co.uk" and choose 'Connect'. Clicking on the plus sign will save this server address to use again.</p>
        <p><img src="/img/info/server2.jpg" alt="Enter server address" /></p>
        <p>Once prompted, you can select which server share to connect to. Shares that are greyed out indicate that you have connected already.</p>
        <p><img src="/img/info/server3.jpg"  alt="Select server share" /></p>
        <p>You will then be asked for a username and password. The username is 'fileuser' and the password is the one issued (starting with capital F).</p>
        <p>You are now connected. Please be aware that due to slower network speeds, there may be delays when browsing folders (especially containing video) and saving and opening files remotely.</p>
      </div>
    </div>
  </div>
  
    <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#collapseFour">
        <h4>How to set out of office</h4>
      </a>
    </div>
    <div id="collapseFour" class="accordion-body collapse">
      <div class="accordion-inner">
        <p><a href="https://mail.kingdom-creative.co.uk/webmail/" alt="Open Kerio Webmail"> Click here</a> or in your internet browser use this link - <a href="https://mail.kingdom-creative.co.uk/webmail/">https://mail.kingdom-creative.co.uk/webmail/</a></p>
        <p>Sign in with your username (first part of your e-mail address) and e-mail password. Contact Ben or Martyn if you need your password.</p>
        <p><img src="/img/info/ooo1.jpg" /></p>
        <p>Once logged into the Kerio system, in the top right corner, click on your name and then 'Out of Office'.</p>
        <p><img src="/img/info/ooo2.jpg" /></p>
         <p>Tick the 'Send "Out of "Office messages" option and then choose the dates you wish the message to be sent. This will send an auto response to any sender (once per day). Once the end date has passed, the responses will not be sent any further. Once you have entered your reply message, click 'Save' to set the Out of Office up.</p>
         <p><img src="/img/info/ooo3.jpg" /></p>
         <p>If you need incoming messages forwarded to another e-mail account, please contact Ben or Martyn to set the forwarding up - this does not auto expire on the end date, so will need to be un-set on request also.</p>

      </div>
    </div>
  </div>
  
</div>
</div>

        </div><!-- END Span 12 -->
    </div>
</div><!-- END Container -->
</div>


</body>

</html>
		
