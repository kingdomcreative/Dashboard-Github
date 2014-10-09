
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

<script type="text/javascript" language="JavaScript1.2">

<!--

function confirmDeleteProject(title)
{
	
var agree=confirm("Are you sure you wish to delete the Project - " + title + " ?");
if (agree)
	return true ;
else
	return false ;
}



</script>

<body>

  <?php include('includes/header.php'); ?> 


<div class="menu-header">
	<div class="container">

        <div class="span10 first">
		<h1><?php echo $projectData->name_CLIENT; ?> <span style="font-weight: 200;"><?php echo $projectData->title_PROJECT; ?></span></h1>
        </div>

        <div class="span2 staff">
        <img src="http://dashboard.circuitpro.co.uk/img/meet-<?php echo $staffData->username_STAFF; ?>.png">
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
        <a class="btn btn-warning" href="#" id="projectDetailToggle">TOGGLE INFO</a>
      </div>

<div class="span3 edit">
  <a class="btn btn-primary" href="#" id="projectEditToggle">EDIT PROJECT</a><a class="btn btn-success addFilmToggle" href="#">ADD FILM</a>
</div>
<! END Breadcrumbs !>




<?php if($projectData->status_PROJECT == "Active") { ?>
<div id="project-info">
<?php } else { ?><div id="project-info" style="display:none;"><?php } ?>

 <! Project Info !>
<div class="span9">

  <div class="tab-content tab-bg">

    <!-- projectAddFormDone --> <!-- SHOW ONCE A PROJECT HAS BEEN ADDED  -->

<div class="projectAddFormDone" style="display: none;">
<div class="container">
    <div class="row">
<div class="span6 offset3">
<h3>Your project has now been added!</h3>

<a class="btn btn-warning" href="/home">REFRESH PAGE</a>
</div>
</div>
</div>

</div> <!-- End projectAddFormDone -->

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

	      <?php if(!empty($projectData->clientContact_PROJECT)) { ?> 
	   <p><strong>Client Contact</strong><br><?php echo $projectData->clientContact_PROJECT; ?></p><?php } ?>

<?php if($projectData->_kf_staff_prodManager_PROJECT) {  ?>
 <p><strong>Production Manager</strong><br><?php printf('<a href="mailto:%s?subject=%s">%s <i class="icon-envelope-alt"></i></a>',$prodManagerData->email_STAFF,$projectData->title_PROJECT,$prodManagerData->name_STAFF); } ?></p>

<?php if($projectData->_kf_staff_creativeManager_PROJECT) {  ?>      
<p><strong>Creative Manager</strong><br><?php printf('<a href="mailto:%s?subject=%s&cc=%s">%s <i class="icon-envelope-alt"></i></a>',$creativeManagerData->email_STAFF,$projectData->title_PROJECT,$prodManagerData->email_STAFF,$creativeManagerData->name_STAFF); } ?></p>

<?php if($projectData->_kf_staff_editor_PROJECT) {  ?>  
<p><strong>Editor</strong><br><?php printf('<a href="mailto:%s?subject=%s&cc=%s">%s <i class="icon-envelope-alt"></i></a>',$editorData->email_STAFF,$projectData->title_PROJECT,$prodManagerData->email_STAFF,$editorData->name_STAFF); } ?></p>
    
    
    </div>
    
   
    <?php if($_GET['function'] == "changes") { ?>
    <div id="pane8" class="tab-pane active"><?php } else { ?>
    <div id="pane8" class="tab-pane"><?php } ?>
<div class="row-fluid">

<div class="span9">
    <h2 class="sub-title">Changes</h2>
    
   
</div>  


