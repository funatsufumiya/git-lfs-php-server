<?php

if(!defined('IN_GITLFS')){
	header('HTTP/1.1 403 Forbidden');
	exit('access denied');
}

$input = file_get_contents('php://input');
if($input){
	$input = json_decode($input, true);
}else{
	$input = array();
}

if($input['operation'] == 'upload'){
	$objects = $input['objects'];
	foreach($objects as &$o){
		$o['authenticated'] = false;
		if(!file_exists('data/'.$dir.'objects/'.$o['oid'])){
			$o['actions']['upload'] = array(
				'href' => $server_url.'/'.$dir.'upload?'.http_build_query(array('oid' => $o['oid'])),
				'expires_in' => 24 * 3600,
			);
		}
	}
	unset($o);

	$response = array(
		'transfer' => 'basic',
		'objects' => $objects,
	);
	echo json_encode($response);

}elseif($input['operation'] == 'download'){
	$objects = $input['objects'];
	foreach($objects as &$o){
		$o['authenticated'] = false;
		if(file_exists('data/'.$dir.'objects/'.$o['oid'])){
			$o['actions']['download'] = array(
				'href' => $server_url.'/'.$dir.'download?'.http_build_query(array('oid' => $o['oid'])),
				'expires_in' => 24 * 3600,
			);
		}
	}
	unset($o);

	$response = array(
		'transfer' => 'basic',
		'objects' => $objects,
	);
	echo json_encode($response);
}
