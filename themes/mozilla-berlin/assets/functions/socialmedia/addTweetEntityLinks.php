<?php
/**
 * addTweetEntityLinks
 *
 * adds a link around any entities in a twitter feed
 * twitter entities include urls, user mentions, and hashtags
 *
 * @author     Joe Sexton <joe@webtipblog.com>
 * @param      object $tweet a JSON tweet object v1.1 API
 * @return     string tweet
 */
function addTweetEntityLinks( $tweet )
{
	// actual tweet as a string
	$tweetText = $tweet->text;
 
	// create an array to hold urls
	$tweetEntites = array();
 
	// add each url to the array
	foreach( $tweet->entities->urls as $url ) {
		$tweetEntites[] = array (
				'type'    => 'url',
				'curText' => substr( $tweetText, $url->indices[0], ( $url->indices[1] - $url->indices[0] ) ),
				'newText' => "<a href='".$url->expanded_url."' target='_blank'>".$url->display_url."</a>"
			);
	}  // end foreach
 
	// add each user mention to the array
	foreach ( $tweet->entities->user_mentions as $mention ) {
		$string = substr( $tweetText, $mention->indices[0], ( $mention->indices[1] - $mention->indices[0] ) );
		$tweetEntites[] = array (
				'type'    => 'mention',
				'curText' => substr( $tweetText, $mention->indices[0], ( $mention->indices[1] - $mention->indices[0] ) ),
				'newText' => "<a href='http://twitter.com/".$mention->screen_name."' target='_blank'>".$string."</a>"
			);
	}  // end foreach
 
	// add each hashtag to the array
	foreach ( $tweet->entities->hashtags as $tag ) {
		$string = substr( $tweetText, $tag->indices[0], ( $tag->indices[1] - $tag->indices[0] ) );
		$tweetEntites[] = array (
				'type'    => 'hashtag',
				'curText' => substr( $tweetText, $tag->indices[0], ( $tag->indices[1] - $tag->indices[0] ) ),
				'newText' => "<a href='http://twitter.com/search?q=%23".$tag->text."&src=hash' target='_blank'>".$string."</a>"
			);
	}  // end foreach
 
	// replace the old text with the new text for each entity
	foreach ( $tweetEntites as $entity ) {
		$tweetText = str_replace( $entity['curText'], $entity['newText'], $tweetText );
	} // end foreach
 
	return $tweetText;
 
} // end addTweetEntityLinks()