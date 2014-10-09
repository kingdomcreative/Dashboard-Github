
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
  
  <style>
  .navbar-nav li:nth-child(2) a {
	  background: #EE5555;
	  box-shadow: inset 0 0 5px rgba(0,0,0,0.1);
  }
  
  </style>


<!-- /PROJECT TITLE --> 
<div id="projectTitle">
<div class="row">
<div class="col-md-8">
<h2><?php echo $projectData->title_PROJECT; ?></h2>
</div>
<div class="col-md-4 align-right">
<a class="btn btn-primary-outline" href="#editProject" id="editProjectButton" data-toggle="tab">Edit project</a>
<a class="btn btn-primary" href="#addFilm" id="addFilmButton" data-toggle="tab">Add film</a>
</div>
</div>
</div>
<!-- /PROJECT TITLE -->

<!-- BREADCRUMBS -->
<div id="breadcrumbsTitle" class="hidden-xs">
<i class="fa fa-tag"></i><a href="/client/<?php echo $projectData->_kp_CLIENT; ?>/<?php echo $projectData->username_CLIENT; ?>"><?php echo $projectData->name_CLIENT; ?></a> <i class="fa fa-angle-right"></i> <a href="/project/<?php echo $projectData->_kp_PROJECT; ?>/<?php echo titleURL($projectData->title_PROJECT); ?>"><?php echo $projectData->title_PROJECT; ?></a>
</div>
<!-- / BREADCRUMBS -->


    <div class="container" id="active-projects">
      <!-- Example row of columns -->    
      <div class="row" id="project-full">
      
       <div class="col-xs-3 col-sm-2 col-md-1 project-tabs">
       <ul>
       <li class="active"><a href="#aims" data-toggle="tab" data-toggle="tooltip" data-placement="right" title="Brief"><i class="fa fa-bars"></i></a></li>
       <li><a href="#notes" data-toggle="tab" data-toggle="tooltip" data-placement="right" title="Notes"><i class="fa fa-thumb-tack"></i></a></li>
       <?php if($projectFilms) { ?> <li><a href="#changes" data-toggle="tab" data-toggle="tooltip" data-placement="right" title="Changes"><i class="fa fa-copy"></i></a></li><?php } ?>
       <li><a href="#report" data-toggle="tab" data-toggle="tooltip" data-placement="right" title="Report"><i class="fa fa-clipboard" v></i></a></li>
       <li><a href="#editProject" data-toggle="tab" data-toggle="tooltip" data-placement="right" title="Edit Project"><i class="fa fa-edit" v></i></a></li>
       <li><a href="#addFilm" data-toggle="tab" data-toggle="tooltip" data-placement="right" title="Add film"><i class="fa fa-plus" v></i></a></li>

       
       </ul>
       </div>


       <div class="tab-content">
      
      <div class="col-xs-9 col-sm-10 col-md-7 projects tab-pane active" id="aims">
      
      
	  <!-- BRIEF INFO -->      
      <div class="wrap">
      <h2>Brief Information</h2>
   
      <div id="section-tabs">
      
    <!-- AIMS -->
    <?php if(!empty($projectData->brief1_aims_PROJECT)) { ?>
    <h5 class="sub-title">What is the aim of the project?</h5>
    <p><?php echo nl2br($projectData->brief1_aims_PROJECT); ?></p>
    <hr>
    <?php } ?>
    
    <!-- AUDIENCE -->
    <?php if(!empty($projectData->brief2_audience_PROJECT)) { ?>
    <h5 class="sub-title">What is the intended audience?</h5>
    <p><?php echo nl2br($projectData->brief2_audience_PROJECT); ?></p>
     <hr>
    <?php } ?>
    
    <!-- BROADCAST -->
    <?php if(!empty($projectData->brief3_broadcast_PROJECT)) { ?>
    <h5 class="sub-title">Broadcast Channel</h5>
    <p><?php echo nl2br($projectData->brief3_broadcast_PROJECT); ?></p>
     <hr>
    <?php } ?>
    
    <!-- KEYPOINTS -->
    <?php if(!empty($projectData->brief4_keypoints_PROJECT)) { ?>
    <h5 class="sub-title">Key points to be included</h5>
    <p><?php echo nl2br($projectData->brief4_keypoints_PROJECT); ?></p>
     <hr>
    <?php } ?>
    
    <!-- DURATION -->
    <?php if(!empty($projectData->brief5_duration_PROJECT)) { ?>
    <h5 class="sub-title">Duration</h5>
    <p><?php echo nl2br($projectData->brief5_duration_PROJECT); ?></p>
     <hr>
    <?php } ?>
    
    <!-- STYLE -->
    <?php if(!empty($projectData->brief6_style_PROJECT)) { ?>
    <h5 class="sub-title">Duration</h5>
    <p><?php echo nl2br($projectData->brief6_style_PROJECT); ?></p>
     <hr>
    <?php } ?>
    
    <!-- EXAMPLE -->
    <?php if(!empty($projectData->brief7_examples_PROJECT)) { ?>
    <h5 class="sub-title">Example Films</h5>
    <p><?php echo nl2br(createLinks($projectData->brief7_examples_PROJECT)); ?></p>
     <hr>
    <?php } ?>
    
    <!-- CAMPAIGN -->
    <?php if(!empty($projectData->brief8_campaign_PROJECT)) { ?>
    <h5 class="sub-title">Part of a campaign?</h5>
    <p><?php echo nl2br($projectData->brief8_campaign_PROJECT); ?></p>
     <hr>
    <?php } ?>
    
    <!-- AUDIENCE -->
    <?php if(!empty($projectData->brief9_graphics_PROJECT)) { ?>
    <h5 class="sub-title">What graphics are required?</h5>
    <p><?php echo nl2br($projectData->brief9_graphics_PROJECT); ?></p>
     <hr>
    <?php } ?>
    
    <!-- SUCCESS -->
    <?php if(!empty($projectData->brief10_success_PROJECT)) { ?>
    <h5 class="sub-title">How will the success of the project be measured?</h5>
    <p><?php echo nl2br($projectData->brief10_success_PROJECT); ?></p>
     <hr>
    <?php } ?>
    
    <!-- APPROVAL -->
    <?php if(!empty($projectData->brief_clientApproval_PROJECT)) { ?>
    <h5 class="sub-title">Who has ultimate approval of the project?</h5>
    <p><?php echo nl2br($projectData->brief_clientApproval_PROJECT); ?></p>
     <hr>
    <?php } ?>

      
      </div>  
         
      </div>
      </div>
      <!-- BRIEF INFO -->        
      
      
      <!-- NOTES -->
      <div class="col-xs-9 col-sm-10 col-md-7 projects tab-pane" id="notes">
      <div class="wrap">
      <h2>Notes</h2>
   
      <div id="section-tabs">
      
      <h5 class="sub-title">Any additional points to note?</h5>
      
     <p><?php echo nl2br($projectData->notes_int_PROJECT); ?></p>
      
      </div>  
         
      </div>
      </div>
      <!-- /NOTES -->
      
      
      
      <div class="col-xs-9 col-sm-10 col-md-7 projects tab-pane" id="changes">
      <div class="wrap">
      <div class="row">
      <div class="col-md-8"><h2>Changes</h2></div>
      <div class="col-md-4 align-right tight-right"><a class="btn btn-primary" id="addChanges">Add changes</a></div>
      </div>
   
      <div id="section-tabs">
      
      <div id="change">
      
      <h5 class="sub-title">Add changes request</h5>
      
      <?php $projectFilms = fetchRelatedFilms($projectData->_kp_PROJECT,0); ?> 

      <form action="/ajax/add_changes.php" method="post" enctype="multipart/form-data" id="addChangesForm" name="addChangesForm"/>
      <input type="hidden" name="projectID" value="<?php echo $projectData->_kp_PROJECT; ?>"/>
      <input type="hidden" name="staffID" value="<?php echo $staffData->_kp_STAFF; ?>"/>
      <input type="hidden" name="projectTitle" value="<?php echo $projectData->title_PROJECT; ?>"/>

      <p><textarea class="form-control" rows="3" name="changesContent"></textarea></p>
       
      <p><select name="film" class="form-control"><?php while ($projectFilmData = $projectFilms->fetch_object()) { $version = $projectFilmData->version_VIDEO;
      printf('<option value="%s (version %d)">%s (version %d)</option>',$projectFilmData->title_VIDEO,$projectFilmData->version_VIDEO,$projectFilmData->title_VIDEO,$projectFilmData->version_VIDEO); } ?></select></p>
      
      <input type="submit" class="btn btn-primary" value="Save changes">
      </form>
      
      <hr>
      
      </div> <!-- /CHANGE -->
      
      <?php $projectChanges = fetchAllProjectChanges($projectData->_kp_PROJECT); while( $changeDetail = $projectChanges->fetch_object()) { ?>
      
      <!-- BEGIN LOOP -->
      
      <h5 class="sub-title"><?php echo $changeDetail->film_CHANGES; ?></h5>
      
      <span class="changes-info"><i class="fa fa-user"></i><?php echo $changeDetail->shortname_STAFF; ?><span class="date"><?php echo $changeDetail->added_CHANGES; ?></span><span class="version">Version <?php echo $version; ?></span></span>
      <p><?php echo nl2br($changeDetail->content_CHANGES); ?></p>
      
      <hr>
      
      <!-- END LOOP -->
 

      <?php } ?>
      
      </div> <!-- /COL -->
      </div> <!-- /WRAP -->
      </div>
      
      
      
      <!-- REPORT -->
      
      <div class="col-xs-9 col-sm-10 col-md-7 projects tab-pane" id="report">
      <div class="wrap">
       <div class="row">
      <div class="col-md-8"><h2>Report</h2></div>
      <div class="col-md-4 align-right tight-right"><?php  if (strpos($staffData->type_STAFF, 'Production Manager') !== false) { ?><a class="btn btn-primary" id="addHours">Add hours</a><?php } ?></div>
      </div>

   
      <div id="section-tabs">
      
      <!-- HOURS -->
      <div id="hours">
      
      <h5 class="sub-title">Add hours</h5>
      
      <div class="row">
      <form action="/ajax/add_hours.php" method="post" enctype="multipart/form-data" id="addTimeForm" name="addTimeForm"/>
      <input type="hidden" name="projectID" value="<?php echo $projectData->_kp_PROJECT; ?>"/>
      <input type="hidden" name="projectTitle" value="<?php echo $projectData->title_PROJECT; ?>"/>
      
      <div class="col-md-3">
      <label>Category</label>
          <select name="hours_type" class="form-control">
	          <option value="planning">Planning</option>
	          <option value="filming">Filming</option>
	          <option value="travel">Travel</option>
	          <option value="editing">Editing</option>
	          <option value="graphics">Graphics</option>
	          <option value="web">Web Development</option>
	          <option value="changes">Changes</option>
	          <!--  <option value="delivery">Delivery</option>  -->
      </select>
      </div>
      
      <div class="col-md-2">
      <label>Hours</label>
          <input type="text" placeholder="0.00" name="hours_value" class="form-control">
      </div>
      
      <div class="col-md-3">
      <label>Date</label>
      <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
          <input type="text" placeholder="Select date"  name="hours_date" class="form-control datepicker">
        </div>
      </div>
      
      <div class="col-md-3">
      <label>Staff</label>
          <select name="staff" class="form-control">
	          <?php $staffChanges = fetchStaffviaType("ALL",0); ?>
	          <?php  while( $staffDetail = $staffChanges->fetch_object()) {
		      printf('<option value="%d">%s</option>',$staffDetail->_kp_STAFF,$staffDetail->name_STAFF); } ?>
    </select>
      </div>
	  
	  <div class="col-md-1 update">
	  <input type="submit" class="btn btn-primary" value="Update">
	  </div>
      </div>
	  
	  <div class="clearboth"></div>
	 
	  <hr>

      </form>

	  
      </div> 
      <!-- /HOURS -->
      
      
      <h5 class="sub-title">Your project report</h5>
      <table class="table table-bordered">
      <thead>
        <tr class="white">
          <th>Subject</th>
          <th>Progress</th>
        </tr>
      </thead>
      <tbody>
      
      <!-- PLANNING -->
      <?php if($projectData->hours_initial_planning_PROJECT > 0) { 
		
		$planning_initial = number_format($projectData->hours_initial_planning_PROJECT,2);
		$planning_actual = number_format(fetchProjectHoursByType($projectData->_kp_PROJECT,"planning"),2); ?>
		
		<?php $planning_percent = ($planning_actual / $planning_initial)*100;?>
		
        <tr>
          <td>Planning</td>
          <td><?php if ($planning_actual > $planning_initial) {  $planningOver = $planning_actual - $planning_initial; ?>
          <p><span class="primary-text"><?php echo $planning_actual; ?></span> / <?php echo $planning_initial; ?> hours used <?php echo '<span class="label label-danger"> '.number_format($planningOver,2).'hrs over</span>'; ?></p>
	
          <?php  } else { 	
	      $planningUnder = $planning_initial - $planning_actual; ?>
	      <p><?php echo $planning_actual; ?> / <?php echo $planning_initial; ?> hours used <?php } ?></p>
	
          <div class="progress">
	          <div class="progress-bar <?php if($planning_percent >= 0 && $planning_percent <= 80) { echo "dark"; } elseif($planning_percent >= 81) { echo "primary"; } ?>" role="progressbar" style="width: <?php echo $planning_percent; ?>%"></div><?php } elseif ($planning_percent > 80) { ?>
		      </div>
		  </div>
		</td>
      </tr>

        <?php } ?>
        <!-- END PLANNING -->
        
        <!-- FILMING -->
      <?php if($projectData->hours_initial_filming_PROJECT > 0) { 
		
		$filming_initial = number_format($projectData->hours_initial_filming_PROJECT,2);
		$filming_actual = number_format(fetchProjectHoursByType($projectData->_kp_PROJECT,"filming"),2); ?>
		
		<?php $filming_percent = ($filming_actual / $filming_initial)*100;?>
		
        <tr>
          <td>Filming</td>
          <td><?php if ($filming_actual > $filming_initial) {  $filmingOver = $filming_actual - $filming_initial; ?>
          <p><span class="primary-text"><?php echo $filming_actual; ?></span> / <?php echo $filming_initial; ?> hours used <?php echo '<span class="label label-danger"> '.number_format($filmingOver,2).'hrs over</span>'; ?></p>
	
          <?php  } else { 	
	      $filmingUnder = $filming_initial - $filming_actual; ?>
	      <p><?php echo $filming_actual; ?> / <?php echo $filming_initial; ?> hours used <?php } ?></p>
	
          <div class="progress">
	          <div class="progress-bar <?php if($filming_percent >= 0 && $filming_percent <= 80) { echo "dark"; } elseif($filming_percent >= 81) { echo "primary"; } ?>" role="progressbar" style="width: <?php echo $filming_percent; ?>%"></div><?php } elseif ($filming_percent > 80) { ?>
		      </div>
		  </div>
		</td>
      </tr>

        <?php } ?>
        <!-- END FILMING -->
        
        <!-- EDITING -->
      <?php if($projectData->hours_initial_editing_PROJECT > 0) { 
		
		$editing_initial = number_format($projectData->hours_initial_editing_PROJECT,2);
		$editing_actual = number_format(fetchProjectHoursByType($projectData->_kp_PROJECT,"editing"),2); ?>
		
		<?php $editing_percent = ($editing_actual / $editing_initial)*100;?>
		
        <tr>
          <td>Editing</td>
          <td><?php if ($editing_actual > $editing_initial) {  $editingOver = $editing_actual - $editing_initial; ?>
          <p><span class="primary-text"><?php echo $editing_actual; ?></span> / <?php echo $editing_initial; ?> hours used <?php echo '<span class="label label-danger"> '.number_format($editingOver,2).'hrs over</span>'; ?></p>
	
          <?php  } else { 	
	      $editingUnder = $editing_initial - $editing_actual; ?>
	      <p><?php echo $editing_actual; ?> / <?php echo $editing_initial; ?> hours used <?php } ?></p>
	
          <div class="progress">
	          <div class="progress-bar <?php if($editing_percent >= 0 && $editing_percent <= 80) { echo "dark"; } elseif($editing_percent >= 81) { echo "primary"; }  ?>" role="progressbar" style="width: <?php echo $editing_percent; ?>%"></div><?php } elseif ($editing_percent > 80) { ?>
		      </div>
		  </div>
		</td>
      </tr>

        <?php } ?>
        <!-- END EDITING -->
        
        
     <!-- GRAPHICS -->
      <?php if($projectData->hours_initial_graphics_PROJECT > 0) { 
		
		$graphics_initial = number_format($projectData->hours_initial_graphics_PROJECT,2);
		$graphics_actual = number_format(fetchProjectHoursByType($projectData->_kp_PROJECT,"graphics"),2); ?>
		
		<?php $graphics_percent = ($graphics_actual / $graphics_initial)*100;?>
		
        <tr>
          <td>Graphics</td>
          <td><?php if ($graphics_actual > $graphics_initial) {  $graphicsOver = $graphics_actual - $graphics_initial; ?>
          <p><span class="primary-text"><?php echo $graphics_actual; ?></span> / <?php echo $graphics_initial; ?> hours used <?php echo '<span class="label label-danger"> '.number_format($graphicsOver,2).'hrs over</span>'; ?></p>
	
          <?php  } else { 	
	      $graphicsUnder = $graphics_initial - $changes_actual; ?>
	      <p><?php echo $graphics_actual; ?> / <?php echo $graphics_initial; ?> hours used <?php } ?></p>
	
          <div class="progress">
	          <div class="progress-bar <?php if($graphics_percent >= 0 && $graphics_percent <= 80) { echo "dark"; } elseif($graphics_percent >= 81) { echo "primary"; } ?>" role="progressbar" style="width: <?php echo $graphics_percent; ?>%"></div><?php } elseif ($graphics_percent > 80) { ?>
		      </div>
		  </div>
		</td>
      </tr>

        <?php } ?>
        <!-- END GRAPHICS -->

        
        <!-- CHANGES -->
      <?php if($projectData->hours_initial_changes_PROJECT > 0) { 
		
		$changes_initial = number_format($projectData->hours_initial_changes_PROJECT,2);
		$changes_actual = number_format(fetchProjectHoursByType($projectData->_kp_PROJECT,"changes"),2); ?>
		
		<?php $changes_percent = ($changes_actual / $changes_initial)*100;?>
		
        <tr>
          <td>Changes</td>
          <td><?php if ($changes_actual > $changes_initial) {  $changesOver = $changes_actual - $changes_initial; ?>
          <p><span class="primary-text"><?php echo $changes_actual; ?></span> / <?php echo $changes_initial; ?> hours used <?php echo '<span class="label label-danger"> '.number_format($changesOver,2).'hrs over</span>'; ?></p>
	
          <?php  } else { 	
	      $changesUnder = $changes_initial - $changes_actual; ?>
	      <p><?php echo $changes_actual; ?> / <?php echo $changes_initial; ?> hours used <?php } ?></p>
	
          <div class="progress">
	          <div class="progress-bar <?php if($changes_percent >= 0 && $changes_percent <= 80) { echo "dark"; } elseif($changes_percent >= 81) { echo "primary"; } ?>" role="progressbar" style="width: <?php echo $changes_percent; ?>%"></div><?php } elseif ($changes_percent > 80) { ?>
		      </div>
		  </div>
		</td>
      </tr>

        <?php } ?>
        <!-- END CHANGES -->
      </tbody>
    </table>
      		
		
      </div>  
         
      </div> <!-- /WRAP -->
      </div>
      <!-- /REPORT -->
      
      
   
      
      
      <!-- EDIT PROJECT -->

