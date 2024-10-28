<?php

if(!defined('IN_GITLFS')) {
	header('HTTP/1.1 403 Forbidden');
	exit('access denied');
}

$config = array(
	'server_url' => 'https://git-lfs.example.com',
);
