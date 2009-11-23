<?php

class PageMediaEmbedDecorator extends Extension{
	
	function __construct(){
		parent::__construct();
		Requirements::javascript('media/flowplayer/flowplayer-3.1.0.min.js');
		Requirements::javascript('media/javascript/embedvideo.js');
		Requirements::css('media/css/embedvideo.css');
	}
	
}
?>
