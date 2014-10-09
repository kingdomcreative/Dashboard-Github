<?php

include ('../db.php');
include ('../functions.php');


	$clientResult = fetchAllClients($_GET['sort']);
    

	printf ('<ul class="list-client">');


    
    while ($clientData = $clientResult->fetch_object()) {
    
    
    if($clientData->image_CLIENT) {
	   
	printf('<li class="transition"><img src="img/client-%s.jpg"></li>',$clientData->image_CLIENT);
	    
    } else {
	    
	printf('<li class="transition"><span class="placeholder-client">%s</span></li>',$clientData->name_CLIENT);
	    
    } }

        
    printf('</ul>');       


?>




        