<!--  ONLY SHOW IF FILMS ARE IN PLACE -->
     <?php $projectFilms = fetchRelatedFilms($projectData->_kp_PROJECT,0); ?> 
      <?php if($projectFilms) { ?>  
    
    <span class="span3 edit"><a class="btn btn-success" href="#" id="changesFormToggle">ADD CHANGES</a></span></div>

    <div class="clearboth"></div>
    
	<div class="list-changes">

<?php $projectChanges = fetchAllProjectChanges($projectData->_kp_PROJECT); 

 while( $changeDetail = $projectChanges->fetch_object()) { ?>

 
     <h5><?php echo $changeDetail->film_CHANGES; ?></h5>
     
     <p>Added: <?php echo $changeDetail->shortname_STAFF; ?> on <?php echo $changeDetail->added_CHANGES; ?></p>
     
     <p><?php echo nl2br($changeDetail->content_CHANGES); ?></p>
     
     
     
     <hr />
     
      <?php } ?>

    </div>
      
     
      
      <div id="changesForm" style="display: none;">
      <form action="/ajax/add_changes.php" method="post" enctype="multipart/form-data" id="addChangesForm" name="addChangesForm"/>
      <input type="hidden" name="projectID" value="<?php echo $projectData->_kp_PROJECT; ?>"/>
      <input type="hidden" name="staffID" value="<?php echo $staffData->_kp_STAFF; ?>"/>
      <input type="hidden" name="projectTitle" value="<?php echo $projectData->title_PROJECT; ?>"/>
      <h5>ADD CHANGE REQUEST</h5>
      <p><select name="film" class="" style="width:200px">
       <?php while ($projectFilmData = $projectFilms->fetch_object()) { 
      
      printf('<option value="%s (version %d)">%s (version %d)</option>',$projectFilmData->title_VIDEO,$projectFilmData->version_VIDEO,$projectFilmData->title_VIDEO,$projectFilmData->version_VIDEO);
       } ?>
      </select></p>
      <p>
      <textarea class="add-area" name="changesContent"></textarea></p>
      <input type="submit" class="btn btn-success proj-form-sub" value="SAVE CHANGES">
      </form>
      </div>
      
      <?php } /* END IF FILMS ARE IN PLACE */ ?>

    
    </div>
</div>


    </div> 
      
    </div>
    

  </div><!-- /.tab-content -->

  <!-- END Projects --> 
  
  </div>

<div class="span3">
<div class="cal-date">
<i class="icon-calendar"></i><h5>First Edit Delivered</h5><h4><?php echo $projectData->firstDelivery_PROJECT; ?></h4>
</div>
<div class="cal-date">
<i class="icon-calendar"></i><h5>Approval</h5><h4><?php echo $projectData->approval_PROJECT; ?></h4>
</div>
<div class="cal-date first">
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

<div class="tab-edit">

  <!-- projectEditFormDone --> <!-- SHOW ONCE A PROJECT HAS BEEN ADDED  -->

<div class="projectEditFormDone" style="display: none;">
<div class="container">
    <div class="row">
<div class="span6 offset3">
<h3>Your project has now been updated!</h3>

<a class="btn btn-warning" href="/project/<?php echo $projectData->_kp_PROJECT; ?>/<?php echo titleURL($projectData->title_PROJECT); ?>">REFRESH</a>
</div>
</div>
</div>

</div> <!-- End projectEditFormDone -->

<div class="container">
    <div class="row">
 <form action="/ajax/update_project.php" method="post" enctype="multipart/form-data" id="projectUpdate" name="editProjectForm">
      <div class="span12"><h2 class="sub-title">EDIT </h2><input type="text" name="projTitle" value="<?php echo $projectData->title_PROJECT; ?>" class="add-form proj-title"> <div class="action-filter proj-save"><input type="submit" class="btn btn-success proj-form-sub" value="SAVE PROJECT"></div></div>
<div class="clearboth"></div>


<!-- TITLES -->
<div class="span6 highlight"><h3 class="first">DELIVERY <span style="font-weight: 200;">INFO</span></h3></div>

<div class="span6 highlight"><h3 class="first">PROJECT <span style="font-weight: 200;">STAFF</span></h3></div>

<div class="clearboth"></div>

