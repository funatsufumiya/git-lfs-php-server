<?php

if(!defined('IN_GITLFS')){
	header('HTTP/1.1 403 Forbidden');
	exit('access denied');
}

if (!array_key_exists('oid', $_GET) || empty($_GET['oid'])) {
	header('HTTP/1.1 404 Not Found');
	exit;
}

$path = 'data'.$dir.'objects/'.$_GET['oid'];
if(file_exists($path)){
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: '.filesize($path));
	readfile($path);
}else{
	header('HTTP/1.1 404 Not Found');
}
