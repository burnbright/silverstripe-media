<?php
class MediaAdmin extends ModelAdmin {
   
  public static $managed_models = array(
      'MediaItem'
   );
 
  static $url_segment = 'media';
  static $menu_title = 'Media';
  
  public function init(){
  		parent::init();
  		Requirements::javascript(THIRDPARTY_DIR . "/behaviour.js");
		Requirements::javascript(THIRDPARTY_DIR . "/calendar/calendar.js");
		Requirements::javascript(THIRDPARTY_DIR . "/calendar/lang/calendar-en.js");
		Requirements::javascript(THIRDPARTY_DIR . "/calendar/calendar-setup.js");
		Requirements::css(SAPPHIRE_DIR . "/css/CalendarDateField.css");
		Requirements::css(THIRDPARTY_DIR . "/calendar/calendar-win2k-1.css");
		
		Requirements::css('media/css/adminfix.css');
  }
 
}
?>
