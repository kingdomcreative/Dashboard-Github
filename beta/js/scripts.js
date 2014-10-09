// DOM Ready
$(function() {

// PNG Fallback for SVG
if(!Modernizr.svg) {
    $('img[src*="svg"]').attr('src', function() {
        return $(this).attr('src').replace('.svg', '.png');
    });
}


	// Basic FitVids
	$(".container").fitVids();
	$(".video-wrap").fitVids();
        
	// DATEPICKER
	$('.datepicker').pickadate();
	
	$('.project-tabs li a').tooltip();
	$('.film-tabs li a').tooltip();
	
	
	
// HOURS JS
$("#addHours").click(function(){ $('#hours').fadeToggle("fast"); });

$("#addChanges").click(function(){ $('#change').fadeToggle("fast"); });

});