<div class="col-xs-9 col-sm-10 col-md-7 projects tab-pane" id="editProject">
      <div class="wrap">
      <div class="row">
      
      <form action="/ajax/update_project.php" method="post" enctype="multipart/form-data" id="projectUpdate" name="editProjectForm">
      
      <div class="col-md-8"><h2>Edit Project title</h2></div>
      <div class="col-md-4 align-right tight-right"><?php printf('<a class="btn btn-primary-outline" href="/ajax/delete_project.php?project=%d" id="deleteProject" onClick="return confirmDeleteProject(\'%s\')"><i class="fa fa-trash-o"></i></a>',$projectData->_kp_PROJECT,$projectData->title_PROJECT); ?> <input type="submit" class="btn btn-primary proj-form-sub" value="Save" id="saveProjectButton"></div>
      </div>
   
      <div id="section-tabs">
      
      <h5 class="sub-title">General Information</h5>
      
      <div class="row">
      
      <div class="col-md-7 col-lg-9">
      <label>Project title</label>

      <input type="text" name="projTitle" value="<?php echo $projectData->title_PROJECT; ?>" class="form-control">
      </div>
      
      <div class="col-md-4 col-lg-3">
      <?php echo $projectData->name_CLIENT; ?> <?php echo $projectData->added_PROJECT; ?>
      </div>
      
      <div class="clearboth"></div> 
      
      <div class="col-md-12">
      <hr>
      <h5 class="sub-title">Deliverables</h5>
      </div>
            
      <div class="col-md-6 col-lg-3">
      <label>Filming date delivery</label>
      <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
          <input type="text" name="date_filming" value="<?php if($projectData->date_filming_PROJECT != "0000-00-00") { echo $projectData->date_filming_PROJECT; } ?>" class="form-control datepicker">
        </div>
      </div>
      
      <div class="col-md-6 col-lg-3">
      <label>First edit delivery</label>
      <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
          <input type="text" name="date_firstDelivery" value="<?php if($projectData->date_firstDelivery_PROJECT != "0000-00-00") { echo $projectData->date_firstDelivery_PROJECT; } ?>" class="form-control datepicker">
        </div>
      </div>
      
      <div class="col-md-6 col-lg-3">
      <label>Client feedback</label>
      <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
          <input type="text" name="date_approval" value="<?php if($projectData->date_approval_PROJECT != "0000-00-00") { echo $projectData->date_approval_PROJECT; } ?>" class="form-control datepicker">
        </div>
      </div>
      
      <div class="col-md-6 col-lg-3">
      <label>Final edit delivered</label>
      <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
          <input type="text" name="date_finalDelivery" value="<?php if($projectData->date_finalDelivery_PROJECT != "0000-00-00") { echo $projectData->date_finalDelivery_PROJECT; } ?>" class="form-control datepicker">
        </div>
      </div>
      
      <div class="clearboth"></div> 
      
      <div class="col-md-12">
      <hr>
      <h5 class="sub-title">Staff</h5>
      </div>
      
      <div class="col-md-6 col-lg-3">
      <label>Production Manager</label>
      <select name="prodMgr" class="form-control" placeholder="Choose member">
        <?php $prodManagerCurrent = fetchStaffviaID($projectData->_kf_staff_prodManager_PROJECT); ?>
        <?php if(empty($projectData->_kf_staff_prodManager_PROJECT)) { echo '<option value="">Select...</option>'; } else { printf('<option value="%d">%s</option>',$prodManagerCurrent->_kp_STAFF,$prodManagerCurrent->name_STAFF); } ?> 
        <?php $prodManagerData = fetchStaffviaType("Production Manager",$prodManagerCurrent->_kp_STAFF); ?>
        <?php  while( $staffDetail = $prodManagerData->fetch_object()) {
     printf('<option value="%d">%s</option>',$staffDetail->_kp_STAFF,$staffDetail->name_STAFF); } ?>
    </select>
    
      </div>
      
      <div class="col-md-6 col-lg-3">
      <label>Creative Manager</label>
       <select name="creativeMgr" class="form-control" placeholder="Choose member">
        <?php $creativeManagerCurrent = fetchStaffviaID($projectData->_kf_staff_creativeManager_PROJECT); ?>
        <?php if(empty($projectData->_kf_staff_creativeManager_PROJECT)) { echo '<option value="">Select...</option>'; } else { printf('<option value="%d">%s</option>',$creativeManagerCurrent->_kp_STAFF,$creativeManagerCurrent->name_STAFF); } ?> 
        <?php $creativeManagerData = fetchStaffviaType("Creative Manager",$creativeManagerCurrent->_kp_STAFF); ?>
        <?php  while( $staffDetail = $creativeManagerData->fetch_object()) {
     printf('<option value="%d">%s</option>',$staffDetail->_kp_STAFF,$staffDetail->name_STAFF); } ?>
    </select>
      </div>
      
      <div class="col-md-6 col-lg-3">
      <label>Editor</label>
      <select name="editor" class="form-control" placeholder="Choose member">
        <?php $editorCurrent = fetchStaffviaID($projectData->_kf_staff_editor_PROJECT); ?>
       <?php if(empty($projectData->_kf_staff_editor_PROJECT)) { echo '<option value="">Select...</option>'; } else { printf('<option value="%d">%s</option>',$editorCurrent->_kp_STAFF,$creativeManagerCurrent->name_STAFF); } ?>  
        <?php $editorData = fetchStaffviaType("Editor",$editorCurrent->_kp_STAFF); ?>
        <?php  while( $staffDetail = $editorData->fetch_object()) {
     printf('<option value="%d">%s</option>',$staffDetail->_kp_STAFF,$staffDetail->name_STAFF); } ?>
    </select>

      </div>
      
      <div class="col-md-6 col-lg-3">
      <label>Designer</label>
          <input type="text" placeholder="Choose member" class="form-control">
      </div>
	  
	  <div class="clearboth"></div>
	  
	  
	  <div class="col-md-12">
      <hr>
      <h5 class="sub-title">The Brief</h5>
      </div>
      
      <div class="col-md-12 col-lg-6">
      <label>What is the aim of the project?</label> 
      	<textarea name="brief1" class="form-control" rows="5"><?php echo $projectData->brief1_aims_PROJECT; ?></textarea>
      </div>
      
      <div class="col-md-12 col-lg-6">
      <label>Who is the intended audience?</label>
          <textarea name="brief2" class="form-control" rows="5"><?php echo $projectData->brief2_audience_PROJECT; ?></textarea>
      </div>
	  
	  <div class="clearboth"></div>
	  
	  <div class="col-md-12 col-lg-6">
      <label>Broadcast Channel</label>
      	<textarea name="brief3" class="form-control" rows="5"><?php echo $projectData->brief3_broadcast_PROJECT; ?></textarea>
      </div>
      
      <div class="col-md-12 col-lg-6">
      <label>Key points which need to be included</label>
          <textarea name="brief4" class="form-control" rows="5"><?php echo $projectData->brief4_keypoints_PROJECT; ?></textarea>
      </div>
      
      <div class="clearboth"></div>
	  
	  <div class="col-md-12 col-lg-6">
      <label>Duration</label>
      	<textarea name="brief5" class="form-control" rows="5"><?php echo $projectData->brief5_duration_PROJECT; ?></textarea>
      </div>
      
      <div class="col-md-12 col-lg-6">
      <label>Style</label>
          <textarea name="brief6" class="form-control" rows="5"><?php echo $projectData->brief6_style_PROJECT; ?></textarea>
      </div>
      
      <div class="clearboth"></div>
	  
	  <div class="col-md-12 col-lg-6">
      <label>Example Films</label>
      	<textarea name="brief7" class="form-control" rows="5"><?php echo $projectData->brief7_examples_PROJECT; ?></textarea>
      </div>
      
      <div class="col-md-12 col-lg-6">
      <label>Is this part of a campaign?</label>
          <textarea name="brief8" class="form-control" rows="5"><?php echo $projectData->brief8_campaign_PROJECT; ?></textarea>
      </div>
      
       <div class="clearboth"></div>
	  
	  <div class="col-md-12 col-lg-6">
      <label>What graphics are required?</label>
      	<textarea name="brief9" class="form-control" rows="5"><?php echo $projectData->brief9_graphics_PROJECT; ?></textarea>
      </div>
      
      <div class="col-md-12 col-lg-6">
      <label>How will the success of the project be measured?</label>
          <textarea name="brief10" class="form-control" rows="5"><?php echo $projectData->brief10_success_PROJECT; ?></textarea>
      </div>

      <div class="clearboth"></div> 
      
      <div class="col-md-12 col-lg-6">
      <label>Internal Notes:</label>
      	<textarea name="notes_int" class="form-control" rows="5"><?php echo $projectData->notes_int_PROJECT; ?></textarea>
      </div>
      
      <div class="col-md-12 col-lg-6">
      <label>Who has ultimate project approval?</label>
          <textarea name="client_approval" class="form-control" rows="5"><?php echo $projectData->brief_clientApproval_PROJECT; ?></textarea>
      </div>

      <div class="clearboth"></div> 
      
      <div class="col-md-12">
      <hr>
      <h5 class="sub-title">Quoted hours</h5>
      </div>
      
      <div class="col-sm-6 col-md-4 col-lg-2">
      <label>Planning</label>
          <input type="text" name="hours_planning" value="<?php echo $projectData->hours_initial_planning_PROJECT; ?>" class="form-control">
      </div>
      
      <div class="col-sm-6 col-md-4 col-lg-2">
      <label>Filming</label>
          <input type="text" name="hours_filming" value="<?php echo $projectData->hours_initial_filming_PROJECT; ?>" class="form-control">
      </div>
      
      <div class="col-sm-6 col-md-4 col-lg-2">
      <label>Editing</label>
          <input type="text" name="hours_editing" value="<?php echo $projectData->hours_initial_editing_PROJECT; ?>" class="form-control">
      </div>
      
      <div class="col-sm-6 col-md-4 col-lg-2">
      <label>Graphics</label>
          <input type="text" name="hours_graphics"  value="<?php echo $projectData->hours_initial_graphics_PROJECT; ?>" class="form-control">
      </div>
	  
	  <div class="col-sm-6 col-md-4 col-lg-2">
      <label>Changes</label>
          <input type="text" name="hours_changes" value="<?php echo $projectData->hours_initial_changes_PROJECT; ?>" class="form-control">
      </div>

      <div class="clearboth"></div>
      
      <div class="col-md-12">
      <hr>
      </div>
      
      <div class="col-sm-6 col-md-4 col-lg-2">
      <?php printf('<a class="btn btn-primary-outline" href="/ajax/delete_project.php?project=%d" id="deleteProject" onClick="return confirmDeleteProject(\'%s\')"><i class="fa fa-trash-o"></i></a>',$projectData->_kp_PROJECT,$projectData->title_PROJECT); ?> <input type="submit" class="btn btn-primary proj-form-sub" value="Save" id="saveProjectButton">
      </div>
	  
	  <div class="col-sm-6 col-md-8 col-lg-4">
      <p><?php if (empty($projectData->live_PROJECT)) { ?>
        <input name="live" type="checkbox" value="1" /><?php } else { ?>
        <input name="live" type="checkbox" value="1" checked="yes" /><?php } ?> Project is live </p>

