<?php
class MediaPlayer extends Page{
	
	static $icon = "media/images/ipod";
	static $db = array(
	);
	
}

class MediaPlayer_Controller extends Page_Controller{
	
	function init(){
		parent::init();
		Requirements::javascript('jsparty/jquery/jquery.js');
		Requirements::javascript('media/flowplayer/flowplayer-3.1.0.min.js');
		Requirements::javascript('media/flowplayer/flowplayer_config.js');
		Requirements::javascript('media/flowplayer/flowplayer.playlist-3.0.5.min.js');
		Requirements::css('media/css/mediaplayer.css');		
	}
	
	function Playlist(){
		if($playlist = DataObject::get('MediaItem','','Date DESC')){
			if(is_numeric($this->action)){
				foreach($playlist as $item){
					if($item->ID == $this->action){
						$item->LinkingMode = "playing";
						continue;
					}
				}
			}else{
				$playlist->First()->LinkingMode = "playing";
			}
			return $playlist;
		}
		return false;
	}
	
	function Title(){
		if(is_numeric($this->action)){
			return $this->Data()->Title." - ".$this->Video()->Title;
		}
		return $this->Data()->Title;
	}
	
	function Video(){
		if(is_numeric($this->action) && $item = DataObject::get_by_id("MediaItem",$this->action)){
			return $item;
		}
		if($this->Playlist()){
			return $this->Playlist()->First();
		}
		return false;
	}
	
	function rss(){
		//stub for rss podcast feed
		return "rss feed here";
	}
	
}

?>
