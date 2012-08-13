<?php
class MediaPlayer extends Page{
	
	static $icon = "media/images/ipod";
	
}

class MediaPlayer_Controller extends Page_Controller{
	
	static $allowed_actions = array(
		'view'
	);
	
	function init(){
		parent::init();
		Requirements::javascript(THIRDPARTY_DIR.'/jquery/jquery.js');
		$this->videoid = $this->getRequest()->param('ID');
	}
	
	function Playlist(){		
		$filter = "\"Show\" = TRUE";
		$playlist = DataObject::get('MediaItem',$filter);
		if(is_numeric($this->videoid)){
			foreach($playlist as $item){
				if($item->ID == $this->videoid){
					$item->LinkingMode = "playing";
					continue;
				}
			}
		}elseif($playlist && $playlist->First()){
			$playlist->First()->LinkingMode = "playing";
		}
		return $playlist;
	}
	
	function Title(){
		if($this->Video()){
			return $this->Data()->Title." - ".$this->Video()->Title;
		}
		return $this->Data()->Title;
	}
	
	function Video(){
		if(is_numeric($this->videoid) && $item = DataObject::get_by_id("MediaItem",$this->videoid)){
			return $item;
		}
		if($this->Playlist()){
			return $this->Playlist()->First();
		}
		return false;
	}
	
}