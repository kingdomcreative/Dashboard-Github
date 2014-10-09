<?php

include ('../db.php');
include ('../functions.php');


$activeProjectResult = fetchAllActiveProjects($_GET['show']);
    

printf ('<ul class="list-projects">');

printf('    <li>
            <div class="client table-top">CLIENT</div>
            <div class="project-name table-top">PROJECT NAME</div>
            <div class="date-added table-top">DATE ADDED</div>
            <div class="project-info table-top">PROJECT INFO</div>

        </li>');
        
    
    while ($projectData = $activeProjectResult->fetch_object()) {

   printf('<li>
            <div class="client">%s</div>
            <div class="project-name"><a href="project/%d/%s">%s</a></div>
            <div class="date-added">%s</div>
            <div class="project-info"><a href="project/%d/%s">Info</a> l <a href="project/%d/%s#films">Films</a> l <a href="project/%d/%s/changes">Changes</a></div>

        </li>',$projectData->name_CLIENT,$projectData->_kp_PROJECT,titleURL($projectData->title_PROJECT),$projectData->title_PROJECT,$projectData->added_PROJECT,$projectData->_kp_PROJECT,titleURL($projectData->title_PROJECT),$projectData->_kp_PROJECT,titleURL($projectData->title_PROJECT),$projectData->_kp_PROJECT,titleURL($projectData->title_PROJECT));
        
        }
        
printf('</ul>');       


?>