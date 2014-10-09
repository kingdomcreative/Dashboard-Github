<?php

include ('../db.php');
include ('../functions.php');


$activeProjectResult = fetchAllActiveProjects($_GET['show']);
    

printf ('<ul class="list-projects">');

printf('    <li>
            <div class="client table-top">CLIENT</div>
            <div class="project-name table-top">PROJECT NAME</div>
            
            <div class="project-hours table-top">REPORT STATUS</div>
            
            <div class="project-info table-top">LINKS</div>

        </li>');
        
    
    while ($projectData = $activeProjectResult->fetch_object()) {
    

   printf('<li>
            <div class="client">%s</div>',$projectData->name_CLIENT);
    
    if($projectData->live_PROJECT) {      
    printf('<div class="project-name"><a href="project/%d/%s">%s</a></div>',$projectData->_kp_PROJECT,titleURL($projectData->title_PROJECT),$projectData->title_PROJECT);
    } else {
    printf('<div class="project-name"><a href="project/%d/%s">%s</a> <i class="icon-minus-sign"></i></div>',$projectData->_kp_PROJECT,titleURL($projectData->title_PROJECT),$projectData->title_PROJECT); }
    
    
    if($projectData->total_current == 0 && $projectData->total_initial == 0) { $total_Percent = 0; } else {
    $total_Percent = number_format(($projectData->total_current / $projectData->total_initial) * 100,0); }
    
    
    echo('<div class="project-hours"><a href="project/'.$projectData->_kp_PROJECT.'/'.titleURL($projectData->title_PROJECT).'/report">
    
   <div class="progress progress-striped">');
   
   
   if ($projectData->hours_changes_PROJECT > $projectData->hours_initial_changes_PROJECT) {
				echo('<div class="bar" style="width: '.$total_Percent.'%;background-color:#fb5a5a;"></div></div>'); 
				
								
				} elseif (($projectData->hours_planning_PROJECT > $projectData->hours_initial_planning_PROJECT) || ($projectData->hours_filming_PROJECT > $projectData->hours_initial_filming_PROJECT) || ($projectData->hours_editing_PROJECT > $projectData->hours_initial_editing_PROJECT)) {
				echo('<div class="bar" style="width: '.$total_Percent.'%;background-color:orange;"></div></div>');; 
				
				} else {
					
				echo('<div class="bar" style="width: '.$total_Percent.'%;background-color:green;"></div></div>'); }
   
   
			 
   echo ('</div>') ;
    	
    printf('
            <div class="project-info"><a href="project/%d/%s" title="Info"><i class="icon-info-sign"></i></a> <a href="project/%d/%s#films" title="View Films"><i class="icon-film"></i></a> <a href="project/%d/%s/changes" title="Changes"><i class="icon-sort-by-attributes"></i></a></div>

        </li>',$projectData->_kp_PROJECT,titleURL($projectData->title_PROJECT),$projectData->_kp_PROJECT,titleURL($projectData->title_PROJECT),$projectData->_kp_PROJECT,titleURL($projectData->title_PROJECT));
        
        }
        
printf('</ul>');       


?>