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

$social_media_posts = array();

function buildBaseString($baseURI, $method, $params) {
	$r = array();
	ksort($params);
	foreach($params as $key=>$value){
		$r[] = "$key=" . rawurlencode($value);
	}
	return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
}

function buildAuthorizationHeader($oauth) {
	$r = 'Authorization: OAuth ';
	$values = array();
	foreach($oauth as $key=>$value)
		$values[] = "$key=\"" . rawurlencode($value) . "\"";
	$r .= implode(', ', $values);
	return $r;
}

$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";


$oauth_access_token = "341994431-uv5WqvIoXg3HNFnEMDBQ74hRiuIvsZhail9LRpMN";
$oauth_access_token_secret = "28ACRUIwv8vAfaFo9IzATQR4mjMtNN9GMkJwC9y9eBOCv";

$consumer_key = "NHxUkCguCxiLpm0SQDzS6zYEJ";
$consumer_secret = "pqtXt8IaxTbjt0NGWwMcuF81cWc5UNcL2jw9QEZGlXsmi0dp1V";


$oauth = array( 'exclude_replies' => 'true',
				'include_rts' => 'false',
				'oauth_consumer_key' => $consumer_key,
				'oauth_nonce' => time(),
				'oauth_signature_method' => 'HMAC-SHA1',
				'oauth_token' => $oauth_access_token,
				'oauth_timestamp' => time(),
				'oauth_version' => '1.0');
$base_info = buildBaseString($url, 'GET', $oauth);
$composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
$oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
$oauth['oauth_signature'] = $oauth_signature;
// Make Requests
$header = array(buildAuthorizationHeader($oauth), 'Expect:');
$options = array( CURLOPT_HTTPHEADER => $header,
					//CURLOPT_POSTFIELDS => $postfields,
					CURLOPT_HEADER => false,
					CURLOPT_URL => $url . '?exclude_replies=true&include_rts=false',
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_SSL_VERIFYPEER => false);
$feed = curl_init();
curl_setopt_array($feed, $options);
$twitterStreamJson = curl_exec($feed);
curl_close($feed);
$twitterStream = json_decode($twitterStreamJson);
foreach($twitterStream as $twitter_item) {
	$social_media_posts[] = array(
		'type'    => 'twitter',
		'created' => strtotime($twitter_item->created_at),
		//'text'  => $twitter_item->text,
		'text'    => addTweetEntityLinks($twitter_item),
	);
}


function array_sort_by_column(&$array, $column, $direction = SORT_ASC) {
	$reference_array = array();
	foreach($array as $key => $row) {
		$reference_array[$key] = $row[$column];
	}
	array_multisort($reference_array, $direction, $array);
}
array_sort_by_column($social_media_posts, 'created');
$social_media_posts = array_reverse($social_media_posts);

$social_media_index = 0;
foreach($social_media_posts as $post) {
	$social_media_index++;
	if($social_media_index === 9) {
		break;
	}
	
	if ( $social_media_index % 4 == 1 ) {echo '<div class="row flex">';};

	if($post['type'] === 'twitter') {
		$social_media_content = sprintf(
			'%1$s',
			$post['text']
		);

		$info_content = sprintf(
			'<a target="_blank" href="%2$s" class="block-link social-media-info">'.
				'<i class="fa fa-twitter fa-lg"></i>'.
				'Twitter | '.
				'%1$s'.
			'</a>',
			date('d.m.Y',$post['created']),
			'https://twitter.com/MozillaPR_DE'
		);
		$url = sprintf(
			'https://twitter.com/MozillaPR_DE'
		);
	} else {
		$social_media_content = sprintf(
			'<a target="_blank" href="%2$s" class="block-link">'.
				'<img src="%1$s" />'.
			'</a>',
			$post['images']->url,
			$post['link']
		);

		$info_content = sprintf(
			'<a target="_blank" href="%2$s" class="block-link social-media-info">'.
				'<i class="sm-icon-instagram"></i>'.
			'</a>',
			date('d.m.Y',$post['created']),
			'https://www.instagram.com/fingerfood_berlin/'
		);
		$url = sprintf(
			'https://www.instagram.com/fingerfood_berlin/'
		);
	}

	printf(
		'<div class="social-box col-md-3 col-sm-12 col-xs-12">'.
			'<div class="grid-box grid-box-social-media social-media-%1$s">'.
				'<a target="_blank" href="%4$s" class="full-link"></a>'.
				'<div class="grid-helper"></div>'.
				'<div class="grid-content">'.
					'%2$s'.
					'%3$s'.
				'</div>'.
			'</div>'.
		'</div>',
		$post['type'],
		$info_content,
		$social_media_content,
		$url
	);
	
	if ( $social_media_index % 4 == 0 ) {echo '</div>';};
}