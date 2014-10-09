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

	$localPage="projects";

?>

<!doctype html>
<html lang="en">
<?php include('includes/head.php'); ?>

<body>

  <?php include('includes/header.php'); ?> 

<div class="menu-header">
	<div class="container">

        <div class="span8 first">
		<h1>VIEW <span style="font-weight: 200;">PROJECTS</span></h1>
        </div>

        <div class="span4 staff">
        <img src="img/meet-<?php echo $staffData->shortname_STAFF; ?>.png">
        </div>

	</div>
</div>



<div class="tab-full">
<div class="container">
    <div class="row">
        <div class="span12"><!-- Span 12 -->


  <div class="tab-content tab-bg">
  
  
  <!-- projectAddFormDone --> <!-- SHOW ONCE A PROJECT HAS BEEN ADDED  -->

<div class="projectAddFormDone" style="display: none;">
<div class="container">
    <div class="row">
<div class="span6 offset3">
<h3>Your project has now been added!</h3>

<a class="btn btn-warning" href="/projects">REFRESH PAGE</a>
</div>
</div>
</div>

</div> <!-- End projectAddFormDone -->



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
  
  
    <!-- !ADD PROJECT -->
    
    
    <div id="pane1" class="tab-pane">
<div class="container-fluid no-pad list-client">
    <div class="row-fluid">
<div class="span12 first">
<form id="addProject" method="post" action="/ajax/add_project.php" enctype="multipart/form-data" name="addProjectForm">
<input type="text"  class="download-links-input add-proj-title" id="project-title" name="projTitle" value="ENTER PROJECT TITLE" onClick="SelectAll('project-title');">    
</div>

<?php $clientData = fetchAllClients("name"); ?>

<div class="clearboth"></div>
    <div class="span3 first">
        Client:&nbsp;
        <select name="clientID" id="clientID">
        <option value="0">Select client...</option>
        <?php  while( $clientDetail = $clientData->fetch_object()) {
     
	 printf('<option value="%d">%s</option>',$clientDetail->_kp_CLIENT,$clientDetail->name_CLIENT);
	 
	} ?>
    </select>

    </div>


    <div class="span3 clients">
         Date Added:&nbsp;<input type="text" class="datepicker add-form" name="added"/>
    </div>

    <div class="clearboth"></div>
<hr>



<div class="span6 first">

<p>Filming Date:</p>
<input type="text" name="date_filming" class="datepicker add-form" />

<p>First Edit Delivered:</p>
<input type="text" name="date_firstDelivery" class="datepicker add-form" />

<p>Client Feedback/Approval:</p>
<input type="text" name="date_approval" class="datepicker add-form" />

<p>Final Edit Delivered:</p>
<input type="text" name="date_finalDelivery" class="datepicker add-form" />
</div>

<div class="span6 clients">
<p>Production Manager:</p>
<select name="prodMgr">
        <?php $prodManagerData = fetchStaffviaType("Production Manager"); ?>
        <option value="0">Select...</option>
    <?php  while( $staffDetail = $prodManagerData->fetch_object()) {
     
	 printf('<option value="%d">%s</option>',$staffDetail->_kp_STAFF,$staffDetail->name_STAFF);
	 
	} ?>
    </select>

<p>Creative Manager:</p>
<select name="creativeMgr">
        <?php $creativeMgrData = fetchStaffviaType("Creative Manager"); ?>
        <option value="0">Select...</option>
    <?php  while( $staffDetail = $creativeMgrData->fetch_object()) {
     
	 printf('<option value="%d">%s</option>',$staffDetail->_kp_STAFF,$staffDetail->name_STAFF);
	 
	} ?>
    </select>

<p>Editor:</p>
<select name="editor">
        <?php $editorData = fetchStaffviaType("Editor"); ?>
        <option value="0">Select...</option>
    <?php  while( $staffDetail = $editorData->fetch_object()) {
     
	 printf('<option value="%d">%s</option>',$staffDetail->_kp_STAFF,$staffDetail->name_STAFF);
	 
	} ?>
    </select>
</div>

<div class="clearboth"></div>
<hr>
<! AREA Details !>

<div class="span6 first">
    <h4>Aim of the Project</h4>
<textarea class="add-area" name="brief1"></textarea>
</div>
<div class="clearboth"></div>
<hr>

<div class="span6 first">
    <h4>Intended Audience</h4>
    <p>Internal: Sales / Management UK / Management Non-UK / All Staff</br>
    External: Customers / Potential Customers / Enthusiasts</p>
<textarea class="add-area" name="brief2"></textarea>
</div>
<div class="clearboth"></div>
<hr>

<div class="span6 first">
    <h4>Broadcast Channel</h4>
    <p>Television / Social Media / Internal Channels / DVD / Downloadable file / Event Display Screens</p>
<textarea class="add-area" name="brief3"></textarea>
</div>
<div class="clearboth"></div>
<hr>

<div class="span6 first">
    <h4>Key Points which need to be included</h4>
    <p>In order of importance</p>
