$(document).ready(function(){
	
	$f("player",
		{src: "media/flowplayer/flowplayer-3.1.0.swf", wmode: 'transparent'},
		{clip:{autoPlay: false,	autoBuffering: false},
		plugins: { 
	        audio: { 
	            url: 'media/flowplayer/flowplayer.audio-3.1.0.swf' 
	        },
	        controls: {
	            buttonColor: '#5F747C',
	            buttonOverColor: '#728B94',
	            volumeSliderColor: '#000000',
	            sliderGradient: 'none',
	            tooltipColor: '#5F747C',
	            volumeSliderGradient: 'none',
	            timeColor: '#ff960f',
	            sliderColor: '#000000',
	            tooltipTextColor: '#ffffff',
	            progressGradient: 'medium',
	            backgroundColor: '#000000',
	            progressColor: '#2356a9',
	            borderRadius: '0px',
	            durationColor: '#ffffff',
	            bufferColor: '#445566',
	            backgroundGradient: [0.6,0.3,0,0,0],
	            bufferGradient: 'none',
	            timeBgColor: '#555555',
	            height: 24,
	            opacity: 1.0
	            //playlist: true
	         }
	    } 
		});
	
	
	//$f("player").play($("#MediaPlaylist a:first").attr("href"));
	//alert($("#MediaPlaylist a:first").attr("href"));

});