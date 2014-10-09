<?php 

include ('db.php');
include ('functions.php');

//Check if user is logged in first
	if (!checkStaffLoggedIn()) {
	header("Location: /index.php"); }
	
//Then fetch the staff record from cookie or session variable
	if(isset($_COOKIE['staff-ID'])) {
	$staffData = fetchStaffviaID($_COOKIE['staff-ID']); } else {
	$staffData = fetchStaffviaID($_SESSION['staff-ID']);
	}

	//See if variables have been passed through

	if(empty($_GET['id'])) {
	header("Location: /home");	
		
	}
	
	$projectData = fetchProject($_GET['id']);

	$localPage = $projectData->name_CLIENT.' - '.$projectData->title_PROJECT;
	

?>

<!doctype html>
<html lang="en">
<?php include('includes/head.php'); ?>

<body>

  <?php include('includes/header.php'); ?> 


<div class="menu-header">
	<div class="container">

        <div class="span8 first">
		<h1><?php echo $projectData->name_CLIENT; ?> <span style="font-weight: 200;"><?php echo $projectData->title_PROJECT; ?></span></h1>
        </div>

        <div class="span4 staff">
        <img src="http://dashboard.circuitpro.co.uk/img/meet-<?php echo $staffData->shortname_STAFF; ?>.png">
        </div>

	</div>
</div>


<! Header Options !>
<div class="header-full">
<div class="container header-option">
	    <div class="row">


</div>

</div>

</div>


<div class="tab-full">
<div class="container">
    <div class="row">

<! Breadcrumbs !>

<div class="span9">
        <ul class="breadcrumb light">
        <li><a href="/client/<?php echo $projectData->_kp_CLIENT; ?>/<?php echo $projectData->username_CLIENT; ?>"><?php echo $projectData->name_CLIENT; ?></a><span class="divider">/</span></li>
    <li class="active"><a href="/project/<?php echo $projectData->_kp_PROJECT; ?>/<?php echo titleURL($projectData->title_PROJECT); ?>"><?php echo $projectData->title_PROJECT; ?></a></li>
        </ul>
      </div>

<div class="span3 edit">
  <a class="btn btn-warning" href="#" id="projectDetailToggle">SHOW PROJECT INFO</a><a class="btn btn-primary" href="#" id="projectEditToggle">EDIT PROJECT</a><a class="btn btn-primary" href="">ADD FILM</a>
</div>
<! END Breadcrumbs !>




<?php if($projectData->status_PROJECT == "Active") { ?>
<div id="project-info">
<?php } else { ?><div id="project-info" style="display:none;"><?php } ?>

 <! Project Info !>
<div class="span9">

  <div class="tab-content tab-bg">

  <div class="tab-pane active" id="tab1">

    <div class="side-opt side-opt-light">
  <ul class="nav span1">
  
 <?php if($_GET['function'] == "changes") { ?>
    <li class="view transition"><a href="#pane1" data-toggle="tab"><i class="icon-tasks"></i></a></li>
    <li class="view transition"><a href="#pane2" data-toggle="tab"><i class="icon-picture"></i></a></li>
    <li class="view transition"><a href="#pane3" data-toggle="tab"><i class="icon-time"></i></a></li>
    <li class="view transition"><a href="#pane4" data-toggle="tab"><i class="icon-exchange"></i></a></li>
    <li class="view transition"><a href="#pane5" data-toggle="tab"><i class="icon-download-alt"></i></a></li>
    <li class="view transition"><a href="#pane6" data-toggle="tab"><i class="icon-pencil"></i></a></li>
    <li class="view transition"><a href="#pane7" data-toggle="tab"><i class="icon-user"></i></a></li>
    <li class="view transition active"><a href="#pane8" data-toggle="tab"><i class="icon-sort-by-attributes"></i></a></li> <?php } else { ?>   
    
    <li class="view transition active"><a href="#pane1" data-toggle="tab"><i class="icon-tasks"></i></a></li>
    <li class="view transition"><a href="#pane2" data-toggle="tab"><i class="icon-picture"></i></a></li>
    <li class="view transition"><a href="#pane3" data-toggle="tab"><i class="icon-time"></i></a></li>
    <li class="view transition"><a href="#pane4" data-toggle="tab"><i class="icon-exchange"></i></a></li>
    <li class="view transition"><a href="#pane5" data-toggle="tab"><i class="icon-download-alt"></i></a></li>
    <li class="view transition"><a href="#pane6" data-toggle="tab"><i class="icon-pencil"></i></a></li>
    <li class="view transition"><a href="#pane7" data-toggle="tab"><i class="icon-user"></i></a></li>
    <li class="view transition"><a href="#pane8" data-toggle="tab"><i class="icon-sort-by-attributes"></i></a></li><?php } ?>

  </ul>
