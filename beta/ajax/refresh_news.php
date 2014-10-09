<?php

include ('../db.php');
include ('../functions.php');

$newsResult = fetchStaffNews();

printf('<ul class="news-alerts">');

while ($newsData = $newsResult->fetch_object()) {


if($newsData->_kf_staff_NEWS =='11' ) {
	
	printf('<li>
<div class="row-fluid">
<div class="span1 ico-news">
		<i class="icon-folder-open-alt icon-2x" style="color: #5BB75B"></i>
</div>
<div class="span11 quote-tri">
	 %s<br />
<span style="color: #777"> %s </span><span style="color: #777777"> %s</span></div></div></li>',$newsData->content_NEWS,$newsData->shortname_STAFF,$newsData->added_NEWS);

} else {
	

printf('<li>
<div class="row-fluid">
<div class="span1 ico-news">
<i class="icon-comment-alt icon-2x" style="color: #555"></i>
</div>
<div class="span11 quote-tri">
%s<br />
<span style="color: #70e8cb">Posted by %s </span><span style="color: #777777"> %s</span></div></div></li>',$newsData->content_NEWS,$newsData->shortname_STAFF,$newsData->added_NEWS);

} }

printf('</ul>');


?>