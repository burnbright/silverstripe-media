<?php
class MediaItem extends DataObject{
	
	static $db = array(
		"Title" => "Varchar(255)",
		"Description" => "Text",
		"Date" => "Date",
		"Author" => "Varchar",
		"ExternalVid" => "Varchar",
		"Show" => "Boolean",
		
		'Sort' => 'Int',
		'OverrideTitle' => 'Boolean'
	);
	
	static $searchable_fields = array('Title');	
	static $summary_fields = array('Title','Date','EmbedVideo.Title','DownloadVideo.Title','MP3.Title','Show' );
	
	static $default_sort = "Sort DESC, Created DESC";
	
	static $has_one = array(
		"EmbedVideo" => "File",
		"DownloadVideo" => "File",
		"MP3" => "File"
	);
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields = new FieldSet(
	   		new TextField('Title',"Title of the media"),
	   		new CheckboxField('OverrideTitle','Override Title (ie only show this title, and not date/author etc)'),
	   		new CheckboxField("Show","Display on front-end"),
	   		new TextField('Author',"Speaker/presenter/author"),
	   		new TextareaField('Description','Description'),
	   		new TextField('ExternalVid',"External Video ID (Vimeo)"),
	   		$date = new DateField('Date'),
	   		new NumericField('Sort','Sort (higest number shows first)'),
			new FileIFrameField('EmbedVideo',"FLV file to play on website",null,null,null,"Media"),
			new FileIFrameField('DownloadVideo',"Video file to download",null,null,null,"Media"),
			new FileIFrameField('MP3',"Mp3 audio track",null,null,null,"Media")
		);
		$date->setConfig('showcalendar',true);
		return $fields;
	}
	
	function Link(){
		if($player = DataObject::get_one("MediaPlayer")){
			return $player->Link('view')."/".$this->ID;
		}
		return false;	
	}
	
	function forTemplate(){
		$vid = "<div>No media found.</div>";
		if($this->EmbedVideoID){
			Requirements::javascript('media/flowplayer/flowplayer-3.1.0.min.js');
			Requirements::javascript('media/flowplayer/flowplayer_config.js');
			$vid = '<a href="'.$this->EmbedVideo()->URL.'" id="player"></a>';
		}elseif($ext = $this->ExternalVid){
			$vid = $this->renderWith('VimeoPlayer'); //TODO: extend to support youtube, etc
		}
		return $vid;
	}

}

?>