<p><?php if (empty($projectData->youtubeStats_PROJECT)) { ?>
        <input name="youtubeStats" type="checkbox" value="1" /><?php } else { ?>
        <input name="youtubeStats" type="checkbox" value="1" checked="yes" /><?php } ?> Enable YouTube Stats Reporting</p>

<p><?php if ($projectData->status_PROJECT != "Completed") { ?>
        <input name="completed" type="checkbox" value="" /><?php } else { ?>
        <input name="completed" type="checkbox" value="1" checked="yes"/><?php } ?> Project is completed</p>

<p><input name="projectID" type="hidden" value="<?php echo $projectData->_kp_PROJECT; ?>" />
	  </div>
	  
	  <div class="col-sm-6 col-md-4 col-lg-2">
	  <label>Brief Completed By</label>
    <select name="brief_staff" class="form-control">
        <?php $briefStaffCurrent = fetchStaffviaID($projectData->_kf_staff_brief_PROJECT); ?>
        <?php if (empty($projectData->_kf_staff_brief_PROJECT)) { echo '<option value="">Select...</option>'; } else { printf('<option value="%d">%s</option>',$briefStaffCurrent->_kp_STAFF,$briefStaffCurrent->name_STAFF); } ?> 
        <?php $briefStaffData = fetchStaffviaType("ALL"); ?>
    <?php  while( $staffDetail = $briefStaffData->fetch_object()) {
     printf('<option value="%d">%s</option>',$staffDetail->_kp_STAFF,$staffDetail->name_STAFF); } ?>
    </select>
    </div>

    <div class="col-sm-6 col-md-4 col-lg-2">
	<label>Brief Completion Date</label>
      <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
          <input type="text" name="date_brief" value="<?php if($projectData->_completed_brief_PROJECT != "0000-00-00") echo $projectData->_completed_brief_PROJECT; ?>" class="form-control datepicker">
        </div>
    </div>
   
      </form>
      
      </div>
      
      
      </div>

      
      </div> <!-- /WRAP -->
      </div>
      <!-- /EDIT PROJECT -->


      <div class="filmAddFormDone">
    
	      <div class="container">
    <div class="row">
    
    <div class="spinner">
      	<div class="bounce1"></div>
      	<div class="bounce2"></div>
      	<div class="bounce3"></div>
    </div>
    
	    <div  id="show_loading">
		    <h3>Your film has now been added!</h3>

		    <a class="btn btn-primary" href="/project/<?php echo $projectData->_kp_PROJECT; ?>/<?php echo titleURL($projectData->title_PROJECT); ?>">REFRESH PAGE</a>

		    </div>
		    </div>
		    </div>

		    </div>

      <!-- ADD FILM -->
      <div class="col-xs-9 col-sm-10 col-md-7 projects tab-pane" id="addFilm">
      <div class="wrap">
      <div class="row">
      
      <form class="form-horizontal" id="addFilm" method="post" action="/ajax/add_film.php" enctype="multipart/form-data" name="addFilm">
      <div class="col-md-8"><h2>Add a film</h2></div>
      <div class="col-md-4 align-right tight-right"><input type="submit" class="btn btn-primary" value="Add film"></div>
      </div>
   
      <div id="section-tabs">
      
      <div class="row">
      
      <input type="hidden" value="<?php echo $projectData->_kp_PROJECT; ?>" name="projectID">
      <input type="hidden" value="<?php echo $projectData->_kf_staff_prodManager_PROJECT; ?>" name="prodMgrID">
      <input type="hidden" value="<?php echo $staffData->shortname_STAFF; ?>" name="addedBy">
      
      <?php if(!empty($projectData->viewingNotes_CLIENT)) { ?><div class="span12"><div class="alert"><i class="icon-bell"></i> CLIENT DELIVERY: <?php echo $projectData->viewingNotes_CLIENT; ?></div></div><?php } ?>

      <div class="col-md-6">
      <label>Enter title</label>
       <input type="text" placeholder="Film title" class="form-control" name="filmTitle" >
      </div>
      
      <div class="col-md-2">
      <label>Vimeo</label>
          <input type="text" placeholder="0000000" class="form-control" name="vimeoID">
      </div>
      
      <div class="col-md-2">
      <label>Password?</label>
          <input type="text" placeholder="0000000" class="form-control" name="vimeoPassword">
      </div>
      
      <div class="col-md-2">
      <label>Youtube ID</label>
          <input type="text" placeholder="0000000" class="form-control" name="youtubeID">
      </div>
	  

	  
      </form>

      </div>
	  
	  <div class="clearboth"></div>
	 
	  <hr>
	  
	  Add another
	  
      </div> 

      </div>


      
       </div> 
       
       <!-- /Tab Content -->
      
      
      <div class="col-md-4 tasks">
       <?php  if (strpos($staffData->type_STAFF, 'Production Manager') !== false) { $taskData = fetchProjectTasks($projectData->_kp_PROJECT); if($taskData->_kf_project_TASKS == $projectData->_kp_PROJECT) { ?>
       <?php $complete = fetchProjectTaskCompletion($projectData->_kp_PROJECT); 
       
	       		$totalComplete = $complete->completion_TASKS; // TotalComplete is all tasks
	       		$totalComplete = ($totalComplete / 26 ) * 100; // Get percentage 
	       		$totalComplete = number_format($totalComplete,0); // Create into readble number	?>    
	       		 
       <h2>Tasks</h2>
      
             <!-- TASKS-TOP -->
      			<li class="header">
	      			<?php if(!empty($taskData->_staff_TASKS)) { ?>Last changed by <?php echo $taskData->_staff_TASKS; ?> on <?php echo $taskData->added_TASKS; ?><?php } ?>
	      			<span class="task-count"><?php echo $totalComplete; ?>% Complete</span>
	      		</li>
	      		
	      	<!-- END TASKS-TOP -->   
            <ul>
	            <li class="header-fin">
	      			Production tasks
	      		</li>
            <div class="tab-content">
            <div class="tab-pane active" id="tasksProd">
            <?php $taskCounter = array(1,2,3,5,7,8,9,10,11,12,13,15,19,20,21,22,23,24,26); foreach($taskCounter as $currTask) {
            
	            //Set up links for tasks and items
	            $itemField = 'item'.$currTask.'_TASKS';
	            $taskLink = '/ajax/add_task.php?task='.$currTask.'&project='.$projectData->_kp_PROJECT.'&addedBy='.$staffData->shortname_STAFF.'&title='.titleURL($projectData->title_PROJECT);
	
				//Set the labels for each task
				switch ($currTask) {
				case 1:  $taskDetail = "Client site setup & checklist phone call"; break;
				case 2:  $taskDetail = "Client site checklist completed"; break;
				case 3:  $taskDetail = "Quote updated and e-mailed to Finance"; break;
				case 5:  $taskDetail = "Set up project on E-mail"; break;
				case 7:  $taskDetail = "Set up project on RAID"; break;
				case 8:	 $taskDetail = "Schedule Filming and Editing"; break;
			    case 9:  $taskDetail = "Book Travel"; break;
			    case 10: $taskDetail = "Book Accommodation"; break;
			    case 11: $taskDetail = "Equipment Available"; break;
			    case 12: $taskDetail = "Filming permission applied for"; break;
			    case 15: $taskDetail = "Project Overview prepared and distributed"; break;
			    case 19: $taskDetail = "Film footage stored in two places"; break;
			    case 20: $taskDetail = "Editing"; break;
			    case 21: $taskDetail = "Editing changes"; break;
			    case 22: $taskDetail = "Approval from Client";
         
			    	if(empty($taskData->$itemField)) {
				    	$taskLink = '/ajax/add_task.php?task='.$currTask.'&project='.$projectData->_kp_PROJECT.'&addedBy='.$staffData->shortname_STAFF.'&title='.titleURL($projectData->title_PROJECT).'&approve=yes'; } 
				    
				    else { $taskLink = '/ajax/add_task.php?task='.$currTask.'&project='.$projectData->_kp_PROJECT.'&addedBy='.$staffData->shortname_STAFF.'&title='.titleURL($projectData->title_PROJECT);}
				    
				break;
				case 23: $taskDetail = "Update client site"; break;
				case 24: $taskDetail = "Email archive"; break;
			    case 26: $taskDetail = "Courtesy call and follow up"; break;    
			    
			    }	
	
			    //Show variants for completed and non-completed tasks
			    if(!empty($taskData->$itemField)) { ?>
			    
			<!-- NEWS YES LOOP -->
			    	<li class="complete">
				    	<a href="<?php echo $taskLink.'&uncheck=yes'; ?>"><span class="task-icon"><span class="fa-stack fa-lg"><i class="fa fa-check secondary-text"></i></span></span></a>
				    	<?php echo $taskDetail; ?>
				    </li>
            
				<?php } else {  ?>
			<!-- /NEWS YES LOOP -->
            
            <!-- NEWS NO LOOP -->
      				<li>
	      				<a href="<?php echo $taskLink; ?>"><span class="task-icon"><span class="fa-stack fa-lg"><i class="fa fa-circle-o primary-text"></i></span></span></a>
	      				<?php echo $taskDetail; ?>
	      			</li>
	      	<!-- END NEWS NO LOOP -->   
            
            
            <?php } } // END FOREACH  ?>
            <!-- TASKS-TOP -->
      			<li class="header-fin">
	      			Finance tasks
	      		</li>
	      	<!-- END TASKS-TOP --> 
            <?php 

	
	$taskCounter = array(4,6,14,16,17,18,25); 

	foreach($taskCounter as $currTask) {
	
	//Set up links for tasks and items
	$itemField = 'item'.$currTask.'_TASKS';
	
	$taskLink = '/ajax/add_task.php?task='.$currTask.'&project='.$projectData->_kp_PROJECT.'&addedBy='.$staffData->shortname_STAFF.'&title='.titleURL($projectData->title_PROJECT);
	
	//Set the labels for each task
	
	switch ($currTask) {

    case 4:
         $taskDetail = "PO Applied For";
        break;
       case 6:
         $taskDetail = "Set up project on accounts";
        break;
   case 14:
         $taskDetail = "Add to monthly figures";
        break;
     case 16:
         $taskDetail = "PO Received";
        break;
      case 17:
         $taskDetail = "Invoiced";
        break;
      case 18:
         $taskDetail = "Invoice received";
        break;
      case 25:
         $taskDetail = "Financial Report";
        break;
      
        
        }	
	
	//Show variants for completed and non-completed tasks
	
		if(!empty($taskData->$itemField)) { ?>

		
            <!-- NEWS YES LOOP -->
			    	<li class="complete">
				    	<a href="<?php echo $taskLink.'&uncheck=yes'; ?>"><span class="task-icon"><span class="fa-stack fa-lg"><i class="fa fa-check secondary-text"></i></span></span></a>
				    	<?php echo $taskDetail; ?>
				    </li>
            
				<?php } else {  ?>
			<!-- /NEWS YES LOOP -->
            
            <!-- NEWS NO LOOP -->
      				<li>
	      				<a href="<?php echo $taskLink; ?>"><span class="task-icon"><span class="fa-stack fa-lg"><i class="fa fa-circle-o primary-text"></i></span></span></a>
	      				<?php echo $taskDetail; ?>
	      			</li>
	      	<!-- END NEWS NO LOOP -->   
            
            
            
            <?php
         
            }  } // END FOREACH ?>
            </div>
       </div> <!-- /TAB-CONTENT -->
       
            </ul>
                  
      </div>
      
<?php }  }   //Empty task data ?>
            
      </div>
      
     
      
        
      </div> <!-- /ROW -->
    </div> <!-- /CONTAINER -->

