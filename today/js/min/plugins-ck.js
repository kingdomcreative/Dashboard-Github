function setformfieldsize(t,e,i){var o=jQuery;t.each(function(t){var n=o(this);n.data("maxsize",e||parseInt(n.attr("data-maxsize")));var r=i||n.attr("data-output");n.data("$statusdiv",1==o("#"+r).length?o("#"+r):null),n.unbind("keypress.restrict").bind("keypress.restrict",function(t){setformfieldsize.restrict(n,t)}),n.unbind("keyup.show").bind("keyup.show",function(t){setformfieldsize.showlimit(n)}),setformfieldsize.showlimit(n)})}!function(t){"use strict";t.fn.fitVids=function(e){var i={customSelector:null};if(!document.getElementById("fit-vids-style")){var o=document.createElement("div"),n=document.getElementsByTagName("base")[0]||document.getElementsByTagName("script")[0],r="&shy;<style>.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style>";o.className="fit-vids-style",o.id="fit-vids-style",o.style.display="none",o.innerHTML=r,n.parentNode.insertBefore(o,n)}return e&&t.extend(i,e),this.each(function(){var e=["iframe[src*='player.vimeo.com']","iframe[src*='youtube.com']","iframe[src*='youtube-nocookie.com']","iframe[src*='kickstarter.com'][src*='video.html']","object","embed"];i.customSelector&&e.push(i.customSelector);var o=t(this).find(e.join(","));o=o.not("object object"),o.each(function(){var e=t(this);if(!("embed"===this.tagName.toLowerCase()&&e.parent("object").length||e.parent(".fluid-width-video-wrapper").length)){var i="object"===this.tagName.toLowerCase()||e.attr("height")&&!isNaN(parseInt(e.attr("height"),10))?parseInt(e.attr("height"),10):e.height(),o=isNaN(parseInt(e.attr("width"),10))?e.width():parseInt(e.attr("width"),10),n=i/o;if(!e.attr("id")){var r="fitvid"+Math.floor(999999*Math.random());e.attr("id",r)}e.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",100*n+"%"),e.removeAttr("height").removeAttr("width")}})})}}(window.jQuery||window.Zepto),function(t){t.omr||(t.omr=new Object),t.omr.totemticker=function(e,i){var o=this;o.el=e,o.$el=t(e),o.$el.data("omr.totemticker",o),o.init=function(){o.options=t.extend({},t.omr.totemticker.defaultOptions,i),o.ticker,o.format_ticker(),o.setup_nav(),o.start_interval()},o.start_interval=function(){clearInterval(o.ticker),o.ticker=setInterval(function(){o.$el.find("li:first").animate({marginTop:"-"+o.options.row_height},o.options.speed,function(){t(this).detach().css("marginTop","0").appendTo(o.$el)})},o.options.interval)},o.reset_interval=function(){clearInterval(o.ticker),o.start_interval()},o.stop_interval=function(){clearInterval(o.ticker)},o.format_ticker=function(){if("undefined"!=typeof o.options.max_items&&null!=o.options.max_items){var t=o.options.row_height.replace(/px/i,""),e=t*o.options.max_items;o.$el.css({height:e+"px",overflow:"hidden"})}else o.$el.css({overflow:"hidden"})},o.setup_nav=function(){"undefined"!=typeof o.options.stop&&null!=o.options.stop&&t(o.options.stop).click(function(){return o.stop_interval(),!1}),"undefined"!=typeof o.options.start&&null!=o.options.start&&t(o.options.start).click(function(){return o.start_interval(),!1}),"undefined"!=typeof o.options.previous&&null!=o.options.previous&&t(o.options.previous).click(function(){return o.$el.find("li:last").detach().prependTo(o.$el).css("marginTop","-"+o.options.row_height),o.$el.find("li:first").animate({marginTop:"0px"},o.options.speed,function(){o.reset_interval()}),!1}),"undefined"!=typeof o.options.next&&null!=o.options.next&&t(o.options.next).click(function(){return o.$el.find("li:first").animate({marginTop:"-"+o.options.row_height},o.options.speed,function(){t(this).detach().css("marginTop","0px").appendTo(o.$el),o.reset_interval()}),!1}),"undefined"!=typeof o.options.mousestop&&o.options.mousestop===!0&&o.$el.mouseenter(function(){o.stop_interval()}).mouseleave(function(){o.start_interval()})},o.debug_info=function(){console.log(o.options)},o.init()},t.omr.totemticker.defaultOptions={message:"Ticker Loaded",next:null,previous:null,stop:null,start:null,row_height:"100px",speed:800,interval:4e3,max_items:null},t.fn.totemticker=function(e){return this.each(function(){new t.omr.totemticker(this,e)})}}(jQuery);var thresholdcolors=[["20%","darkred"],["10%","red"]],uncheckedkeycodes=/(8)|(13)|(16)|(17)|(18)/;thresholdcolors.sort(function(t,e){return parseInt(t[0])-parseInt(e[0])}),setformfieldsize.restrict=function(t,e){var i=e.charCode||e.keyCode;return!uncheckedkeycodes.test(i)&&t.val().length>=t.data("maxsize")?(e.preventDefault&&e.preventDefault(),!1):void 0},setformfieldsize.showlimit=function(t){if(t.val().length>t.data("maxsize")){var e=t.val().substring(0,t.data("maxsize"));t.val(e)}if(t.data("$statusdiv")){t.data("$statusdiv").css("color","").html(t.val().length);for(var i=(t.data("maxsize")-t.val().length)/t.data("maxsize")*100,o=0;o<thresholdcolors.length;o++)if(i<=parseInt(thresholdcolors[o][0])){t.data("$statusdiv").css("color",thresholdcolors[o][1]);break}}},jQuery(document).ready(function(t){var e=t("input[data-maxsize], textarea[data-maxsize]");setformfieldsize(e)});