<?php

if(isset($_REQUEST["action"])) $action=$_REQUEST["action"]; else $action=false;


if($action=="dump"){
	var_dump(get_snomp_api_poolStatus($coin));
}
	
function get_snomp_api_poolStatus($coin){
	$url = 'http://localhost:8800/api/stats';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch);
	$data = json_decode($data,true);
	$api["poolhashrate"] = $data["pools"][$coin]["hashrate"]/500000;
	$api["nethashrate"] = $data["pools"][$coin]["poolStats"]["networkSols"];
	$api["shares"] = $data["pools"][$coin]["shareCount"];
	$api["totalblocks"] = $data["pools"][$coin]["blocks"]["confirmed"];
	$api["lastblock"] = $data["pools"][$coin]["blocks"]["lastblock"];
	$api["timesincelast"] = $data["pools"][$coin]["blocks"]["timesincelast"];
	$api["workers"] =  $data["pools"][$coin]["workerCount"];
	$api["fees"] =  $data["pools"][$coin]["poolFees"][""];
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
