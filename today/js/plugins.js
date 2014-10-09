/*global jQuery */
/*jshint multistr:true browser:true */
/*!
* FitVids 1.0.3
*
* Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
* Date: Thu Sept 01 18:00:00 2011 -0500
*/

(function( $ ){

  "use strict";

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null
    };

    if(!document.getElementById('fit-vids-style')) {

      var div = document.createElement('div'),
          ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0],
          cssStyles = '&shy;<style>.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style>';

      div.className = 'fit-vids-style';
      div.id = 'fit-vids-style';
      div.style.display = 'none';
      div.innerHTML = cssStyles;

      ref.parentNode.insertBefore(div,ref);

    }

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        "iframe[src*='player.vimeo.com']",
        "iframe[src*='youtube.com']",
        "iframe[src*='youtube-nocookie.com']",
        "iframe[src*='kickstarter.com'][src*='video.html']",
        "object",
        "embed"
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var $allVideos = $(this).find(selectors.join(','));
      $allVideos = $allVideos.not("object object"); // SwfObj conflict patch

      $allVideos.each(function(){
        var $this = $(this);
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
        if(!$this.attr('id')){
          var videoID = 'fitvid' + Math.floor(Math.random()*999999);
          $this.attr('id', videoID);
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };
// Works with either jQuery or Zepto
})( window.jQuery || window.Zepto );

/*
	Totem Ticker Plugin
	Copyright (c) 2011 Zach Dunn / www.buildinternet.com
	Released under MIT License
	--------------------------
	Structure based on Doug Neiner's jQuery plugin blueprint: http://starter.pixelgraphics.us/
*/
(function( $ ){
	
	if(!$.omr){
		$.omr = new Object();
	};

	$.omr.totemticker = function(el, options ) {
	  	
	  	var base = this;
	  	
		//Define the DOM elements
	  	base.el = el;
	  	base.$el = $(el);
	  	
	  	// Add a reverse reference to the DOM object
        base.$el.data("omr.totemticker", base);
	  	
	  	base.init = function(){
            base.options = $.extend({},$.omr.totemticker.defaultOptions, options);
            
            //Define the ticker object
           	base.ticker;
			
			//Adjust the height of ticker if specified
			base.format_ticker();
			
			//Setup navigation links (if specified)
			base.setup_nav();
			
			//Start the ticker
			base.start_interval();
			
			//Debugging info in console
			//base.debug_info();
        };
		
		base.start_interval = function(){
			
			//Clear out any existing interval
			clearInterval(base.ticker);
			
	    	base.ticker = setInterval(function() {
	    	
	    		base.$el.find('li:first').animate({
	            	marginTop: '-' + base.options.row_height,
	            }, base.options.speed, function() {
	                $(this).detach().css('marginTop', '0').appendTo(base.$el);
	            });
	            
	    	}, base.options.interval);
	    }
	    
	    base.reset_interval = function(){
	    	clearInterval(base.ticker);
	    	base.start_interval();
	    }
	    
	    base.stop_interval = function(){
	    	clearInterval(base.ticker);
	    }
	
		base.format_ticker = function(){
		
			if(typeof(base.options.max_items) != "undefined" && base.options.max_items != null) {
				
				//Remove units of measurement (Should expand to cover EM and % later)
				var stripped_height = base.options.row_height.replace(/px/i, '');
				var ticker_height = stripped_height * base.options.max_items;
			
				base.$el.css({
					height		: ticker_height + 'px', 
					overflow	: 'hidden',	
				});
				
			}else{
				//No heights were specified, so just doublecheck overflow = hidden
				base.$el.css({
					overflow	: 'hidden',
				})
			}
			
		}
	
		base.setup_nav = function(){
			
			//Stop Button
			if (typeof(base.options.stop) != "undefined"  && base.options.stop != null){
				$(base.options.stop).click(function(){
					base.stop_interval();
					return false;
				});
			}
			
			//Start Button
			if (typeof(base.options.start) != "undefined"  && base.options.start != null){
				$(base.options.start).click(function(){
					base.start_interval();
					return false;
				});
			}
			
			//Previous Button
			if (typeof(base.options.previous) != "undefined"  && base.options.previous != null){
				$(base.options.previous).click(function(){
					base.$el.find('li:last').detach().prependTo(base.$el).css('marginTop', '-' + base.options.row_height);
					base.$el.find('li:first').animate({
				        marginTop: '0px',
				    }, base.options.speed, function () {
				        base.reset_interval();
				    });
				    return false;
				});
			}
			
			//Next Button
			if (typeof(base.options.next) != "undefined" && base.options.next != null){
				$(base.options.next).click(function(){
					base.$el.find('li:first').animate({
						marginTop: '-' + base.options.row_height,
			        }, base.options.speed, function() {
			            $(this).detach().css('marginTop', '0px').appendTo(base.$el);
			            base.reset_interval();
			        });
			        return false;
				});
			}
			
			//Stop on mouse hover
			if (typeof(base.options.mousestop) != "undefined" && base.options.mousestop === true) {
				base.$el.mouseenter(function(){
					base.stop_interval();
				}).mouseleave(function(){
					base.start_interval();
				});
			}
			
			/*
				TO DO List
				----------------
				Add a continuous scrolling mode
			*/
			
		}
		
		base.debug_info = function()
		{
			//Dump options into console
			console.log(base.options);
		}
		
		//Make it go!
		base.init();
  };
  
  $.omr.totemticker.defaultOptions = {
  		message		:	'Ticker Loaded',	/* Disregard */
  		next		:	null,		/* ID of next button or link */
  		previous	:	null,		/* ID of previous button or link */
  		stop		:	null,		/* ID of stop button or link */
  		start		:	null,		/* ID of start button or link */
  		row_height	:	'100px',	/* Height of each ticker row in PX. Should be uniform. */
  		speed		:	800,		/* Speed of transition animation in milliseconds */
  		interval	:	4000,		/* Time between change in milliseconds */
		max_items	: 	null, 		/* Integer for how many items to display at once. Resizes height accordingly (OPTIONAL) */
  };
  
  $.fn.totemticker = function( options ){
    return this.each(function(){
    	(new $.omr.totemticker(this, options));
  	});
  };
  
})( jQuery );


