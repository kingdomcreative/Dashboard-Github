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
	  $("#project-info").slideToggle("slow");

	});

// Project Edit Toggle
	$("#projectEditToggle").click(function(){
	  $("#project-edit").slideToggle("slow");
	  $("#project-info").slideToggle("slow");

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
	        $.ajax({
	            type: news_form.attr('method'),
	            url: news_form.attr('action'),
	            data: news_form.serialize(),
	            success: function (data) {
	                alert("News Content Added");
	            }
	        });
	        event.preventDefault();
	        return false;
	    });
	   
	    $(".form-sub").click(function () {
		   $(".welldone").fadeToggle();
		   $("#addNewsContent").fadeToggle();
	});

// Film Link Creator
 
	 var filmlink_form = $('#filmLink');
	    filmlink_form.submit(function () {
	        $.ajax({
	            type: filmlink_form.attr('method'),
	            url: filmlink_form.attr('action'),
	            data: filmlink_form.serialize(),
	            success: function(data){
	                 if(data != null) $("#link-generator").html(data);
	            }
	        });
	        event.preventDefault();
	        return false;
	    });

	    
// Film Update Submit

	var filmupdate_form = $('#filmUpdate');
	    filmupdate_form.submit(function () {
	        $.ajax({
	            type: filmupdate_form.attr('method'),
	            url: filmupdate_form.attr('action'),
	            data: filmupdate_form.serialize(),
	            success: function (data) {
	              
	            }
	        });
	        event.preventDefault();
	        return false;
	    });
	   
	    $(".form-sub").click(function () {
		   $(".filmEditForm").fadeToggle();
		   $(".filmEditFormDone").fadeToggle();
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
	


// Edit Film

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
