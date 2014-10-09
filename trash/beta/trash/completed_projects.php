<?php

include ('../db.php');
include ('../functions.php');


$completedProjectResult = fetchAllCompletedProjects($_GET['sort']);
    

printf ('<ul class="list-projects">');

printf('    <li>
            <div class="client">CLIENT</div>
            <div class="project-name">PROJECT NAME</div>
            <div class="date-added">DATE ADDED</div>
            <div class="project-info">PROJECT INFO</div>

        </li>');
        
    
    while ($projectData = $activeProjectResult->fetch_object()) {

   printf('<li>
            <div class="client">%s</div>
            <div class="project-name">%s</div>
            <div class="date-added">%s</div>
            <div class="project-info">Videos l Edit l Changes</div>

        </li>',$projectData->name_CLIENT,$projectData->title_PROJECT,$projectData->added_PROJECT);
        
        }
        
printf('</ul>');       


?>