<?php

include ('../db.php');
include ('../functions.php');

$newsResult = fetchStaffNews();

printf('<ul class="active-projects">');

while ($newsData = $newsResult->fetch_object()) {

printf('<li>%s<br />
<span style="color: #70e8cb">%s</span><span style="color: #70e8cb"> @ %s</span></li>',$newsData->content_NEWS,$newsData->shortname_STAFF,$newsData->added_NEWS);

}

printf('</ul>');


?>