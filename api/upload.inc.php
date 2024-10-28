<?php

if(!defined('IN_GITLFS')) exit('access denied');

if (!array_key_exists('oid', $_GET) || empty($_GET['oid'])) {
	header('HTTP/1.1 404 Not Found');
	exit;
}

$path = 'data/objects'.$dir.$_GET['oid'];
if(!file_exists($path)){
	file_put_contents($path, file_get_contents('php://input'));
}