<textarea class="add-area" name="brief4"></textarea>
</div>
<div class="clearboth"></div>
<hr>

<div class="span6 first">
    <h4>Duration</h4>
    <p>Consider number of key points when stipulating duration</p>
<textarea class="add-area" name="brief5"></textarea>
</div>
<div class="clearboth"></div>
<hr>


<div class="span6 first">
    <h4>Style</h4>
    <p>Training / stylish / fast-paced action / epic / inspiring / interview based</p>
<textarea class="add-area" name="brief6"></textarea>
</div>
<div class="clearboth"></div>
<hr>

<div class="span6 first">
    <h4>Example Films</h4>
<textarea class="add-area" name="brief7"></textarea>
</div>
<div class="clearboth"></div>
<hr>

<div class="span6 first">
    <h4>Is the project part of a campaign that exists?</h4>
<textarea class="add-area" name="brief8"></textarea>
</div>
<div class="clearboth"></div>
<hr>


<div class="span6 first">
    <h4>What Graphics are required?</h4>
    <p>Call to action / logos / text</p>
<textarea class="add-area" name="brief9"></textarea>
</div>
<div class="clearboth"></div>
<hr>

<div class="span6 first">
    <h4>How will the project success be measured?</h4>
    <p>Sales / enquiries / views / comments</p>
<textarea class="add-area" name="brief10"></textarea>
</div>
<div class="clearboth"></div>
<hr>

<div class="span6 first">
    <h4>Internal Notes</h4>
<textarea class="add-area" name="notes_int"></textarea>
</div>
<div class="clearboth"></div>
<hr>


<div class="span6 first">
    <h4>Who has ultimate approval?</h4>
<textarea class="add-area" name="approval_brief"></textarea>
</div>
<div class="clearboth"></div>

<div class="span6 first">
    <h4>Brief Completed By</h4>
    <p><select name="brief_staff">
        <?php $editorData = fetchStaffviaType("ALL"); ?>
        <option value="0">Select...</option>
    <?php  while( $staffDetail = $editorData->fetch_object()) {
     
	 printf('<option value="%d">%s</option>',$staffDetail->_kp_STAFF,$staffDetail->name_STAFF);
	 
	} ?>
    </select></p>
    
    <p>Brief Completed On:</p>
<input type="text" name="date_brief" class="datepicker add-form" />

</div>
<div class="clearboth"></div>
<hr>



<!-- HOURS QUOTED --> 
<div class="span6 first">

<p>Quoted Hours - Planning:</p>
<input type="text" name="hours_planning" class="add-form" />

<p>Quoted Hours - Filming:</p>
<input type="text" name="hours_filming" class="add-form" />

<p>Quoted Hours - Editing:</p>
<input type="text" name="hours_editing" class="add-form" />

<!--
<p>Quoted Hours - Delivery:</p>
<input type="text" name="hours_delivery" class="add-form" />
-->
 
</div>

<div class="span6">



<p>Quoted Hours - Graphics:</p>
<input type="text" name="hours_graphics" class="add-form" />

<p>Quoted Hours - Changes:</p>
<input type="text" name="hours_changes" class="add-form" />

</div>


<div class="clearboth"></div>

<hr>

<! SUBMIT Details !>


<div class="span6 first">
<p>Project is live: <input name="live" type="checkbox" value="live" checked="yes"/></p>

<p><input type="submit" class="btn btn-success proj-form-sub" value="ADD PROJECT"></p>
        
       
</div>

</form>




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
            <li><a tabindex="-1" href="#" class="activeProjectToggle" id="proj-sort-your" data-show="<?php echo $staffData->_kp_STAFF; ?>">MY PROJECTS</a></li>
            <li><a tabindex="-1" href="#" class="activeProjectToggle" id="proj-sort-act" data-show="all">ALL ACTIVE</a></li> 
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

            <div class="project-info table-top">LINKS</div>
            </li>
        
    
<?php    while ($projectData = $completedProjectResult->fetch_object()) { 

   printf('<li>
            <div class="client">%s</div>',$projectData->name_CLIENT);
            
           if($projectData->live_PROJECT) {
           printf('<div class="project-name"><a href="project/%d/%s">%s</a></div>',$projectData->_kp_PROJECT,titleURL($projectData->title_PROJECT),$projectData->title_PROJECT); } else {
	       printf('<div class="project-name"><a href="project/%d/%s">%s</a> <i class="icon-minus-sign"></i></div>',$projectData->_kp_PROJECT,titleURL($projectData->title_PROJECT),$projectData->title_PROJECT);     
           }
           
           printf('
            <div class="project-info"><a href="project/%d/%s" title="Info"><i class="icon-info-sign"></i></a> <a href="project/%d/%s#films" title="View Films"><i class="icon-film"></i></a> </div>

        </li>',$projectData->_kp_PROJECT,titleURL($projectData->title_PROJECT),$projectData->_kp_PROJECT,titleURL($projectData->title_PROJECT));
        
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

    <!-- ACTIVE PROJECTS AJAX -->

    <div id="client-data">
    

    </div> <!-- active-projects -->

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
		
