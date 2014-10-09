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
		<h1>Welcome <span style="font-weight: 200;"><?php echo $staffData->shortname_STAFF; ?></span></h1>
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

<div class="news-active">


<!-- AJAX Dynamic Refresh on News Output -->

<div id="news-output">
</div>


<form id="addNewsContent" action="ajax/addNews.php" method="post">
<textarea class="area-news" placeholder="Add your news here..." name="newsContent"></textarea><br>
<input type="hidden" value="<?php echo $staffData->_kp_STAFF; ?>" name="staffID"> 
<input type="submit" class="btn btn-warning form-sub" id="add-news" value="Submit News">
</form>

<div class="welldone alert alert-success" style="display:none;">Updated! News Content Added</div>


</div>
</div>


<div class="span4 news-item">
<div class="news-active">
<div id="link-generator">
<form id="filmLink" method="post" action="ajax/film_link.php">
<input type="text" class="vimeo-link" placeholder="Enter vimeo link..." name="vimeolink"> <input type="submit" class="btn btn-warning" value="GO"> </form></div>
</div>
</div>


<div class="span4 highlight"><h3 class="first">LATEST <span style="font-weight: 200;">UPLOAD</span></h3></div>
<div class="span4 news-item">
<div class="news-active">
<?php $latestFilm = fetchLatestFilm(); ?>

<iframe src="http://player.vimeo.com/video/<?php echo $latestFilm->vimeoID_VIDEO; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=f28c3a" width="340" height="200" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
</div>
</div>


</div>
</div>


</div> 
<! END News n stuff !>

<div class="tab-full">
<div class="container">
    <div class="row">
        <div class="span12"><!-- Span 12 -->

    <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab"><h4>PROJECTS</h4></a></li>
    <li><a href="#tab2" data-toggle="tab"><h4>CLIENTS</h4></a></li>
    </ul>
  <div class="tab-content tab-bg">



 <! Projects Tab !>
  <div class="tab-pane active" id="tab1">

    <div class="side-opt">
  <ul class="nav span1">
    
    <li class="add transition active"><a href="#pane2" data-toggle="tab"><i class="icon-folder-open-alt"></i></a></li>
    <li class="completed transition"><a href="#pane3" data-toggle="tab"><i class="icon-ok"></i></a></li>
    <li class="view transition"><a href="#pane1" data-toggle="tab"><i class="icon-plus"></i></a></li>
    <li class="end-fill transition"></li>
  </ul>
</div>

  <div class="tab-content span11 first project">

    <! Add Project !>
    <div id="pane1" class="tab-pane">
      <h2 class="sub-title">ADD <span style="font-weight: 200;">A PROJECT</span></h2>

<div class="clearboth"></div>
<div class="container-fluid no-pad list-client">
    <div class="row-fluid">

    <div class="span4 first">
        <p>Project Title: <input type="text"  class="add-form"></p>
    </div>

    <div class="span4">
        Date: <input type="text" id="datepicker" class="add-form"/>
    </div>

    <div class="span4">
        Client: <select name="clients">
        <option>Select a Client</option>
        </select>
    </div>

    <div class="clearboth"></div>
<hr>

<! AREA Details !>

<div class="span6 first">
    <p>What do you want to achieve with the project?</p>
<textarea class="add-area"></textarea>
</div>

<div class="span6">
    <p>What duration are the film(s) going to be?:</p>
    <textarea class="add-area"></textarea>

</div>

    <div class="clearboth"></div>

<hr>
<div class="span6 first">
    <p>How/where will the film(s) be viewed?</p>
<textarea class="add-area"></textarea>
</div>

<div class="span6">
    <p>What video format do you need the film(s) to be in?:</p>
    <textarea class="add-area"></textarea>

</div>

    <div class="clearboth"></div>


<hr>
<div class="span6 first">
    <p>What graphics appear during the film(s)</p>
<textarea class="add-area"></textarea>
</div>

<div class="span6">
    <p>What video format do you need the film(s) to be in?:</p>
    <textarea class="add-area"></textarea>

</div>

    <div class="clearboth"></div>


<hr>

<! DELIVER Details !>


<div class="span4 first">
    First Edit Delivered: <input type="text" id="datepicker" class="add-form"/>
</div>

<div class="span4">
    Client Feedback/Approval: <input type="text" id="datepicker" class="add-form"/>
</div>

