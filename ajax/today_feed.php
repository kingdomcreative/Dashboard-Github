<?php

include ('../db.php');
include ('../functions.php');


	
     
     
       
	 $itemCounter = 1; 
	       
	       
	       
	       if(fetchTodayFeed(date("Y-m-d"))) { $todayDataFeed = fetchTodayFeed(date("Y-m-d"));
	       
	       
	      while ($todayData = $todayDataFeed->fetch_object()) {
	       
       
        switch ($itemCounter) {
       
       case(1): ?>
       		<li><div class="area first" <?php if(!empty($todayData->image_TODAY)) printf('style="background: url(\'images/%s\') no-repeat left top;-webkit-background-size: cover;
	      -moz-background-size: cover;
	      -o-background-size: cover;
	      background-size: cover;"',$todayData->image_TODAY); ?>><div class="caption"><p><span class="person"><?php echo $todayData->staff_TODAY; ?>: </span><br><?php echo $todayData->message_TODAY; ?></p></div></div></li>
	      
       <?php break; 
	       
	       case(2): ?>
		   <li><div class="area second" <?php if(!empty($todayData->image_TODAY)) printf('style="background: url(\'images/%s\') no-repeat left top;-webkit-background-size: cover;
	      -moz-background-size: cover;
	      -o-background-size: cover;
	      background-size: cover;"',$todayData->image_TODAY); ?>><div class="caption"><p><span class="person"><?php echo $todayData->staff_TODAY; ?>: </span><br><?php echo $todayData->message_TODAY; ?></p></div></div></li>
	     
	     <?php break; 
	       
	       case(3): ?>
	       
	       <li><div class="area third" <?php if(!empty($todayData->image_TODAY)) printf('style="background: url(\'images/%s\') no-repeat left top;-webkit-background-size: cover;
	      -moz-background-size: cover;
	      -o-background-size: cover;
	      background-size: cover;"',$todayData->image_TODAY); ?>><div class="caption"><p><span class="person"><?php echo $todayData->staff_TODAY; ?>: </span><br><?php echo $todayData->message_TODAY; ?></p></div></div></li>
	      
	      <?php break; 
	       
	       case(4): ?>
	       
	       <li><div class="area fourth" <?php if(!empty($todayData->image_TODAY)) printf('style="background: url(\'images/%s\') no-repeat left top;-webkit-background-size: cover;
	      -moz-background-size: cover;
	      -o-background-size: cover;
	      background-size: cover;"',$todayData->image_TODAY); ?>><div class="caption"><p><span class="person"><?php echo $todayData->staff_TODAY; ?>: </span><br><?php echo $todayData->message_TODAY; ?></p></div></div></li>
	       
	      
	      <?php break; } //End swtich
	      
	      $itemCounter++;
	      
	      } } else { /* End while */   ?>
	      
	      
	      <li><div class="area first"><div class="caption"><p><span class="person">Announcement: </span><br>Awaiting today's updates</p></div></div></li><?php } //End IF ?>

			

