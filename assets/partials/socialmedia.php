<?php
//ini_set('display_errors', 1);
include(dirname(__FILE__). '/../functions/socialmedia/TwitterAPIExchange.php');
//include(dirname(__FILE__). '/../functions/socialmedia/addTweetEntityLinks.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "908298685578084353-D5akMU4PHgffWCMroLrvQECTt3Cidir",
    'oauth_access_token_secret' => "MZuHa843HZBU9vSyT5oXRGbouyHjzDyDgJW919lMHW4JG",
    'consumer_key' => "mHUANJcj7RixbRT8Md4SoBXk9",
    'consumer_secret' => "oe41IG6QDQ9kQawIS7fFL6EIRSHHHKXnkF8g6yH0AygFciZHyS"
);

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name=MozillaBerlin&tweet_mode=extended';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$twitter =  $twitter->setGetfield($getfield)
            		->buildOauth($url, $requestMethod)
            		->performRequest();

//print_r($twitter);
$twitterStream = json_decode($twitter);
foreach($twitterStream as $twitter_item) {
	
	if( isset( $twitter_item->entities->media[0]->media_url ) ){
		$social_media_posts[] = array(
			'type'    => 'twitter',
			'created' => strtotime($twitter_item->created_at),
			'text'    => $twitter_item->full_text,
			'user'    => $twitter_item->user->screen_name,
			'id'      => $twitter_item->id,
			
			'image_url'   => $twitter_item->entities->media[0]->media_url,
			'width'       => $twitter_item->entities->media[0]->sizes->small->w,
			'height'      => $twitter_item->entities->media[0]->sizes->small->h,
		);
	} else {
		$social_media_posts[] = array(
			'type'    => 'twitter',
			'created' => strtotime($twitter_item->created_at),
			'text'    => $twitter_item->full_text,
			'user'    => $twitter_item->user->screen_name,
			'id'      => $twitter_item->id,
		);
	};
	
}

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name=MozillaPR_DE&tweet_mode=extended';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$twitter =  $twitter->setGetfield($getfield)
            		->buildOauth($url, $requestMethod)
            		->performRequest();

//print_r($twitter);
$twitterStream = json_decode($twitter);

foreach($twitterStream as $twitter_item) {
	
	if( isset( $twitter_item->entities->media[0]->media_url ) ){
		$social_media_posts[] = array(
			'type'    => 'twitter',
			'created' => strtotime($twitter_item->created_at),
			'text'    => $twitter_item->full_text,
			'user'    => $twitter_item->user->screen_name,
			'id'      => $twitter_item->id,
			
			'image_url'   => $twitter_item->entities->media[0]->media_url,
			'width'       => $twitter_item->entities->media[0]->sizes->small->w,
			'height'      => $twitter_item->entities->media[0]->sizes->small->h,
		);
	} else {
		$social_media_posts[] = array(
			'type'    => 'twitter',
			'created' => strtotime($twitter_item->created_at),
			'text'    => $twitter_item->full_text,
			'user'    => $twitter_item->user->screen_name,
			'id'      => $twitter_item->id,
		);
	};
	
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
	
	if ( $social_media_index % 4 == 1 ) {echo '<div class="row flex social-row">';};

	if($post['type'] === 'twitter') {
		if( isset($post['image_url']) ) {
			$social_media_content = sprintf(
				'<img class="twitter-image" src="%2$s" width="%3$s" height="%4$s" alt="Twitter Image">'.
				'%1$s',
				$post['text'],
				$post['image_url'],
				$post['width'],
				$post['height']
			);
		} else {
			$social_media_content = sprintf(
				'%1$s',
				$post['text']
			);
		}

		$info_content = sprintf(
			'<a target="_blank" href="https://twitter.com/%2$s/status/%3$s" class="block-link social-media-info">'.
				'<i class="fa fa-twitter fa-lg"></i>'.
				'Twitter | '.
				'%1$s'.
			'</a>',
			date('d.m.Y',$post['created']),
			$post['user'],
			$post['id']
		);
		$url = sprintf(
			'https://twitter.com/%1$s/status/%2$s',
			$post['user'],
			$post['id']
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
			''
		);
		$url = sprintf(
			''
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
