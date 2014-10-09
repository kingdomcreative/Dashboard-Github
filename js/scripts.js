// DOM Ready
$(function() {

	// Basic FitVids
	$(".container").fitVids();
	$(".video-wrap").fitVids();
        
	// Datepicker
	$('.datepicker').pickadate({
		format: 'yyyy-mm-dd'
	});
	
	// Project tabs tooltip
	$('.project-tabs li a').tooltip();
	
	// Films tabs tooltip
	$('.film-tabs li a').tooltip();
	
	// Add hours reveal
	$("#addHours").click(function(){ $('#hours').fadeToggle("fast"); });

	// Add changes reveal
	$("#addChanges").click(function(){ $('#change').fadeToggle("fast"); });
	
	// Show right tab on Edit Project button
	$("#editProjectButton").click(function(){ 
	$('.project-tabs a[href="#editProject"]').tab('show');
	});
	
	// Show right tab on Add Film button
	$("#addFilmButton").click(function(){ 
	$('.project-tabs a[href="#addFilm"]').tab('show');
	});
	
	// Swap Finance & Production Tasks
	
	$("#tasksProd").click(function(){ 
	console.log("hello");
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
	    
	    $(".filmAddFormDone").fadeToggle();
	    
	        $.ajax({
	            type: filmadd_form.attr('method'),
	            url: filmadd_form.attr('action'),
	            data: filmadd_form.serialize(),
	            success: function (data) {
	              
	              $("#show_loading").fadeToggle();
	              location.reload();
	              
	            }
	        });
	        event.preventDefault();
	        return false;
	    });
	    
	    
	// Show right tab on Add Film button
	$("#editFilmButton").click(function(){ 
	$('.film-tabs a[href="#editFilm"]').tab('show');
	});

});
