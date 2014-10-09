
    
    
<div class="row-fluid">

<?php $projectFilms = fetchRelatedFilms($projectData->_kp_PROJECT,0); ?> 

<div class="span9"><h2 class="sub-title">Changes</h2></div>  


<?php if($projectFilms) { ?> 
<div class="span3 edit"><a class="btn btn-success" href="#" id="changesFormToggle">ADD CHANGES</a></div><?php } ?>

    <div class="clearboth"></div>
 <!--  ONLY SHOW IF FILMS ARE IN PLACE -->
    
    
    <div class="list-changes">
    <?php if($projectFilms) { ?>  
        

<?php $projectChanges = fetchAllProjectChanges($projectData->_kp_PROJECT); 

 while( $changeDetail = $projectChanges->fetch_object()) { ?>

 
     <h5><?php echo $changeDetail->film_CHANGES; ?></h5>
     
     <p>Added: <?php echo $changeDetail->shortname_STAFF; ?> on <?php echo $changeDetail->added_CHANGES; ?></p>
     
     <p><?php echo nl2br($changeDetail->content_CHANGES); ?></p>
     
     
     
     <hr />
     
     
      <?php } ?>
      
               <div id="changesForm" style="display: none;">
      <form action="/ajax/add_changes.php" method="post" enctype="multipart/form-data" id="addChangesForm" name="addChangesForm"/>
      <input type="hidden" name="projectID" value="<?php echo $projectData->_kp_PROJECT; ?>"/>
      <input type="hidden" name="staffID" value="<?php echo $staffData->_kp_STAFF; ?>"/>
      <input type="hidden" name="projectTitle" value="<?php echo $projectData->title_PROJECT; ?>"/>
      <h5>ADD CHANGE REQUEST</h5>
      <p><select name="film" class="" style="width:200px">
       <?php while ($projectFilmData = $projectFilms->fetch_object()) { 
      
      printf('<option value="%s (version %d)">%s (version %d)</option>',$projectFilmData->title_VIDEO,$projectFilmData->version_VIDEO,$projectFilmData->title_VIDEO,$projectFilmData->version_VIDEO);
       } ?>
      </select></p>
      <p>
      <textarea class="add-area" name="changesContent"></textarea></p>
      <input type="submit" class="btn btn-success proj-form-sub" value="SAVE CHANGES">
      </form>
      </div>  
      
      
      <?php } /* END IF FILMS ARE IN PLACE */ ?>

       </div>   
  
     

      
 

   
    
</div>

   

