<?php

/**
 * 
 * api url: http://vimeo.com/api/v2/username/request.output
 * 
 * 
 */

class VimeoSimpleService extends RestfulService{
	
	protected static $username = ''; // vimeo username
	protected static $request = ''; //info, videos, appears_in, all_videos, subscriptions, albums, channels, groups, contacts_videos, contacts_like
	protected static $output = 'PHP'; // PHP, JSON, or XML ..we'll use php by default
	
	
	
}

?>
