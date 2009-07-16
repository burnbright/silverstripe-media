<h1 class="pagetitle">$Title</h1>
$Content
<div id="Video" >
	<% control Video %>
		<% if EmbedVideo %>
			<a href="$EmbedVideo.URL" id="player"></a>
		<% else %>
			<a href="$MP3.URL" id="player"></a>
		<% end_if %>
		
		<% if MP3 || DownloadVideo %>
			<p class="downloadlinks"><span>Download as:</span>
			<% if DownloadVideo %>
				<a href="$DownloadVideo.URL"><span class="ui-icon ui-icon-video"></span>video</a>
			<% end_if %> 
			<% if MP3 %>
				<a href="$MP3.URL"><span class="ui-icon ui-icon-volume-off"></span>mp3</a>
			<% end_if %>
			<div class="clear"></div>		
		<% end_if %>
	<% end_control %>
</div>

<div id="MediaPlaylist">
	<% control Playlist %>
		    <a class="mediaitem $LinkingMode" href="$Link"> 
	        	<% if Date %><span class="date">$Date.DayOfMonth $Date.ShortMonth $Date.Year</span> - <% end_if %>$Title <span>$SubTitle</span>
					<% if EmbedVideo %><img class="ui-icon ui-icon-image" src="$ThemeDir/images/emptyicon.gif" title="streaming video"/><% end_if %>
					<% if DownloadVideo %><img class="ui-icon ui-icon-video" src="$ThemeDir/images/emptyicon.gif" title="video download"/><% end_if %>
	        		<% if MP3 %><img class="ui-icon ui-icon-volume-off" src="$ThemeDir/images/emptyicon.gif" title="mp3"/><% end_if %>
	    	</a>
	<% end_control %>
</div>