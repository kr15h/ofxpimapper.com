<?php

define('CACHE_FILE', 'events.json');
define('TIME_FILE', 'TIME');
define('TOKEN_FILE', 'TOKEN');

$cache_seconds = 3600;
$return_cached = false;

if(file_exists(TIME_FILE)){
	$file = fopen(TIME_FILE, 'r') or die('file error');
	$timestamp_then = (int)trim(fread($file, 50));
	fclose($file);
	$timestamp_now = time();
	$delta_seconds = $timestamp_now - $timestamp_then;
	if($delta_seconds < $cache_seconds){
		$return_cached = true;
	}
}

if($return_cached){
	if(!file_exists(CACHE_FILE)){
		$return_cached = false;
	}
}

if($return_cached){
	header('Location: '.CACHE_FILE);
	die();
}

$token = file_get_contents(TOKEN_FILE);
if($token){
	$token = trim($token);
}else{
	die('token error');
}

$url = 'https://www.eventbriteapi.com/v3/events/search/?token='.$token.'&user.id=186336128901&sort_by=date';
$data = file_get_contents($url);

if($data){
	$json = json_decode($data, true);

	if($json != NULL){
		$events = array();

		for($i = 0; $i < count($json['events']); $i++){
			$events[$i] = array();
			$events[$i]["name"] = $json['events'][$i]["name"]["text"];
			$events[$i]["start"] = $json['events'][$i]["start"]["local"];
			$events[$i]["end"] = $json['events'][$i]["end"]["local"];
			$events[$i]["url"] = $json['events'][$i]["url"];
			$venue_id = $json['events'][$i]['venue_id'];
			$venue_url = "https://www.eventbriteapi.com/v3/venues/".$venue_id."/?token=".$token;
			$venue_data = file_get_contents($venue_url);
			
			if($venue_data){
				$venue_json = json_decode($venue_data, true);
				
				if($venue_json != NULL){
					$events[$i]["venue"] = $venue_json["name"];
				}	
			}
		}

		$timestamp_now = time();
		$file = fopen(TIME_FILE, 'w') or die('file error');
		fwrite($file, $timestamp_now);
		fclose($file);

		$file = fopen(CACHE_FILE, 'w') or die('cache error');
		fwrite($file, json_encode($events));
		fclose($file);

		header('Content-Type: application/json');
		echo json_encode($events);
	}else{
		die('json error');
	}
}else{
	die('data error');
}

?>
