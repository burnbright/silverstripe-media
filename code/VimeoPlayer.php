<?php
class VimeoPlayer extends MediaPlayer{
	
	//static $icon = "media/images/vimeo";
	static $db = array(
		'Username' => 'Varchar',
		'Album' => 'Varchar' //overrides username
	);

	function getCMSFields(){
		$fields = parent::getCMSFields();
		return $fields;
		
	}

}

class VimeoPlayer_Controller extends MediaPlayer_Controller{
	
	function Video(){
		//$vimsvc = new ViemoService("http://vimeo.com/api/v2/");
		return null;
	}
	
	function Title(){
		if($vid = $this->Video()){
			return $vid->title;
		}
		return $this->Data()->Title;
	}
	
	function Playlist(){
		
		if($this->Album){
			$suburl = "album/130724/videos.php";
		}else{
			$suburl = "meadowschurch/videos.php";
		}
		$vimsvc = new VimeoSimpleService("http://vimeo.com/api/v2/");
		$response = $vimsvc->request($suburl);
		
		$dataset = new DataObjectSet();
		foreach(unserialize($response->getBody()) as $item){
			$data = new ArrayData($item);
			$data->Link = $this->Link().$data->id;
			$dataset->push($data);
		}
				
		return $dataset;
	}
		
}