/* jQuery MaxLength for INPUT and TEXTAREA fields v1.0
* Last updated: Oct 15th, 2009. This notice must stay intact for usage 
* Author: JavaScript Kit at http://www.javascriptkit.com/
* Visit http://www.javascriptkit.com/ for full source code
*/


var thresholdcolors=[['20%','darkred'], ['10%','red']] //[chars_left_in_pct, CSS color to apply to output]
var uncheckedkeycodes=/(8)|(13)|(16)|(17)|(18)/  //keycodes that are not checked, even when limit has been reached.

thresholdcolors.sort(function(a,b){return parseInt(a[0])-parseInt(b[0])}) //sort thresholdcolors by percentage, ascending

function setformfieldsize($fields, optsize, optoutputdiv){
	var $=jQuery
	$fields.each(function(i){
		var $field=$(this)
		$field.data('maxsize', optsize || parseInt($field.attr('data-maxsize'))) //max character limit
		var statusdivid=optoutputdiv || $field.attr('data-output') //id of DIV to output status
		$field.data('$statusdiv', $('#'+statusdivid).length==1? $('#'+statusdivid) : null)
		$field.unbind('keypress.restrict').bind('keypress.restrict', function(e){
			setformfieldsize.restrict($field, e)
		})
		$field.unbind('keyup.show').bind('keyup.show', function(e){
			setformfieldsize.showlimit($field)
		})
		setformfieldsize.showlimit($field) //show status to start
	})
}

setformfieldsize.restrict=function($field, e){
	var keyunicode=e.charCode || e.keyCode
	if (!uncheckedkeycodes.test(keyunicode)){
		if ($field.val().length >= $field.data('maxsize')){ //if characters entered exceed allowed
			if (e.preventDefault)
				e.preventDefault()
			return false
		}
	}
}

setformfieldsize.showlimit=function($field){
	if ($field.val().length > $field.data('maxsize')){
		var trimmedtext=$field.val().substring(0, $field.data('maxsize'))
		$field.val(trimmedtext)
	}
	if ($field.data('$statusdiv')){
		$field.data('$statusdiv').css('color', '').html($field.val().length)
		var pctremaining=($field.data('maxsize')-$field.val().length)/$field.data('maxsize')*100 //calculate chars remaining in terms of percentage
		for (var i=0; i<thresholdcolors.length; i++){
			if (pctremaining<=parseInt(thresholdcolors[i][0])){
				$field.data('$statusdiv').css('color', thresholdcolors[i][1])
				break
			}
		}
	}
}

jQuery(document).ready(function($){ //fire on DOM ready
	var $targetfields=$("input[data-maxsize], textarea[data-maxsize]") //get INPUTs and TEXTAREAs on page with "data-maxsize" attr defined
	setformfieldsize($targetfields)
})