</div>

 <! END Project Info !>



  <div class="tab-content span8 first single-project">

 <?php if($_GET['function'] != "changes") { ?>
    <div id="pane1" class="tab-pane active"><?php } else { ?>
    <div id="pane1" class="tab-pane"><?php } ?>
    <h2 class="sub-title">AIMS</h2>

    <div class="clearboth"></div>

    <p><strong>What do you want to achieve with the project?</strong></p>
    <p><?php echo nl2br($projectData->check1_achieve_PROJECT); ?></p>


    </div>



    <div id="pane2" class="tab-pane">
    <h2 class="sub-title">Graphics</h2>

    <div class="clearboth"></div>

    <p><strong>What graphics appear during the film(s)?</strong></p>
    <p><?php echo nl2br($projectData->check5_graphics_PROJECT); ?></p>
    </div>


    <div id="pane3" class="tab-pane">
    <h2 class="sub-title">Duration</h2>

    <div class="clearboth"></div>
    
      <p><strong>What duration are the film(s) going to be?</strong></p>
    <p><?php echo nl2br($projectData->check4_duration_PROJECT); ?></p>
    
    </div> 



    <div id="pane4" class="tab-pane">
    <h2 class="sub-title">Distribution</h2>

    <div class="clearboth"></div>

      <p><strong>How/where will the film(s) be viewed?</strong></p>
    <p><?php echo nl2br($projectData->check2_platform_PROJECT); ?></p>
    
    </div> 


<div id="pane5" class="tab-pane">
    <h2 class="sub-title">Formats</h2>

    <div class="clearboth"></div>
    
    <?php if(!empty($projectData->viewingNotes_CLIENT)) { ?> 
    <p><strong>What does the client require for previewing?</strong></p>
    <p><?php echo nl2br($projectData->viewingNotes_CLIENT); ?></p>
    <p>&nbsp;</p><?php } ?>
    
      <p><strong>What video format do you need the film(s) to be in?</strong></p>
    <p><?php echo nl2br($projectData->check3_format_PROJECT); ?></p>
    
    </div> 


<div id="pane6" class="tab-pane">
    <h2 class="sub-title">Notes</h2>

    <div class="clearboth"></div>
       
     <?php if(!empty($projectData->notes_ext_PROJECT)) { ?>   
      <p><strong>Any additional points to note?</strong></p>
    <p><?php echo nl2br($projectData->notes_ext_PROJECT); ?></p><?php } ?>

     <?php if(!empty($projectData->notes_int_PROJECT)) { ?>       
      <p><strong>Internal notes:</strong></p>
    <p><?php echo nl2br($projectData->notes_int_PROJECT); ?></p><?php } ?>
    
    </div> 


<div id="pane7" class="tab-pane">
    <h2 class="sub-title">Staff</h2>

    <div class="clearboth"></div>
    
		<?php $prodManagerData = fetchStaffviaID($projectData->_kf_staff_prodManager_PROJECT); ?>
	      <?php $creativeManagerData = fetchStaffviaID($projectData->_kf_staff_creativeManager_PROJECT); ?>
	      <?php $editorData = fetchStaffviaID($projectData->_kf_staff_editor_PROJECT); ?>

	      <?php if(!empty($projectData->notes_int_PROJECT)) { ?> 
	   <p><strong>Client Contact</strong><br><a href="#"><?php echo $projectData->clientContact_PROJECT; ?></a></p><?php } ?>
	   
      <p><strong>Production Manager</strong><br><?php printf('<a href="mailto:%s?subject=%s">%s <i class="icon-envelope-alt"></i></a>',$prodManagerData->email_STAFF,$projectData->title_PROJECT,$prodManagerData->name_STAFF); ?></p>
<p><strong>Creative Manager</strong><br><?php printf('<a href="mailto:%s?subject=%s&cc=%s">%s <i class="icon-envelope-alt"></i></a>',$creativeManagerData->email_STAFF,$projectData->title_PROJECT,$prodManagerData->email_STAFF,$creativeManagerData->name_STAFF); ?></p>
<p><strong>Editor</strong><br><?php printf('<a href="mailto:%s?subject=%s&cc=%s">%s <i class="icon-envelope-alt"></i></a>',$editorData->email_STAFF,$projectData->title_PROJECT,$prodManagerData->email_STAFF,$editorData->name_STAFF); ?></p>
    
    <?php 
		/*
$message = $projectData->title_PROJECT.' has been updated';
		$link =   '/project/'.$projectData->_kp_PROJECT.'/'.titleURL($projectData->title_PROJECT);
    	sendNewsAlert($message,$link);
*/ ?>
    
    </div>
    
   
    <?php if($_GET['function'] == "changes") { ?>
    <div id="pane8" class="tab-pane active"><?php } else { ?>
    <div id="pane8" class="tab-pane"><?php } ?>

    <h2 class="sub-title">Changes</h2>

    <div class="clearboth"></div>
    
		
<p><strong>Changes Requested</strong></p>
<p>&nbsp;</p>
    
    </div>



    </div> 
      
    </div>
    

  </div><!-- /.tab-content -->

  </div><!-- END Projects --> 
  
  

