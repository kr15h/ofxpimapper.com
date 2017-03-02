<?php

$token = file_get_contents("./TOKEN");
if($token){
	$token = trim($token);
}else{
	die("token error");
}

$url = "https://www.eventbriteapi.com/v3/events/search/?token=".$token."&user.id=186336128901&sort_by=date";
$data = file_get_contents($url);

if($data){
	$json = json_decode($data, true);

	if($json != NULL){
		$events = array();
		header('Content-Type: application/json');

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
		echo json_encode($events);
	}else{
		die('json error');
	}
}else{
	die('data error');
}

?>
