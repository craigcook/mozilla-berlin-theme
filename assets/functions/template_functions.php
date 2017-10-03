<?php
function convertYoutube( $string ) {
	return preg_replace(
		"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
		"<div class='embed-container youtube'><iframe src=\"//www.youtube.com/embed/$2?&enablejsapi=1\" allowfullscreen></iframe></div>",
		$string
	);
}

function convertVimeo( $string ) {
	$string = preg_replace('#https?://(www\.)?vimeo\.com/(\d+)#','<div class="embed-container vimeo"><iframe class="videoFrame" src="//player.vimeo.com/video/$2?byline=0&portrait=0" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>',$string);
	return $string;
}