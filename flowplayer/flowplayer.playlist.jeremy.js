/**
 * flowplayer.playlist.js 3.0.5. Flowplayer JavaScript plugin.
 * 
 * This file is part of Flowplayer, http://flowplayer.org
 *
 * Author: Tero Piirainen, <support@flowplayer.org>
 * Copyright (c) 2008 Flowplayer Ltd
 *
 * Dual licensed under MIT and GPL 2+ licenses
 * SEE: http://www.opensource.org/licenses
 * 
 * Version: 3.0.5 - Tue Feb 24 2009 11:42:25 GMT-0000 (GMT+00:00)
 */
(function($) {
	
	$f.addPlugin("playlist", function(wrap, options) {
	
		// self points to current Player instance
		var self = this;	
		
		var opts = {
			playingClass: 'playing',
			pausedClass: 'paused',
			progressClass:'progress',
			template: '<a href="${url}">${title}</a>',
			loop: false,
			playOnClick: true,
			manual: false
		};		
		
		$.extend(opts, options);
		wrap = $(wrap);		
		var manual = self.getPlaylist().length <= 1 || opts.manual; 
		var els = null;
		

		/* setup playlists with onClick handlers */ 
		
		// template based playlist
		if (!manual) {
			
			var template = wrap.is(":empty") ? opts.template : wrap.html(); 
			wrap.empty(); 
				
			$.each(self.getPlaylist(), function() { 
				
				if (this.duration === 0) { return false; }
				
				var el = template;	
				
				var self = this;
				$.each(this, function(key, val) {	
					if (!$.isFunction(val)) {
						el = el.replace("$\{" +key+ "\}", val).replace("$%7B" +key+ "%7D", val);			
					}
				});				 
				
				wrap.append(el);
				
			});
			
			// assign onClick event for each clip
			els = wrap.children().click(function()  {
				return play($(this), els.index(this));						
			});	
			
			
		// HTML based playlist
		} else {
			
			els = wrap.children();
			
			// @deprecated, no longer needed after scrollable 1.0.0
			if (els.eq(0).hasClass("__scrollable")) { els = els.children(); }
			
			
			// allows dynamic addition of elements
			if ($.isFunction(els.live)) {
				$(wrap.selector + "> *").live("click", function() {
					var el = $(this);
					return play(el, el.attr("href"));
				});
				
			} else {
				els.click(function() {
					var el = $(this);
					return play(el, el.attr("href"));
				});					
			}
						 
					
			// setup player to play first clip
			var clip = self.getClip(0);
			if (!clip.url && opts.playOnClick) {
				clip.update({url: els.eq(0).attr("href")});		
			}   
			
		}
		
		function play(el, clip)  {
		
			if (el.hasClass(opts.playingClass) || el.hasClass(opts.pausedClass)) {
				self.toggle();
				
			} else {
				el.addClass(opts.progressClass);
				self.play(clip); 							
			}			
			
			return false;
		}	
		
		
		function clearCSS() {
			if (manual) { els = wrap.children(); }
			els.removeClass(opts.playingClass);
			els.removeClass(opts.pausedClass);
			els.removeClass(opts.progressClass);			
		}
		
		function getEl(clip) {		
			return (manual) ? els.filter("[href=" + clip.url + "]") : els.eq(clip.index);	
		}
		
		// onBegin
		self.onBegin(function(clip) {
			clearCSS();		
			getEl(clip).addClass(opts.playingClass);
		});	
		
		// onPause	
		self.onPause(function(clip) {
			getEl(clip).removeClass(opts.playingClass).addClass(opts.pausedClass);		
		});	
		
		// onResume
		self.onResume(function(clip) {
			getEl(clip).removeClass(opts.pausedClass).addClass(opts.playingClass);		
		});		
		
		// what happens when clip ends ?
		if (!opts.loop && !manual) {
			
			// stop the playback exept on the last clip, which is stopped by default
			self.onBeforeFinish(function(clip) {
				if (clip.index < els.length -1) {
					return false;
				}
			}); 
		}
		
		// on manual setups perform looping here
		if (manual && opts.loop) {
			self.onBeforeFinish(function(clip) {
				var el = getEl(clip);
				if (el.next().length) {
					el.next().click();	 		
				} else {
					els.eq(0).click();	
				} 
				return false;				
			}); 
		}
		
		// onUnload
		self.onUnload(function() {
			clearCSS();		
		});
		
		
		return self;
		
	});
		
})(jQuery);		
