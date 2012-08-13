<% require ThemedCSS(mediaplayer) %>
<div class="typography">
	<h1 class="pagetitle">$Title</h1>
	$Content
	<div id="Video" >
	
		<% control Video %>
			<% if canView %>
				<div class="viewport">
					$Me
				</div>
				<% if MP3 || DownloadVideo %>
					<p class="downloadlinks"><span>Download as:</span>
					<% if DownloadVideo %><a href="$DownloadVideo.URL"><span class="ui-icon ui-icon-video"></span>video</a><% end_if %> 
					<% if MP3 %><a href="$MP3.URL"><span class="ui-icon ui-icon-volume-off"></span>mp3</a><% end_if %></p>
					<div class="clear"></div>		
				<% end_if %>
				<% if Description %><p class="description">$Description</p><% end_if %>
			<% else %>
				<p class="message bad">This video is for logged-in members only</p>
			<% end_if %>
		<% end_control %>
		
	</div>
	<div id="MediaPlaylist">
		<% control Playlist %>
			<a class="mediaitem $LinkingMode<% if MembersOnly %> membersonly<% end_if %>" href="$Link" title="<% if MembersOnly %>$Alt<% end_if %>" >
				<% if OverrideTitle %>
					$Title
				<% else %>
		        	<% if Date %><span class="date">$Date.DayOfMonth $Date.ShortMonth $Date.Year</span> - <% end_if %><span class="title">$Title</span><% if Author %> - <span class="author">$Author</span><% end_if %>
		        <% end_if %>
				<% if EmbedVideo || ExternalVid %><img class="ui-icon ui-icon-image" src="$ThemeDir/images/emptyicon.gif" title="streaming video"/><% end_if %>
				<% if DownloadVideo %><img class="ui-icon ui-icon-video" src="$ThemeDir/images/emptyicon.gif" title="video download"/><% end_if %>
		        <% if MP3 %><img class="ui-icon ui-icon-volume-off" src="$ThemeDir/images/emptyicon.gif" title="mp3"/><% end_if %>
		      <% if MembersOnly %><img class="ui-icon ui-icon-locked" src="$ThemeDir/images/emptyicon.gif" title="members only video"/><% end_if %>
		   	</a>
		<% end_control %>
	</div>
</div>