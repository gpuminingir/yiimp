<?php

if(isset($_REQUEST["action"])) $action=$_REQUEST["action"]; else $action=false;


if($action=="dump"){
	var_dump(get_snomp_api_poolStatus());
}
	
function get_snomp_api_poolStatus($coinname){
	$url = 'http://localhost:8800/api/stats';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch);$coinname
	$data = json_decode($data,true);
	$api["poolhashrate"] = $data["pools"][$coinname]["hashrate"]/500000;
	$api["nethashrate"] = $data["pools"][$coinname]["poolStats"]["networkSols"];
	$api["shares"] = $data["pools"][$coinname]["shareCount"];
	$api["totalblocks"] = $data["pools"][$coinname]["blocks"]["confirmed"];
	$api["lastblock"] = $data["pools"][$coinname]["blocks"]["lastblock"];
	$api["timesincelast"] = $data["pools"][$coinname]["blocks"]["timesincelast"];
	$api["workers"] =  $data["pools"][$coinname]["workerCount"];
	$api["fees"] =  $data["pools"][$coinname]["poolFees"][""];
	return $api;
}

function get_snomp_api_wallet($wallet){
	$url = 'http://localhost:8800/api/worker_stats?'.$wallet;
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch);
	$data = json_decode($data,true);
	$api["total"] = $data["paid"];
	$api["unpaid"] = $data["balance"];
	
	return $api;
}
	
?>