<div class="span6 proj-info">
    <p>First Edit Delivered:</p> <input type="text" name="date_firstDelivery" class="datepicker add-form" value="<?php if($projectData->date_firstDelivery_PROJECT != "0000-00-00") { echo $projectData->date_firstDelivery_PROJECT; } ?>"/>

    <p>Client Feedback/Approval:</p> <input type="text" name="date_approval" class="datepicker add-form" value="<?php if($projectData->date_approval_PROJECT != "0000-00-00") { echo $projectData->date_approval_PROJECT; } ?>"/>

    <p>Final Edit Delivered:</p> <input type="text" name="date_finalDelivery" class="datepicker add-form" value="<?php if($projectData->date_finalDelivery_PROJECT != "0000-00-00") { echo $projectData->date_finalDelivery_PROJECT; } ?>"/>
</div>

<div class="span6 proj-info">
    <p>Production Manager:</p>
     <select name="prodMgr" class="" style="width:200px">
        <?php $prodManagerCurrent = fetchStaffviaID($projectData->_kf_staff_prodManager_PROJECT); ?>
        <?php printf('<option value="%d">%s</option>',$prodManagerCurrent->_kp_STAFF,$prodManagerCurrent->name_STAFF); ?> 
        <?php $prodManagerData = fetchStaffviaType("Production Manager",$prodManagerCurrent->_kp_STAFF); ?>
    <?php  while( $staffDetail = $prodManagerData->fetch_object()) {
     printf('<option value="%d">%s</option>',$staffDetail->_kp_STAFF,$staffDetail->name_STAFF); } ?>
    </select>


   <p>Creative Manager:</p>
    <select name="creativeMgr" class="" style="width:200px">
        <?php $creativeManagerCurrent = fetchStaffviaID($projectData->_kf_staff_creativeManager_PROJECT); ?>
        <?php printf('<option value="%d">%s</option>',$creativeManagerCurrent->_kp_STAFF,$creativeManagerCurrent->name_STAFF); ?> 
        <?php $creativeManagerData = fetchStaffviaType("Creative Manager",$creativeManagerCurrent->_kp_STAFF); ?>
    <?php  while( $staffDetail = $creativeManagerData->fetch_object()) {
     printf('<option value="%d">%s</option>',$staffDetail->_kp_STAFF,$staffDetail->name_STAFF); } ?>
    </select>



    <p>Editor:</p>
    <select name="editor" class="" style="width:200px">
        <?php $editorCurrent = fetchStaffviaID($projectData->_kf_staff_editor_PROJECT); ?>
        <?php printf('<option value="%d">%s</option>',$editorCurrent->_kp_STAFF,$editorCurrent->name_STAFF); ?> 
        <?php $editorData = fetchStaffviaType("Editor",$editorCurrent->_kp_STAFF); ?>
    <?php  while( $staffDetail = $editorData->fetch_object()) {
     printf('<option value="%d">%s</option>',$staffDetail->_kp_STAFF,$staffDetail->name_STAFF); } ?>
    </select>

</div>

<div class="span12 highlight"><h3 class="first">PROJECT <span style="font-weight: 200;">INFO</span></h3></div>
<div class="span12 proj-info">

    <div class="span6 first">
    <p>What do you want to achieve with the project?</p>
    <textarea class="add-area" name="check1"><?php echo $projectData->check1_achieve_PROJECT; ?></textarea>

    <p>How/where will the film(s) be viewed?</p>
    <textarea class="add-area"name="check2"><?php echo $projectData->check2_platform_PROJECT; ?></textarea>

    <p>What graphics appear during the film(s)</p>
<textarea class="add-area" name="check5"><?php echo $projectData->check5_graphics_PROJECT; ?></textarea>
</div>

<div class="span6">
    <p>What duration are the film(s) going to be?:</p>
    <textarea class="add-area" name="check4"><?php echo $projectData->check4_duration_PROJECT; ?></textarea>

<p>What video format do you need the film(s) to be in?:</p>
    <textarea class="add-area" name="check3"><?php echo $projectData->check3_format_PROJECT; ?></textarea>

