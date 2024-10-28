<?php

if(!defined('IN_GITLFS')) exit('access denied');

if (!array_key_exists('oid', $_GET) || empty($_GET['oid'])) {
	header('HTTP/1.1 404 Not Found');
	exit;
}

$path = 'data'.$dir.'objects/'.$_GET['oid'];
# create directory if it doesn't exist
if(!file_exists('data'.$dir.'objects')){
	mkdir('data'.$dir.'objects', 0777, true);
}
if(!file_exists($path)){
	file_put_contents($path, file_get_contents('php://input'));
}

echo "dir = $dir\n";
echo "path = $path\n";