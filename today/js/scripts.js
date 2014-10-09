// DOM Ready
$(function() {

// PNG Fallback for SVG
if(!Modernizr.svg) {
    $('img[src*="svg"]').attr('src', function() {
        return $(this).attr('src').replace('.svg', '.png');
    });
}

var button = $(".form-sub");
button.on("click", function() {
  button.data("text-original", button.text());
  button.text(button.data("text-swap"));
});

$(".form-sub").on("click",function() {
	$( "input.form-sub" ).val("POSTING NEWS...");
});


	// Basic FitVids
	$(".container").fitVids();
	$(".video").fitVids();
	
// Today Content Loader

	$("#today-output").fadeOut("fast").load('http://dashboard.kingdom-creative.co.uk/ajax/today_feed.php').fadeIn("slow");
	
	setInterval(function()
	{
	     $("#today-output").fadeOut("fast").load('http://dashboard.kingdom-creative.co.uk/ajax/today_feed.php').fadeIn("slow");
	     
	}, 50000);

        
$('#vertical-ticker').totemticker({
				row_height	:	'570px',
				next		:	'#ticker-next',
				previous	:	'#ticker-previous',
				stop		:	'#stop',
				start		:	'#start',
				mousestop	:	true,
			});

$('#vertical-ticker-ipad').totemticker({
				row_height	:	'520px',
				next		:	'#ticker-next',
				previous	:	'#ticker-previous',
				stop		:	'#stop',
				start		:	'#start',
				mousestop	:	true,
			});

});