<p>Any additional points to note?:</p>
<textarea class="add-area" name="notes_ext" id="notes_ext"><?php echo $projectData->notes_ext_PROJECT; ?></textarea>
</div>
</div>


<div class="span6 proj-info">
 <p>Internal Notes:</p>
 <textarea class="add-area" name="notes_int" id="notes_int"><?php echo $projectData->notes_int_PROJECT; ?></textarea>

</div>

<div class="span6 proj-info">
 <p>Client Contact:</p>
 <textarea class="add-area" name="client_contact" id="client_contact"><?php echo $projectData->clientContact_PROJECT; ?></textarea>

</div>

<div class="span6">
<p>Project is live: <?php if (empty($projectData->live_PROJECT)) { ?>
        <input name="live" type="checkbox" value="1" /><?php } else { ?>
        <input name="live" type="checkbox" value="1" checked="yes" /><?php } ?></p>

<p>Enable YouTube Stats Reporting:<?php if (empty($projectData->youtubeStats_PROJECT)) { ?>
        <input name="youtubeStats" type="checkbox" value="1" /><?php } else { ?>
        <input name="youtubeStats" type="checkbox" value="1" checked="yes" /><?php } ?></p>

<p>Project is completed:<?php if ($projectData->status_PROJECT != "Completed") { ?>
        <input name="completed" type="checkbox" value="" /><?php } else { ?>
        <input name="completed" type="checkbox" value="1" checked="yes"/><?php } ?></p>

<p><input name="projectID" type="hidden" value="<?php echo $projectData->_kp_PROJECT; ?>" />
        
        <input type="submit" class="btn btn-success proj-form-sub" value="SAVE PROJECT"> <?php printf('<a class="btn btn-danger" href="/ajax/delete_project.php?project=%d" id="deleteProject" onClick="return confirmDeleteProject(\'%s\')">DELETE PROJECT</a>',$projectData->_kp_PROJECT,$projectData->title_PROJECT); ?></p>
        
   
        
</div>

</form>



</div> <!-- END EDIT PROJECT -->
      

</div>
</div>
</div>
</div> <!-- END Div editProject -->

  

    <!----------------------------------------- ADD Films -------------------------------------------------------------------->

<div id="add-film" style="display:none;">
<div class="tab-add-film">

    <!-- filmAddFormDone --> <!-- SHOW ONCE A FILM HAS BEEN ADDED  -->

<div class="filmAddFormDone" style="display:none;">
<div class="container">
    <div class="row">
<div class="span6 offset3">
<h3>Your film has now been added!</h3>

<a class="btn btn-warning" href="/project/<?php echo $projectData->_kp_PROJECT; ?>/<?php echo titleURL($projectData->title_PROJECT); ?>">REFRESH PAGE</a>
</div>
</div>
</div>

</div> <!-- End filmAddFormDone -->


<div class="container">
    <div class="row">

<div class="filmAddForm">
<form class="form-horizontal" id="addFilm" method="post" action="/ajax/add_film.php" enctype="multipart/form-data" name="addFilm">

<input type="hidden" value="<?php echo $projectData->_kp_PROJECT; ?>" name="projectID">

<input type="hidden" value="<?php echo $projectData->_kf_staff_prodManager_PROJECT; ?>" name="prodMgrID">

<input type="hidden" value="<?php echo $staffData->shortname_STAFF; ?>" name="addedBy">

<?php if(!empty($projectData->viewingNotes_CLIENT)) { ?><div class="span12"><div class="alert"><i class="icon-bell"></i> CLIENT DELIVERY: <?php echo $projectData->viewingNotes_CLIENT; ?></div></div><?php } ?>

<div class="span12"><input type="text"  class="download-links-input add-film-title" id="form-title" name="filmTitle" value="ENTER FILM TITLE"></div>
</div>

<div class="span6 film-info">
<i class="icon-vimeo"></i> <input type="text" value=""  name="vimeoID" placeholder="Vimeo ID" id="vimeoID"><a href="https://vimeo.com/upload" alt="Vimeo Upload" target="_blank"><i class="icon-upload-alt"></i></a>
 <input type="text" value="" name="vimeoPassword" placeholder="Vimeo Password">