<div class="span3">
<div class="cal-date">
<i class="icon-calendar"></i><h5>First Edit Delivered</h5><h4><?php echo $projectData->firstDelivery_PROJECT; ?></h4>
</div>
<div class="cal-date">
<i class="icon-calendar"></i><h5>Approval</h5><h4><?php echo $projectData->approval_PROJECT; ?></h4>
</div>
<div class="cal-date">
<i class="icon-calendar"></i><h5>Final Edit Delivered</h5><h4><?php echo $projectData->finalDelivery_PROJECT; ?></h4>
</div>
</div> 

 </div><! END DIV Active Project Info !>



</div>
</div>
</div>


        </div><!-- END Span 12 -->

    </div>

</div><!-- END Container -->


<div id ="project-edit" style="display:none;">



    <!----------------------------------------- EDIT Project -------------------------------------------------------------------->

      <h2 class="sub-title">EDIT <span style="font-weight: 200;">PROJECT</span></h2>

<div class="clearboth"></div>
<div class="container-fluid no-pad list-client">
    <div class="row-fluid">
    
   <form action="ajax/update_project.php" method="post" enctype="multipart/form-data" id="formProject" name="formProject">

    <div class="span4 first">
        <p>Project Title: <input type="text"  value="<?php echo $projectData->title_PROJECT; ?>" class="add-form"></p>
    </div>

    <div class="clearboth"></div>
<hr>

<! AREA Details !>

<div class="span6 first">
    <p>What do you want to achieve with the project?</p>
<textarea class="add-area"><?php echo $projectData->check1_achieve_PROJECT; ?></textarea>
</div>

<div class="span6">
    <p>What duration are the film(s) going to be?:</p>
    <textarea class="add-area"><?php echo $projectData->check4_duration_PROJECT; ?></textarea>

</div>

    <div class="clearboth"></div>

<hr>
<div class="span6 first">
    <p>How/where will the film(s) be viewed?</p>
<textarea class="add-area"><?php echo $projectData->check2_platform_PROJECT; ?></textarea>
</div>

<div class="span6">
    <p>What video format do you need the film(s) to be in?:</p>
    <textarea class="add-area"><?php echo $projectData->check3_format_PROJECT; ?></textarea>

</div>

    <div class="clearboth"></div>


<hr>
<div class="span6 first">
    <p>What graphics appear during the film(s)</p>
<textarea class="add-area"><?php echo $projectData->check5_graphics_PROJECT; ?></textarea>
</div>


    <div class="clearboth"></div>


<hr>

<! DELIVER Details !>


<div class="span4 first">
    First Edit Delivered: <input type="text" class="datepicker add-form" value="<?php if($projectData->date_firstDelivery_PROJECT != "0000-00-00") { echo $projectData->date_firstDelivery_PROJECT; } ?>"/>
</div>

<div class="span4">
    Client Feedback/Approval: <input type="text" class="datepicker add-form" value="<?php if($projectData->date_approval_PROJECT != "0000-00-00") { echo $projectData->date_approval_PROJECT; } ?>"/>
</div>

<div class="span4">
    Final Edit Delivered: <input type="text" class="datepicker add-form" value="<?php if($projectData->date_finalDelivery_PROJECT != "0000-00-00") { echo $projectData->date_finalDelivery_PROJECT; } ?>"/>
</div>

    <div class="clearboth"></div>
    
   </form>



    </div> <!-- END Row -->
</div> <!-- END Container -->
      


</div> <!-- END Div editProject -->



<!-- RELATED FILMS -->

<a id="films"></a>

  <?php $relatedFilms = fetchRelatedFilms($projectData->_kp_PROJECT,0); ?> 
  
    <?php if($relatedFilms) { ?> 

<div class="subpage-header">

    <div class="container">

        <div class="span9 first">
        <h1>PROJECT <span style="font-weight: 200;">FILMS</span></h1>
        </div>
    </div>
    
</div>
<div class="fold-single-full">
<div class="container">
    <div class="row">
<div class="span 12">


        <ul class="single-list-projects">

            <li>
            <div class="film-name table-top">FILM NAME</div>
            <div class="date-added table-top">DATE ADDED</div>
            </li>
  
 <?php while ($relatedFilmData = $relatedFilms->fetch_object()) { ?>      
            <li>
            <div class="film-name"><a href="/film/<?php echo $relatedFilmData->_kp_VIDEO; ?>/<?php echo titleURL($relatedFilmData->title_VIDEO); ?>"><?php echo $relatedFilmData->title_VIDEO; ?></a></div>
            <div class="date-added"><?php echo $relatedFilmData->added_VIDEO; ?></div>

        </li>
        
 <?php } // End While ?>
        
        </ul>
        
       <?php } ?> 
        
    </div>
</div>
    </div>
</div>


</body>

</html>
		
