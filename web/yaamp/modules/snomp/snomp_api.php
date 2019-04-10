<?php

if(isset($_REQUEST["action"])) $action=$_REQUEST["action"]; else $action=false;


if($action=="dump"){
	vardump(get_snomp_api());
}
	
function get_snomp_api(){
	$url = 'http://localhost:8800/api/stats';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch);
	$data = json_decode($data,true);
	$api["hashrate"] = $data["pools"]["zelcash"]["hashrateString"];
	$api["totalblocks"] = $data["pools"]["zelcash"]["blocks"]["confirmed"];
	$api["workers"] =  $data["pools"]["zelcash"]["workerCount"];
	$api["fees"] =  $data["pools"]["zelcash"]["poolFees"];
	return $api;
}
	
?>