</div>

<div class="span6 film-info">
<input type="text" placeholder="YouTube ID" name="youtubeID" id="youtubeID">
</div>
<div class="span12 save-film"><a class="btn btn-danger addFilmToggle sngl-proj-sub" href="#">CANCEL</a><input type="submit" class="btn btn-success film-form-sub sngl-proj-sub" value="SAVE"></div>

</form>
</div> <!-- End filmAddForm -->




</div>
</div>
</div>
</div>

<!-- TASKS -->




<?php  if (strpos($staffData->type_STAFF, 'Production Manager') !== false) { 

 $taskData = fetchAllProjectTasks($projectData->_kp_PROJECT); 
	
	if($taskData->_kf_project_TASKS == $projectData->_kp_PROJECT) { ?>
	
	
	<?php $complete = fetchProjectTaskCompletion($projectData->_kp_PROJECT); 
	
	$totalComplete = $complete->completion_TASKS;
	
	$totalComplete = ($totalComplete / 26 ) * 100;
	
	$totalComplete = number_format($totalComplete,0);
?>

<div id="tasks">
<div class="container">
  <div class="span9 first">
         <h1>PROJECT <span style="font-weight: 200;">TASKS</span></h1>
        </div>

<div class="span3">
   <p class="time-stamp-task"><?php if(!empty($taskData->_staff_TASKS)) { ?>Last changed by <?php echo $taskData->_staff_TASKS; ?> on <?php echo $taskData->added_TASKS; } ?></p>
</div>

<div class="clearboth"></div>

<div class="span11 first">
  <div class="progress progress-striped active">
  <div class="bar" style="width: <?php echo $totalComplete; ?>%;"></div>
</div>
</div>

<div class="span1">


<?php echo $totalComplete; ?>%
</div>

<div class="clearboth"></div>

<ul class="single-list-tasks">

            <li><div class="film-name table-top-dark">TASK NAME</div>
            <div class="date-added table-top-dark">STATUS</div>
            </li>

<?php $taskCounter = 1; 

	while($taskCounter <= 26) {
	
	//Set up links for tasks and items
	$itemField = 'item'.$taskCounter.'_TASKS';
	
	$taskLink = '/ajax/add_task.php?task='.$taskCounter.'&project='.$projectData->_kp_PROJECT.'&addedBy='.$staffData->shortname_STAFF.'&title='.titleURL($projectData->title_PROJECT);
	
	//Set the labels for each task
	
	switch ($taskCounter) {
    case 1:
        $taskDetail = "Client site setup & checklist phone call";
        break;
    case 2:
         $taskDetail = "Client site checklist completed";
        break;
    case 3:
         $taskDetail = "Quote updated and e-mailed to Finance";
        break;
    case 4:
         $taskDetail = "PO Applied For";
        break;
    case 5:
         $taskDetail = "Set up project on E-mail";
        break;
    case 6:
         $taskDetail = "Set up project on accounts";
        break;
    case 7:
         $taskDetail = "Set up project on RAID";
        break;
     case 8:
         $taskDetail = "Schedule Filming and Editing";
        break;
     case 9:
         $taskDetail = "Book Travel";
        break;
     case 10:
         $taskDetail = "Book Accommodation";
        break;
     case 11:
         $taskDetail = "Equipment Available";
        break;
     case 12:
         $taskDetail = "Filming permission applied for";
        break;
     case 13:
         $taskDetail = "Filming permission granted";
        break;
     case 14:
         $taskDetail = "Add to monthly figures";
        break;
     case 15:
         $taskDetail = "Project Overview prepared and distributed";
        break;
     case 16:
         $taskDetail = "PO Received";
        break;
      case 17:
         $taskDetail = "Invoice";
        break;
      case 18:
         $taskDetail = "Invoice received";
        break;
      case 19:
         $taskDetail = "Film footage stored in two places";
        break;
      case 20:
         $taskDetail = "Editing";
        break;
      case 21:
         $taskDetail = "Editing changes";
        break;
      case 22:
         $taskDetail = "Approval from Client";
         if(empty($taskData->$itemField)) {
         $taskLink = '/ajax/add_task.php?task='.$taskCounter.'&project='.$projectData->_kp_PROJECT.'&addedBy='.$staffData->shortname_STAFF.'&title='.titleURL($projectData->title_PROJECT).'&approve=yes'; } else 		{ $taskLink = '/ajax/add_task.php?task='.$taskCounter.'&project='.$projectData->_kp_PROJECT.'&addedBy='.$staffData->shortname_STAFF.'&title='.titleURL($projectData->title_PROJECT);}
        break;
      case 23:
         $taskDetail = "Update client site";
        break;
      case 24:
         $taskDetail = "Email archive";
        break;
      case 25:
         $taskDetail = "Financial Report";
        break;
      case 26:
         $taskDetail = "Courtesy call and follow up";
        break;
      
        
        }	
	
	//Show variants for completed and non-completed tasks
	
		if(!empty($taskData->$itemField)) { ?>

		
            <li>
            <div class="task-name"><?php echo $taskDetail; ?></div>
            <div class="completed-task">
            <a class="btn btn-success" href="<?php echo $taskLink.'&uncheck=yes'; ?>"><i class="icon-ok"></i></a>
            </div>
            </li>
            
           <?php } else {
                     
           
            ?>
            
            
             <li>
            <div class="task-name"><?php echo $taskDetail; ?></div>
            <div class="completed-task"><a class="btn btn-danger" href="<?php echo $taskLink; ?>"><i class="icon-circle-blank"></i></a></div>
            </li>
            
            
            
            <?php
         
            }
            
            $taskCounter++;
            
             } ?>

           
        


</div>
</div>


<?php }  }  //Empty task data ?>



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
            <div class="film-name table-top-dark">FILM NAME</div>
            <div class="date-added table-top-dark">DATE ADDED</div>
            </li>
  
 <?php while ($relatedFilmData = $relatedFilms->fetch_object()) { ?>      
            <li>
            <div class="film-name"><a href="/film/<?php echo $relatedFilmData->_kp_VIDEO; ?>/<?php echo titleURL($relatedFilmData->title_VIDEO); ?>"><?php echo $relatedFilmData->title_VIDEO; ?></a>
            
            
            <?php
							    
							    //Show Youtube Stats if applicable 
							    
							    	if($projectData->youtubeStats_PROJECT || $relatedFilmData->youtubeID_VIDEO) {
								    $video_ID = $relatedFilmData->youtubeID_VIDEO;
								    $JSON = file_get_contents("https://gdata.youtube.com/feeds/api/videos/{$video_ID}?v=2&alt=json");
								    $JSON_Data = json_decode($JSON);
								    $views = $JSON_Data->{'entry'}->{'yt$statistics'}->{'viewCount'};
								    $rating = $JSON_Data->{'entry'}->{'yt$rating'}->{'numLikes'}; 
								    
								    
								    //Write back current number of YouTube views into our database
								    
								    if(!empty($views)) {
									    
									updateYoutubeViewCount($videoData->_kp_VIDEO,$views);
									    
								    }
								    
								    
								    ?>
								    
								    
								   
								    
							      <?php if(!empty($relatedFilmData->youtubeStats_VIDEO) && !empty($projectData->youtubeStats_PROJECT)) { ?><span class="stats"><a href="http://www.youtube.com/watch?v=<?php echo $relatedFilmData->youtubeID_VIDEO; ?>"><i class="icon-desktop"></i> Views: <strong><?php echo number_format($views); ?></strong> l <i class="icon-thumbs-up"></i> Likes: <strong><?php echo $rating; ?></strong></a></span> <?php } } ?>
            
            
            
            </div>
            <div class="date-added dark"><?php echo $relatedFilmData->added_VIDEO; ?></div>

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
		