<?php $relatedFilms = fetchRelatedFilms($projectData->_kp_PROJECT,0); ?> 

 <?php if($relatedFilms) { ?> 
 
   <div id="films-full">
   <h2>Films</h2>
   <div class="row">
   
<?php $filmCounter = 1;  while ($relatedFilmData = $relatedFilms->fetch_object()) { $version = $relatedFilmData->version_VIDEO; ?>  

 
   
   <!-- LOOP -->
   <div class="col-md-6 col-lg-3">
   <div class="film">
   <div class="video-wrap">
   <?php if($relatedFilmData->youtubeID_VIDEO) { ?>
   	<iframe width="730" height="410" src="http://www.youtube.com/embed/<?php echo $relatedFilmData->youtubeID_VIDEO; ?>?rel=0" frameborder="0" allowfullscreen></iframe>
   	<?php } else { ?>
   	<iframe width="730" height="410" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen src="http://player.vimeo.com/video/<?php echo $relatedFilmData->vimeoID_VIDEO?>?title=0&amp;byline=0&amp;portrait=0&amp;color=f28c3a"></iframe>
   	<?php } ?>
   </div>
   
   <div class="video-info">
      <p class="list-text"></p><h4> <a href="/film/<?php echo $relatedFilmData->_kp_VIDEO; ?>/<?php echo titleURL($relatedFilmData->title_VIDEO); ?>"><?php echo $relatedFilmData->title_VIDEO; ?></a></h4><p></p>
       <p class="video-info-loop">
       
       <!-- Version --> <span class="version">Version <?php echo $version; ?></span>
      <!-- Timestamp --> <span class="time"><?php echo $relatedFilmData->added_VIDEO; ?></span>
      <!-- Password --> <?php if(!empty($relatedFilmData->password_VIDEO)) { ?><span class="password"><i class="fa fa-unlock-alt"></i><?php echo $relatedFilmData->password_VIDEO; ?></span><?php } ?>
      
      
      <?php if($projectData->youtubeStats_PROJECT || $relatedFilmData->youtubeID_VIDEO) {
	$video_ID = $relatedFilmData->youtubeID_VIDEO;
	$JSON = file_get_contents("https://gdata.youtube.com/feeds/api/videos/{$video_ID}?v=2&alt=json");
	$JSON_Data = json_decode($JSON);
	$views = $JSON_Data->{'entry'}->{'yt$statistics'}->{'viewCount'};
	$rating = $JSON_Data->{'entry'}->{'yt$rating'}->{'numLikes'}; 
	
	//Write back current number of YouTube views into our database
								    
	if(!empty($views)) {
									    
	updateYoutubeViewCount($videoData->_kp_VIDEO,$views); } ?>
      
      <!-- Stats --> <?php if(!empty($relatedFilmData->youtubeStats_VIDEO) && !empty($projectData->youtubeStats_PROJECT)) { ?><span class="stats"><a href="http://www.youtube.com/watch?v=<?php echo $relatedFilmData->youtubeID_VIDEO; ?>" target="blank"><i class="fa fa-youtube-play"></i><?php echo number_format($views); ?></a></span><span class="stats"><a href="http://www.youtube.com/watch?v=<?php echo $relatedFilmData->youtubeID_VIDEO; ?>" target="blank"><i class="icon-thumbs-up"></i> <i class="fa fa-thumbs-o-up"></i><?php echo $rating; ?></a></span> 
      
      
      <?php } } ?>
      
      
      </p>
       <a href="/film/<?php echo $relatedFilmData->_kp_VIDEO; ?>/<?php echo titleURL($relatedFilmData->title_VIDEO); ?>" class="btn btn-primary"><i class="fa fa-info-circle"></i> Info</a>
       <?php if($relatedFilmData->link_QT_VIDEO || $relatedFilmData->link_WMV_VIDEO || $relatedFilmData->link_FLV_VIDEO || $relatedFilmData->link_iPhone_VIDEO || $relatedFilmData->link_other_VIDEO) { ?>
       <?php if($relatedFilmData->link_QT_VIDEO || $relatedFilmData->link_WMV_VIDEO || $relatedFilmData->link_FLV_VIDEO || $relatedFilmData->link_iPhone_VIDEO || $relatedFilmData->link_other_VIDEO) { ?>
       <?php if(!empty($relatedFilmData->link_QT_VIDEO)) { ?><span class="downloads-available">QT</span><?php } ?> <?php if(!empty($relatedFilmData->link_WMV_VIDEO)) { ?><span class="downloads-available">WMV</span><?php } ?> <?php if(!empty($relatedFilmData->link_FLV_VIDEO)) { ?><span class="downloads-available">FLV</span><?php } ?> <?php if(!empty($relatedFilmData->link_other_VIDEO)) { ?><span class="downloads-available"><?php echo $relatedFilmData->link_otherLabel_VIDEO; ?></span><?php } ?></span>
       <?php }  ?>
       are available
       <?php }  ?>
       <div class="clearboth"></div>
      </div>
   
   </div>
   </div>
   
   <!-- /LOOP -->
   
   <?php if ($filmCounter == 4) { ?>
   <div class="clearboth"></div>
   <?php } ?>
   
  <?php  $filmCounter++; } // End While ?>    
      
   </div>

   </div>
   
   <?php } ?> 
   
   <?php include('includes/footer.php'); ?>		
