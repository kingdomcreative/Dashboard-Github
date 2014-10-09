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
		<h1>THE <span style="font-weight: 200;">CLIPBOARD</span></h1>
        </div>

        <div class="span4 staff">
        <img src="img/meet-<?php echo $staffData->shortname_STAFF; ?>.png">
        </div>

	</div>
</div>

 
<! Header Options !>
<div class="header-full">
<div class="container header-option">
	    <div class="row">


</div>
<div class="tab-open-close"><i class="icon-collapse-top"></i></div>
</div>

</div>


<! News n stuff !>
<div class="fold-full">
<div class="container fold-dash">
	    <div class="row">

<! Active Projects !>
<div class="span8"><h3 class="first">LATEST <span style="font-weight: 200;">NEWS ALERTS</span></h3></div>
<div class="span4"><h3 class="first">LINK <span style="font-weight: 200;">GENERATOR</span></h3></div>

    <div class="clearboth"></div>

<div class="span8 news-item">

<div class="latest-news">


<!-- AJAX Dynamic Refresh on News Output -->

<div id="news-output">
</div>


<form id="addNewsContent" action="/ajax/addNews.php" method="post">
<textarea class="area-news" placeholder="Add your news here..." name="newsContent"></textarea><br>
<input type="hidden" value="<?php echo $staffData->_kp_STAFF; ?>" name="staffID"> 
<input type="submit" class="btn btn-warning form-sub" id="add-news" value="Submit News">
</form>

<div class="welldone alert alert-success" style="display:none;">Updated! News Content Added</div>


</div>
</div>


<div class="span4 news-item">
<div class="link-generator">
<div id="link-generator">
<form id="filmLink" method="post" action="/ajax/film_link.php">
<input type="text" class="link-generator-input" placeholder="Enter vimeo link..." name="vimeolink"> <a href="#" class="btn btn-warning" id="filmLinkSubmit"><i class="icon-check"></i></a>
</form></div>
</div>
</div>


<div class="span4 highlight"><h3 class="first">LATEST <span style="font-weight: 200;">UPLOAD</span></h3></div>
<div class="span4 news-item">
<div class="latest-upload">
<?php $latestFilm = fetchLatestFilm(); ?>

<iframe src="http://player.vimeo.com/video/<?php echo $latestFilm->vimeoID_VIDEO; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=f28c3a" width="340" height="200" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
<p><?php echo $latestFilm->title_VIDEO; ?></p>
</div>
</div>


</div>
</div>


</div> 
<! END News n stuff !>

<div class="tab-full">
<div class="container">
    <div class="row">
   <div class="span4"><img src="http://dashboard.circuitpro.co.uk/img/client-brdc.jpg"></div>
<div class="span4"><img src="http://dashboard.circuitpro.co.uk/img/client-brdc.jpg"></div>
<div class="span4"><img src="http://dashboard.circuitpro.co.uk/img/client-brdc.jpg"></div>
<div class="span4"><img src="http://dashboard.circuitpro.co.uk/img/client-brdc.jpg"></div>
<div class="span4"><img src="http://dashboard.circuitpro.co.uk/img/client-brdc.jpg"></div>
<div class="span4"><img src="http://dashboard.circuitpro.co.uk/img/client-brdc.jpg"></div>
<div class="span4"><img src="http://dashboard.circuitpro.co.uk/img/client-brdc.jpg"></div>
<div class="span4"><img src="http://dashboard.circuitpro.co.uk/img/client-brdc.jpg"></div>
<div class="span4"><img src="http://dashboard.circuitpro.co.uk/img/client-brdc.jpg"></div>
<div class="span4"><img src="http://dashboard.circuitpro.co.uk/img/client-brdc.jpg"></div>
<div class="span4"><img src="http://dashboard.circuitpro.co.uk/img/client-brdc.jpg"></div>
<div class="span4"><img src="http://dashboard.circuitpro.co.uk/img/client-brdc.jpg"></div>
<div class="span4"><img src="http://dashboard.circuitpro.co.uk/img/client-brdc.jpg"></div>
<div class="span4"><img src="http://dashboard.circuitpro.co.uk/img/client-brdc.jpg"></div>
<div class="span4"><img src="http://dashboard.circuitpro.co.uk/img/client-brdc.jpg"></div>
<div class="span4"><img src="http://dashboard.circuitpro.co.uk/img/client-brdc.jpg"></div>

    </div>
</div><!-- END Container -->
</div>


</body>

</html>
		
