<?php
class MediaItem extends DataObject{
	
	static $db = array(
		"Title" => "Varchar",
		"Information" => "HTMLText",
		"Date" => "Date",
		"Author" => "Varchar"
	);
	
	static $searchable_fields = array('Title');	
	static $summary_fields = array('Title','Date','EmbedVideo.Title','DownloadVideo.Title','MP3.Title' );
	
	static $has_one = array(
		"EmbedVideo" => "File",
		"DownloadVideo" => "File",
		"MP3" => "File"
	);
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
	   $fields = new FieldSet(
	   		new TextField('Title',"Title of the media"),
	   		new TextField('Author',"Speaker/presenter/author"),
	   		new CalendarDateField('Date'),
			new FileIFrameField('EmbedVideo',"FLV file to play on website",null,null,null,"Media"),
			new FileIFrameField('DownloadVideo',"Video file to download",null,null,null,"Media"),
			new FileIFrameField('MP3',"Mp3 audio track",null,null,null,"Media")
	   );
	   return $fields;
	}
	
	function Link(){
		
		if($player = DataObject::get_one("MediaPlayer")){
			return $player->Link()."".$this->ID;
		}
		return false;	
	}

}

class MediaItem_Controller extends Controller{
	
	function render(){
		return $this->renderWith("VideoPlayer");
	}

}
?>