<div class="span4">
    Final Edit Delivered: <input type="text" id="datepicker" class="add-form"/>
</div>

    <div class="clearboth"></div>



    </div> <!-- END Row -->
</div> <!-- END Container -->
      
    </div>


    <! Active Projects !>
    <div id="pane2" class="tab-pane active">
    <h2 class="sub-title">ACTIVE <span style="font-weight: 200;">PROJECTS</span></h2>

    <div class="action-filter">
            <div class="btn-group">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                VIEW <span class="caret"></span> </a>

            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
            <!-- dropdown menu links -->
            <li><a tabindex="-1" href="#" class="activeProjectToggle" data-show="<?php echo $staffData->_kp_STAFF; ?>">YOUR PROJECTS</a></li>
            <li><a tabindex="-1" href="#" class="activeProjectToggle" data-show="all">ALL ACTIVE</a></li>
            </ul>
            </div>
            </div>

    <div class="clearboth"></div>
    
    <!-- ACTIVE PROJECTS AJAX -->

    <div id="active-projects">
    

    </div> <!-- active-projects -->

    </div>


    <!-- COMPLETED PROJECTS -->
    <div id="pane3" class="tab-pane">
    <h2 class="sub-title">COMPLETED <span style="font-weight: 200;">PROJECTS</span></h2>
    <div class="clearboth"></div>
      
      <!-- COMPLETED PROJECTS PHP -->

    <div id="completed-projects">
    
  <?php  $completedProjectResult = fetchAllCompletedProjects("",""); ?>
    

  		<ul class="list-projects">

	  		<li>
            <div class="client table-top">CLIENT</div>
            <div class="project-name table-top">PROJECT NAME</div>
            <div class="date-added table-top">DATE ADDED</div>
            <div class="project-info table-top">PROJECT INFO</div>
            </li>
        
    
<?php    while ($projectData = $completedProjectResult->fetch_object()) { 

   printf('<li>
            <div class="client">%s</div>
            <div class="project-name"><a href="project/%d/%s">%s</a></div>
            <div class="date-added">%s</div>
            <div class="project-info"><a href="project/%d/%s">Info</a> l <a href="project/%d/%s#films">Films</a> </div>

        </li>',$projectData->name_CLIENT,$projectData->_kp_PROJECT,titleURL($projectData->title_PROJECT),$projectData->title_PROJECT,$projectData->added_PROJECT,$projectData->_kp_PROJECT,titleURL($projectData->title_PROJECT),$projectData->_kp_PROJECT,titleURL($projectData->title_PROJECT));
        
        } ?>
        
        </ul>
    

    </div> <!-- completed-projects -->
      
    </div>
    

  </div><!-- /.tab-content -->


  </div><!-- END Projects -->


  <! Clients Tab !>
  <div class="tab-pane" id="tab2">

    

    <div class="side-opt">
  <ul class="nav span1">
      <li class="add transition active"><a href="#pane5" data-toggle="tab"><i class="icon-group"></i></a></li>
    <li class="view transition"><a href="#pane4" data-toggle="tab"><i class="icon-plus"></i></a></li>
    <li class="end-fill transition"></li>
  </ul>
</div>


     <div class="tab-content span11 first project">

    <! Add Project !>
    <div id="pane4" class="tab-pane">
      <h2 class="sub-title">ADD <span style="font-weight: 200;">CLIENT</span></h2>
<!--       Add new client form -->
    </div>

    <! CLIENT LIST !>
    <div id="pane5" class="tab-pane active">
        <h2 class="sub-title">CLIENT <span style="font-weight: 200;">LIST</span></h2>

            <div class="action-filter">
            <div class="btn-group">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                SORT<span class="caret"></span> </a>

            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
            <!-- dropdown menu links -->
            <li><a tabindex="-1" href="#" class="clientSortToggle" data-sort="name">BY NAME</a></li>
            <li><a tabindex="-1" href="#" class="clientSortToggle" data-sort="login">BY ACTIVITY</a></li>
            </ul>
            </div>
            </div>

    <div class="clearboth"></div>

    <!-- CLIENT DATA AJAX -->

    <div id="client-data">
    

    </div> <!-- END client-data -->

    </div>


    

  </div><!-- END Clients -->

</div>
</div>
</div>

        </div><!-- END Span 12 -->
    </div>
</div><!-- END Container -->
</div>


</body>

</html>
		
