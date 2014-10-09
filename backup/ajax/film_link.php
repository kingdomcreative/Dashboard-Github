<?php

$path = parse_url($_POST['vimeolink'], PHP_URL_PATH);
$pathComponents = explode("/", trim($path, "/")); // trim to prevent
                                                  // empty array elements
$vimeoID = $pathComponents[0]; // get ID out from path


printf('<input type="text" value="http://circuitpro.co.uk/view/film/%s" size="250" onClick="SelectAll(\'link\');" id="link" style="width:300px">',$vimeoID);     


?>




        