<?php

$token = file_get_contents("./TOKEN");
$url = "https://www.eventbriteapi.com/v3/events/search/?token=".$token."&user.id=186336128901&sort_by=date";
$data = file_get_contents($url);

if($data){
	header('Content-Type: application/json');
	print_r($data);
}else{
	echo 'error';
}

?>
