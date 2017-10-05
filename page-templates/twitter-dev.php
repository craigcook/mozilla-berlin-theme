<?php
/**
 * Template Name: Twitter Dev
 *
 * @package mozilla_berlin
 */

//ini_set('display_errors', 1);
include(dirname(__FILE__). '/../assets/functions/socialmedia/TwitterAPIExchange.php');
//include(dirname(__FILE__). '/../functions/socialmedia/addTweetEntityLinks.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "908298685578084353-D5akMU4PHgffWCMroLrvQECTt3Cidir",
    'oauth_access_token_secret' => "MZuHa843HZBU9vSyT5oXRGbouyHjzDyDgJW919lMHW4JG",
    'consumer_key' => "mHUANJcj7RixbRT8Md4SoBXk9",
    'consumer_secret' => "oe41IG6QDQ9kQawIS7fFL6EIRSHHHKXnkF8g6yH0AygFciZHyS"
);

///** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
//$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
//$requestMethod = 'POST';
//
///** POST fields required by the URL above. See relevant docs as above **/
//$postfields = array(
//    'screen_name' => 'MozillaBerlin', 
//    'skip_status' => '1'
//);
//
///** Perform a POST request and echo the response **/
//$twitter = new TwitterAPIExchange($settings);
//echo $twitter->buildOauth($url, $requestMethod)
//             ->setPostfields($postfields)
//             ->performRequest();

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
	$social_media_posts[] = array(
		'type'    => 'twitter',
		'created' => strtotime($twitter_item->created_at),
//		'text'    => addTweetEntityLinks($twitter_item),
//		'text'    => $twitter_item->text,
		'user'    => $twitter_item->user->screen_name,
		'id'      => $twitter_item->id,
	);
}


//print_r($twitter);
$twitterStream = json_decode($twitter);
print_r ($twitter);
