<?php

$path = parse_url($_POST['vimeolink'], PHP_URL_PATH);
$pathComponents = explode("/", trim($path, "/")); // trim to prevent
                                                  // empty array elements
$vimeoID = $pathComponents[0]; // get ID out from path



printf('<input type="text" value="http://kingdom-creative.co.uk/view/film/%s" class="link-generator-input" onClick="SelectAll(\'link\');" id="link">
<a class="btn btn-warning" href="mailto:?Subject=View Film&body=http://kingdom-creative.co.uk/view/film/%d"><i class="icon-external-link"></i>',$vimeoID,$vimeoID);     



?>




        