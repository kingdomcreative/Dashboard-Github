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
	
	$activeProjectResult = fetchAllActiveProjects($_GET['show']);

?>

<!doctype html>
<html lang="en">

<?php include('includes/head.php'); ?>

<body>

  <?php include('includes/header.php'); ?> 

<!-- SHARELINK -->
<div id="sharelink" class="hidden-xs">
 <input type="text" placeholder="Enter Vimeo id or url and press enter" class="form-control">
</div>

<div id="sharelink" class="visible-xs">
 <input type="text" placeholder="Search film" class="form-control">
</div>

<!-- SHARELINK -->


 <div class="container" id="active-projects">
      <!-- Example row of columns -->    
      <div class="row" id="project-full">
      
       <div class="col-xs-3 col-sm-2 col-md-1 project-tabs">
       <ul>
       <li><a href="#addProjects" data-toggle="tab"><i class="fa fa-plus"></i></a></li>
       <li class="active"><a href="#activeProjects" data-toggle="tab"><i class="fa fa-folder-open-o"></i></a></li>
       <li><a href="#completedProjects" data-toggle="tab"><i class="fa fa-check"></i></a></li>
       
       </ul>
       </div>
       
       <div class="tab-content">
      
      <div class="col-xs-9 col-sm-10 col-md-7 projects tab-pane" id="addProjects">
      <div class="wrap">
      <h2>Add a project</h2>
   
      <div id="section-tabs">
      
      <h5 class="sub-title">General Information</h5>
      
      <div class="row">
      
      <div class="col-md-6">
      <label>Project title</label>

      <input type="text" placeholder="Project title" class="form-control">
      </div>
      
      <div class="col-md-3">
      <label>Client name</label>

      <input type="text" placeholder="Client" class="form-control">
      </div>
      
      <div class="col-md-3">
      <label>Date added</label>
       <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
          <input type="text" placeholder="Select date" class="form-control datepicker">
        </div>
      </div>
      
      <div class="clearboth"></div> 
      
      <div class="col-md-12">
      <hr>
      <h5 class="sub-title">Deliverables</h5>
      </div>
            
      <div class="col-md-3">
      <label>Filming date delivery</label>
      <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
          <input type="text" placeholder="Select date" class="form-control datepicker">
        </div>
      </div>
      
      <div class="col-md-3">
      <label>First edit delivery</label>
      <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
          <input type="text" placeholder="Select date" class="form-control datepicker">
        </div>
      </div>
      
      <div class="col-md-3">
      <label>Client feedback</label>
      <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
          <input type="text" placeholder="Select date" class="form-control datepicker">
        </div>
      </div>
      
      <div class="col-md-3">
      <label>Final edit delivered</label>
      <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
          <input type="text" placeholder="Select date" class="form-control datepicker">
        </div>
      </div>
      
      <div class="clearboth"></div> 
      
      <div class="col-md-12">
      <hr>
      <h5 class="sub-title">Staff</h5>
      </div>
      
      <div class="col-md-3">
      <label>Production Manager</label>
          <input type="text" placeholder="Choose member" class="form-control">
      </div>
      
      <div class="col-md-3">
      <label>Creative Manager</label>
          <input type="text" placeholder="Choose member" class="form-control">
      </div>
      
      <div class="col-md-3">
      <label>Editor</label>
          <input type="text" placeholder="Choose member" class="form-control">
      </div>
      
      <div class="col-md-3">
      <label>Designer</label>
          <input type="text" placeholder="Choose member" class="form-control">
      </div>
	  
	  <div class="clearboth"></div>
	  
	  
	  <div class="col-md-12">
      <hr>
      <h5 class="sub-title">The Brief</h5>
      </div>
      
      <div class="col-md-6">
      <label>What do you want to achieve with the project?</label> 
      	<textarea class="form-control" rows="3"></textarea>
      </div>
      
      <div class="col-md-6">
      <label>What duration are the film(s) going to be?</label>
          <textarea class="form-control" rows="3"></textarea>
      </div>
	  
	  <div class="clearboth"></div>
	  
	  <div class="col-md-6">
      <label>How/where will the film(s) be viewed?</label>
      	<textarea class="form-control" rows="3"></textarea>
      </div>
      
      <div class="col-md-6">
      <label>What video format do you need the film(s) to be in?</label>
          <textarea class="form-control" rows="3"></textarea>
      </div>
      
      <div class="clearboth"></div>
	  
	  <div class="col-md-6">
      <label>What graphics appear during the film(s)?</label>
      	<textarea class="form-control" rows="3"></textarea>
      </div>
      
      <div class="col-md-6">
      <label>Client contact</label>
          <textarea class="form-control" rows="3"></textarea>
      </div>
      
      <div class="clearboth"></div>
	  
	  <div class="col-md-6">
      <label>Any additional points to note?</label>
      	<textarea class="form-control" rows="3"></textarea>
      </div>
      
      <div class="col-md-6">
      <label>Internal Notes</label>
          <textarea class="form-control" rows="3"></textarea>
      </div>

      
      <div class="clearboth"></div> 
      
      <div class="col-md-12">
      <hr>
      <h5 class="sub-title">Quoted hours</h5>
      </div>
      
      <div class="col-md-2">
      <label>Planning</label>
          <input type="text" placeholder="0.0" class="form-control">
      </div>
      
      <div class="col-md-2">
      <label>Filming</label>
          <input type="text" placeholder="0.0" class="form-control">
      </div>
      
      <div class="col-md-2">
      <label>Editing</label>
          <input type="text" placeholder="0.0" class="form-control">
      </div>
      
      <div class="col-md-2">
      <label>Graphics</label>
          <input type="text" placeholder="0.0" class="form-control">
      </div>
	  
	  <div class="col-md-2">
      <label>Changes</label>
          <input type="text" placeholder="0.0" class="form-control">
      </div>

      <div class="clearboth"></div>
      
      <div class="col-md-12">
      <hr>
      </div>
      
      <div class="col-md-2">
      <a class="btn btn-primary">Add project</a>
      </div>
	  
	  <div class="col-md-2">
      <input name="live" type="checkbox" value="live" checked="yes"> Make project live
	  </div>
	  
      </div>
      
      
      </div>

      
      </div> <!-- /WRAP -->
      </div>
      
      <div class="col-xs-9 col-sm-10 col-md-7 projects tab-pane active" id="activeProjects">
       <ul class="project-list">
      <?php $activeProjectResult = fetchAllActiveProjects($_GET['show']); ?>
      
      <?php while ($projectData = $activeProjectResult->fetch_object()) { ?>
      
      <!-- LOOP -->
      <li>
      <!-- Approval & Stats --> <div class="hidden-xs hidden-sm col-sm-9 col-md-3 col-lg-3 info"><p class="list-info"><a href="client/<?php echo $projectData->_kp_CLIENT; ?>/<?php echo titleURL($projectData->username_CLIENT); ?>"><?php echo $projectData->name_CLIENT; ?></a></p></div>
      <!-- Project title --> 
      <a href="project/<?php echo $projectData->_kp_PROJECT; ?>/<?php echo titleURL($projectData->title_PROJECT); ?>"><div class="col-sm-12 col-md-6 col-lg-8 text"><p class="list-text"><i class="fa fa-folder-o hidden-xs"></i><?php echo $projectData->title_PROJECT; ?>
      
      <?php if($projectData->total_current == 0 && $projectData->total_initial == 0) { $total_Percent = 0; } else {
    $total_Percent = number_format(($projectData->total_current / $projectData->total_initial) * 100,0); } ?>
    
      <div class="progress"><div class="progress-bar <?php if($total_Percent >= 0 && $total_Percent <= 60) { echo "dark"; } elseif($total_Percent >= 61 && $total_Percent <= 90) { echo "secondary"; } else { echo "primary"; } ?>" role="progressbar" aria-valuenow="<?php echo $total_Percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $total_Percent; ?>%;"></div></div></p></div>
      </a>
      
      <!-- Project link -->  
      <div class="hidden-xs hidden-sm col-sm-3 col-md-1 col-lg-1 cta"><a href="/project/<?php echo $projectData->_kp_PROJECT; ?>/<?php echo titleURL($projectData->title_PROJECT); ?>/report">Report</a></div>
      <div class="clearboth"></div>
     </li>
      <!-- END LOOP -->
      
       <?php } ?>      
      </ul> 
      </div> <!-- /COL-MD-7 -->
      
      
      
      <div class="col-xs-9 col-sm-10 col-md-7 projects tab-pane" id="completedProjects">
       <ul class="project-list">
      
      <!-- LOOP -->
      <li>
      <!-- Approval & Stats --> <div class="hidden-xs hidden-sm col-sm-9 col-md-3 col-lg-3 info"><p class="list-info">Porsche</p></div>
      <!-- Project title --> 
      <a href="<? echo $client->username_CLIENT; ?>/project/<? echo $projectData->_kp_PROJECT; ?>/<? echo titleURL($projectData->title_PROJECT); ?>"><div class="col-sm-12 col-md-6 col-lg-8 text"><p class="list-text"><i class="fa fa-folder-o hidden-xs"></i>Lorem ipsum dolor sit amet, consectetur adipiscing elit
      <div class="progress"><div class="progress-bar secondary" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div></div></p></div>
      </a>
      
      <!-- Project link -->  
      <div class="hidden-xs hidden-sm col-sm-3 col-md-1 col-lg-1 cta">Report</div>
      <div class="clearboth"></div>
     </li>
      <!-- END LOOP -->
      
      <!-- LOOP -->
      <li><a href="<? echo $client->username_CLIENT; ?>/project/<? echo $projectData->_kp_PROJECT; ?>/<? echo titleURL($projectData->title_PROJECT); ?>">
      <!-- Approval & Stats --> <div class="hidden-xs hidden-sm col-sm-9 col-md-3 col-lg-3 info"><p class="list-info">MINI</p></div>
      <!-- Project title --> <div class="col-sm-12 col-md-6 col-lg-8 text"><p class="list-text"><i class="fa fa-folder-o hidden-xs"></i>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
      <div class="progress"><div class="progress-bar tertiary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div></div></div>
      <!-- Project link -->  <div class="hidden-xs hidden-sm col-sm-3 col-md-1 col-lg-1 cta">Report</div>
      <div class="clearboth"></div>
      </a></li>
      <!-- END LOOP -->
      
       <!-- LOOP -->
      <li><a href="<? echo $client->username_CLIENT; ?>/project/<? echo $projectData->_kp_PROJECT; ?>/<? echo titleURL($projectData->title_PROJECT); ?>">
      <!-- Approval & Stats --> <div class="hidden-xs hidden-sm col-sm-9 col-md-3 col-lg-3 info"><p class="list-info">North Hertfordshire College</p></div>
      <!-- Project title --> <div class="col-sm-12 col-md-6 col-lg-8 text"><p class="list-text"><i class="fa fa-folder-o hidden-xs"></i>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
      <div class="progress"><div class="progress-bar primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div></div></div>
      <!-- Project link -->  <div class="hidden-xs hidden-sm col-sm-3 col-md-1 col-lg-1 cta">Report</div>
      <div class="clearboth"></div>
      </a></li>
      <!-- END LOOP -->
      
       <!-- LOOP -->
      <li><a href="<? echo $client->username_CLIENT; ?>/project/<? echo $projectData->_kp_PROJECT; ?>/<? echo titleURL($projectData->title_PROJECT); ?>">
      <!-- Approval & Stats --> <div class="hidden-xs hidden-sm col-sm-9 col-md-3 col-lg-3 info"><p class="list-info">Volkswagen UK</p></div>
      <!-- Project title --> <div class="col-sm-12 col-md-6 col-lg-8 text"><p class="list-text"><i class="fa fa-folder-o hidden-xs"></i>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
      <div class="progress"><div class="progress-bar secondary" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10" style="width: 10%;"></div></div></div>
      <!-- Project link -->  <div class="hidden-xs hidden-sm col-sm-3 col-md-1 col-lg-1 cta">Report</div>
      <div class="clearboth"></div>
      </a></li>
      <!-- END LOOP -->
      
       <!-- LOOP -->
      <li><a href="<? echo $client->username_CLIENT; ?>/project/<? echo $projectData->_kp_PROJECT; ?>/<? echo titleURL($projectData->title_PROJECT); ?>">
      <!-- Approval & Stats --> <div class="hidden-xs hidden-sm col-sm-9 col-md-3 col-lg-3 info"><p class="list-info">Raytheon</p></div>
      <!-- Project title --> <div class="col-sm-12 col-md-6 col-lg-8 text"><p class="list-text"><i class="fa fa-folder-o hidden-xs"></i>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
      <div class="progress"><div class="progress-bar secondary" role="progressbar" style="width: 30%;"></div></div></div>
      <!-- Project link -->  <div class="hidden-xs hidden-sm col-sm-3 col-md-1 col-lg-1 cta">Report</div>
      <div class="clearboth"></div>
      </a></li>
      <!-- END LOOP -->
      
       <!-- LOOP -->
      <li><a href="<? echo $client->username_CLIENT; ?>/project/<? echo $projectData->_kp_PROJECT; ?>/<? echo titleURL($projectData->title_PROJECT); ?>">
      <!-- Approval & Stats --> <div class="hidden-xs hidden-sm col-sm-9 col-md-3 col-lg-3 info"><p class="list-info">Performance PR</p></div>
      <!-- Project title --> <div class="col-sm-12 col-md-6 col-lg-8 text"><p class="list-text"><i class="fa fa-folder-o hidden-xs"></i>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
      <div class="progress"><div class="progress-bar secondary" role="progressbar" style="width: 67%;"></div></div></div>
      <!-- Project link -->  <div class="hidden-xs hidden-sm col-sm-3 col-md-1 col-lg-1 cta">Report</div>
      <div class="clearboth"></div>
      </a></li>
      <!-- END LOOP -->
      
       <!-- LOOP -->
      <li><a href="<? echo $client->username_CLIENT; ?>/project/<? echo $projectData->_kp_PROJECT; ?>/<? echo titleURL($projectData->title_PROJECT); ?>">
      <!-- Approval & Stats --> <div class="hidden-xs hidden-sm col-sm-9 col-md-3 col-lg-3 info"><p class="list-info">Iris Worldwide</p></div>
      <!-- Project title --> <div class="col-sm-12 col-md-6 col-lg-8 text"><p class="list-text"><i class="fa fa-folder-o hidden-xs"></i>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
      <div class="progress"><div class="progress-bar secondary" role="progressbar"style="width: 5%;"></div></div></div>
      <!-- Project link -->  <div class="hidden-xs hidden-sm col-sm-3 col-md-1 col-lg-1 cta">Report</div>
      <div class="clearboth"></div>
      </a></li>
      <!-- END LOOP -->      
      
       <!-- LOOP -->
      <li><a href="<? echo $client->username_CLIENT; ?>/project/<? echo $projectData->_kp_PROJECT; ?>/<? echo titleURL($projectData->title_PROJECT); ?>">
      <!-- Approval & Stats --> <div class="hidden-xs hidden-sm col-sm-9 col-md-3 col-lg-3 info"><p class="list-info">Iris Worldwide</p></div>
      <!-- Project title --> <div class="col-sm-12 col-md-6 col-lg-8 text"><p class="list-text"><i class="fa fa-folder-o hidden-xs"></i>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
      <div class="progress"><div class="progress-bar primary" role="progressbar" style="width: 100%;"></div></div></div>
      <!-- Project link -->  <div class="hidden-xs hidden-sm col-sm-3 col-md-1 col-lg-1 cta">Report</div>
      <div class="clearboth"></div>
      </a></li>
      <!-- END LOOP -->      
      
       <!-- LOOP -->
      <li><a href="<? echo $client->username_CLIENT; ?>/project/<? echo $projectData->_kp_PROJECT; ?>/<? echo titleURL($projectData->title_PROJECT); ?>">
      <!-- Approval & Stats --> <div class="hidden-xs hidden-sm col-sm-9 col-md-3 col-lg-3 info"><p class="list-info">Iris Worldwide</p></div>
      <!-- Project title --> <div class="col-sm-12 col-md-6 col-lg-8 text"><p class="list-text"><i class="fa fa-folder-o hidden-xs"></i>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
      <div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div></div></div>
      <!-- Project link -->  <div class="hidden-xs hidden-sm col-sm-3 col-md-1 col-lg-1 cta">Report</div>
      <div class="clearboth"></div>
      </a></li>
      <!-- END LOOP -->      
      
       <!-- LOOP -->
      <li><a href="<? echo $client->username_CLIENT; ?>/project/<? echo $projectData->_kp_PROJECT; ?>/<? echo titleURL($projectData->title_PROJECT); ?>">
      <!-- Approval & Stats --> <div class="hidden-xs hidden-sm col-sm-9 col-md-3 col-lg-3 info"><p class="list-info">Iris Worldwide</p></div>
      <!-- Project title --> <div class="col-sm-12 col-md-6 col-lg-8 text"><p class="list-text"><i class="fa fa-folder-o hidden-xs"></i>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
      <div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div></div></div>
      <!-- Project link -->  <div class="hidden-xs hidden-sm col-sm-3 col-md-1 col-lg-1 cta">Report</div>
      <div class="clearboth"></div>
      </a></li>
      <!-- END LOOP -->      
      
       <!-- LOOP -->
      <li><a href="<? echo $client->username_CLIENT; ?>/project/<? echo $projectData->_kp_PROJECT; ?>/<? echo titleURL($projectData->title_PROJECT); ?>">
      <!-- Approval & Stats --> <div class="hidden-xs hidden-sm col-sm-9 col-md-3 col-lg-3 info"><p class="list-info">Iris Worldwide</p></div>
      <!-- Project title --> <div class="col-sm-12 col-md-6 col-lg-8 text"><p class="list-text"><i class="fa fa-folder-o hidden-xs"></i>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
      <div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div></div></div>
      <!-- Project link -->  <div class="hidden-xs hidden-sm col-sm-3 col-md-1 col-lg-1 cta">Report</div>
      <div class="clearboth"></div>
      </a></li>
      <!-- END LOOP -->      
      
       <!-- LOOP -->
      <li><a href="<? echo $client->username_CLIENT; ?>/project/<? echo $projectData->_kp_PROJECT; ?>/<? echo titleURL($projectData->title_PROJECT); ?>">
      <!-- Approval & Stats --> <div class="hidden-xs hidden-sm col-sm-9 col-md-3 col-lg-3 info"><p class="list-info">Iris Worldwide</p></div>
      <!-- Project title --> <div class="col-sm-12 col-md-6 col-lg-8 text"><p class="list-text"><i class="fa fa-folder-o hidden-xs"></i>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
      <div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div></div></div>
      <!-- Project link -->  <div class="hidden-xs hidden-sm col-sm-3 col-md-1 col-lg-1 cta">Report</div>
      <div class="clearboth"></div>
      </a></li>
      <!-- END LOOP -->      
      
       <!-- LOOP -->
      <li><a href="<? echo $client->username_CLIENT; ?>/project/<? echo $projectData->_kp_PROJECT; ?>/<? echo titleURL($projectData->title_PROJECT); ?>">
      <!-- Approval & Stats --> <div class="hidden-xs hidden-sm col-sm-9 col-md-3 col-lg-3 info"><p class="list-info">Iris Worldwide</p></div>
      <!-- Project title --> <div class="col-sm-12 col-md-6 col-lg-8 text"><p class="list-text"><i class="fa fa-folder-o hidden-xs"></i>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
      <div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div></div></div>
      <!-- Project link -->  <div class="hidden-xs hidden-sm col-sm-3 col-md-1 col-lg-1 cta">Report</div>
      <div class="clearboth"></div>
      </a></li>
      <!-- END LOOP -->      
      
       <!-- LOOP -->
      <li><a href="<? echo $client->username_CLIENT; ?>/project/<? echo $projectData->_kp_PROJECT; ?>/<? echo titleURL($projectData->title_PROJECT); ?>">
      <!-- Approval & Stats --> <div class="hidden-xs hidden-sm col-sm-9 col-md-3 col-lg-3 info"><p class="list-info">Iris Worldwide</p></div>
      <!-- Project title --> <div class="col-sm-12 col-md-6 col-lg-8 text"><p class="list-text"><i class="fa fa-folder-o hidden-xs"></i>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
      <div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div></div></div>
      <!-- Project link -->  <div class="hidden-xs hidden-sm col-sm-3 col-md-1 col-lg-1 cta">Report</div>
      <div class="clearboth"></div>
      </a></li>
      <!-- END LOOP -->      
      
      </ul> 
      </div> <!-- /COL-MD-7 -->

      
       </div> <!-- /Tab Content -->
      
      
      <div class="col-md-4 status hidden-xs hidden-sm">
            <h5 class="sub-title">Status</h5>
            
            <div id="status-box">
            
            <ul class="status-news">
      <!-- NEWS LOOP -->
      <li><a href="<? echo $client->username_CLIENT; ?>/project/<? echo $projectData->_kp_PROJECT; ?>/<? echo titleURL($projectData->title_PROJECT); ?>">
      <span class="alert-added"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x secondary-text"></i><i class="fa fa-plus fa-stack-1x white-text"></i></span><span class="s-text">Film Added</span></span>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit
      </a></li>
      <!-- END NEWS LOOP -->   
      
      <!-- NEWS LOOP -->
      <li><a href="<? echo $client->username_CLIENT; ?>/project/<? echo $projectData->_kp_PROJECT; ?>/<? echo titleURL($projectData->title_PROJECT); ?>">
      <span class="alert-added"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x secondary-text"></i><i class="fa fa-folder-open fa-stack-1x white-text"></i></span><span class="s-text">Project Added</span></span>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit
      </a></li>
      <!-- END NEWS LOOP -->   
      
      <!-- NEWS LOOP -->
      <li><a href="<? echo $client->username_CLIENT; ?>/project/<? echo $projectData->_kp_PROJECT; ?>/<? echo titleURL($projectData->title_PROJECT); ?>">
      <span class="alert-added s-text"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x secondary-text"></i><i class="fa fa-dot-circle-o fa-stack-1x white-text"></i></span>Dashboard Alert</span><br>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      
      </a></li>

      </a></li>
      <!-- END NEWS LOOP -->   
      
      <!-- NEWS LOOP -->
      <li><a href="<? echo $client->username_CLIENT; ?>/project/<? echo $projectData->_kp_PROJECT; ?>/<? echo titleURL($projectData->title_PROJECT); ?>">
      <span class="alert-added"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x secondary-text"></i><i class="fa fa-folder-open fa-stack-1x white-text"></i></span><span class="s-text">Project Added</span></span>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit
      </a></li>
      <!-- END NEWS LOOP -->   
      
            </ul>
            </div>
            
             <h5 class="sub-title">Latest Upload</h5>
            
            <div id="video-wrap">
            <iframe src="//player.vimeo.com/video/92602223?title=0&amp;byline=0&amp;portrait=0&amp;color=fb5a5a" width="870" height="489" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>
      
      </div>
            
      </div>
      
   
     
      
        
      </div> <!-- /ROW -->
    </div> <!-- /CONTAINER -->
    
   <?php include('includes/footer.php'); ?>	
