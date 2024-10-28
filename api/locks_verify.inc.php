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

$ours = array();
$theirs = array();
$next_cursor = '';

$response = array(
	"ours" => $ours,
	"theirs" => $theirs,
	"next_cursor" => $next_cursor,
);

echo json_encode($response);
