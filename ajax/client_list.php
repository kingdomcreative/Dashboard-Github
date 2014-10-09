<?php

include ('../db.php');
include ('../functions.php');


	$clientResult = fetchAllClients($_GET['sort']);
    

	printf ('<ul class="list-client">');


    
    while ($clientData = $clientResult->fetch_object()) {
    
    
    if($clientData->image_CLIENT) {
	   
	printf('<li class="transition"><a href="/client/%d/%s"><img src="img/client-%s.jpg"></a></li>',$clientData->_kp_CLIENT,titleURL($clientData->username_CLIENT),$clientData->image_CLIENT);
	    
    } else {
	    
	printf('<li class="transition"><a href="/client/%d/%s"><span class="placeholder-client">%s</span></a></li>',$clientData->_kp_CLIENT,titleURL($clientData->username_CLIENT),$clientData->name_CLIENT);
	    
    } }

        
    printf('</ul>');       


?>




        