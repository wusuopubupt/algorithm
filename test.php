<?php
include('inc/common.inc.php');

$date = date('Y-m-d H:i:s');var_dump($date);exit;
$url = "http://crowdin.net/project_actions/activity_stream?project_id=5375&language_id=0&date_to=$date";
$data = http_get($url);
$getJson = json_decode($data, true);
$activity = $getJson['activity'];
//var_dump($getJson);
$messages = array();

foreach ($activity as $key => $value) {
	
	//'message' => string '<a  href="/profile/aidisid">aidisid</a> suggested 2 translations to Polish' 
	$messages[] = $value['message'];
	
	$username_pattern =  '#href=\"/profile/(\w+)\"#';
	preg_match($username_pattern, $messages[$key],$username_match);
	$username = $username_match[1]; 
	
	$suggest_pattern = '#suggested (\d+)#';
	preg_match($suggest_pattern, $messages[$key],$suggest_match);
	$suggest[$username] += $suggest_match[1];
	
}

var_dump($suggest);

