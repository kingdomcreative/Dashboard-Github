$(document).ready(function(){

// Tab Toggle
	$(".tab-open-close").click(function(){
	  $(".fold-full").slideToggle("slow");
	  $(this).toggleClass("active-ico");

	});
	
// Tab Toggle
	$(".edit-toggle").click(function(){
	  $(".fold-full").slideToggle("slow");

	});
	
// Project Detail Toggle
	$("#projectDetailToggle").click(function(){
	  $(".tab-content").slideToggle("slow");
		$(".cal-date").slideToggle("slow");
	});

// Project Edit Toggle
	$("#projectEditToggle").click(function(){
	  $("#project-edit").slideToggle("slow");
	  $(".tab-content").slideToggle("slow"); 
		$(".cal-date").slideToggle("slow");

	});
	
// Add Film Toggle
	$(".addFilmToggle").click(function(){
	  $("#add-film").slideToggle("slow");
	  $(".tab-content").slideToggle("slow");
		$(".cal-date").slideToggle("slow");

	});

// Add Changes Toggle
	$("#changesFormToggle").click(function(){
	  $("#changesForm").slideToggle("slow");
	  $(".list-changes").toggleClass("make");
});

// Removes #Anchors of sorting
	$('#client-sort-act').click(function(e) {
    e.preventDefault();
});

	$('#client-sort-name').click(function(e) {
    e.preventDefault();
});

	$('#proj-sort-act').click(function(e) {
    e.preventDefault();
});

	$('#proj-sort-your').click(function(e) {
    e.preventDefault();
});

// Allow icons to be replaced

		$(".icon-collapse-top, .icon-collapse-top").click(function(){
	    $(this).toggleClass("icon-collapse-top icon-collapse");
	});


// News Feed Loader

	$("#news-output").fadeOut("slow").load('http://dashboard.circuitpro.co.uk/ajax/refresh_news.php').fadeIn("slow");
	setInterval(function()
	{
	     $("#news-output").fadeOut("slow").load('http://dashboard.circuitpro.co.uk/ajax/refresh_news.php').fadeIn("slow");
	     
	}, 30000);


// News Feed Submit

	var news_form = $('#addNewsContent');
	    news_form.submit(function () {
	    
	    
	    if ($('#newsContent').val() == ''){
		    alert("No news content entered");  
        return false;  
}
	    
	    
	        $.ajax({
	            type: news_form.attr('method'),
	            url: news_form.attr('action'),
	            data: news_form.serialize(),
	            success: function (data) {
	                $(".welldone").fadeToggle();
	                $("#addNewsContent").fadeToggle();
	            }
	        });
	        
	        event.preventDefault();
	        return false;
	        
	    });
	   

// Film Link Creator
 

	    $(function(){
	
	      $('#filmLinkSubmit').click(function() {

	        var filmlink_form = $('#filmLink');
	        
	        if ($('#vimeoLink').val() == ''){
		    alert("No vimeo link entered");  
		    return false;  
        		}
	            		
	        $.ajax({
	        	type: filmlink_form.attr('method'),
	            url: filmlink_form.attr('action'),
	            data: filmlink_form.serialize(),
	            success: function(data){
	                 if(data != null) $("#link-generator").html(data);
	         }
	     });
	     
	      })
	});


// Film Add Submit

	var filmadd_form = $('#addFilm');
	    filmadd_form.submit(function () {
	    
	    
		    if ($('#form-title').val() == 'ENTER FILM TITLE'){
		    alert("Invalid film title entered");
		    $('#form-title').focus();
		    return false;  
        		}
        		
        	if ($('#vimeoID').val() == '' && $('#youtubeID').val() == ''){
		    alert("Invalid film data entered");  
		    return false;  
        		}
	    
	    
	        $.ajax({
	            type: filmadd_form.attr('method'),
	            url: filmadd_form.attr('action'),
	            data: filmadd_form.serialize(),
	            success: function (data) {
	              
	              $(".filmAddFormDone").fadeToggle();
	              
	            }
	        });
	        event.preventDefault();
	        return false;
	    });
	    
// Project Add Submit

	var projectAdd_form = $('#addProject');
	    projectAdd_form.submit(function () {
	    
	    
		    if ($('#project-title').val() == 'ENTER PROJECT TITLE'){
		    alert("Invalid project title entered");
		    $('#project-title').focus();
		    return false;  
        		}
        		
        	if ($('#clientID').val() == 0){
		    alert("No Client Selected");
		    $('#clientID').focus();
		    return false;  
        		}
	    
	    
	        $.ajax({
	            type: projectAdd_form.attr('method'),
	            url: projectAdd_form.attr('action'),
	            data: projectAdd_form.serialize(),
	            success: function (data) {
	              
	              $(".projectAddFormDone").fadeToggle();
	              
	            }
	        });
	        event.preventDefault();
	        return false;
	    });
	    	    
	    
	    
// Film Update Submit

/*
	var filmupdate_form = $('#filmUpdate');
	    filmupdate_form.submit(function () {
	        $.ajax({
	            type: filmupdate_form.attr('method'),
	            url: filmupdate_form.attr('action'),
	            data: filmupdate_form.serialize(),
	            success: function (data) {
	              
	              $(".filmEditForm").fadeToggle();
	              $(".filmEditFormDone").show();
	              
	            }
	        });
	        event.preventDefault();
	        return false;
	    });
*/
	    
// Project Update Submit

	var project_update_form = $('#projectUpdate');
	    project_update_form.submit(function () {
	        $.ajax({
	            type: project_update_form.attr('method'),
	            url: project_update_form.attr('action'),
	            data: project_update_form.serialize(),
	            success: function (data) {
	              
	              $(".projectEditFormDone").show();
	              
	            }
	        });
	        event.preventDefault();
	        return false;
	    });
	   


// Active Projects Loader AJAX

	$.ajax({
	        type: 'GET',
	        data: 'show=all',
	        url: 'http://dashboard.circuitpro.co.uk/ajax/active_projects.php',
	        success: function(data){
	                 if(data != null) $("#active-projects").html(data);
	         }
	     });

// Clients Loader AJAX

	$.ajax({
	        type: 'GET',
	        data: 'sort=login',
	        url: 'http://dashboard.circuitpro.co.uk/ajax/client_list.php',
	        success: function(data){
	                 if(data != null) $("#client-data").html(data);
	         }
	     });
     
// Date Picker

		$(function() {
		$( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
		});


	
}); //END DOCUMENT READY FUNCTIONS


// Update Version

	$(function(){
	
	      $('#updateVersion').click(function() {
	      
	        var film=$(this).data('film');
	            		
	        $.ajax({
	        type: 'GET',
	        data: 'film='+film,
	        url: 'http://dashboard.circuitpro.co.uk/ajax/update_version.php',
	        success: function(data){
	                 if(data != null) $("#updateFilmVersion").html(data);
	         }
	     });
	     
	      })
	});
	



// Project Toggle

	$(function(){
	
	      $('.activeProjectToggle').click(function() {
	      
	        var show=$(this).data('show');
	            		
	        $.ajax({
	        type: 'GET',
	        data: 'show='+show,
	        url: 'http://dashboard.circuitpro.co.uk/ajax/active_projects.php',
	        success: function(data){
	                 if(data != null) $("#active-projects").html(data);
	         }
	     });
	     
	      })
	});

// Client Sort Toggle 
	
	$(function(){
	      $('.clientSortToggle').click(function() {
	            		var sort=$(this).data('sort');
	            		
	           $.ajax({
	        type: 'GET',
	        data: 'sort='+sort,
	        url: 'http://dashboard.circuitpro.co.uk/ajax/client_list.php',
	        success: function(data){
	                 if(data != null) $("#client-data").html(data);
	         }
	     });
	     
	      })
	});


// Form Select 

function SelectAll(id)
{
    document.getElementById(id).focus();
    document.getElementById(id).select();
}
