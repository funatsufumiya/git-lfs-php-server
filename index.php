<?php

define('IN_GITLFS', true);
require_once 'config.inc.php';

$api = $_SERVER['SCRIPT_NAME'];
if(isset($_SERVER['HTTP_ACCEPT'])){
	header('Content-Type: '.$_SERVER['HTTP_ACCEPT']);
}

$server_url = $config['server_url'];

switch($api){
case '/locks/verify':
	include 'api/locks_verify.inc.php';
	break;
case '/objects/batch':
	include 'api/objects_batch.inc.php';
	break;
case '/upload':
	include 'api/upload.inc.php';
	break;
case '/download':
	include 'api/download.inc.php';
	break;
}
