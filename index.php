<?php

function _str_ends_with($haystack, $needle)
{
	return substr($haystack, -strlen($needle)) === $needle;
}

function _str_before($haystack, $needle)
{
	$pos = strpos($haystack, $needle);
	if($pos === false)
	{
		return $haystack;
	}
	return substr($haystack, 0, $pos);
}

function _slash_process($str)
{
	# - first / will be removed
	# - make sure last / will be added

	$str = ltrim($str, '/');
	$str = rtrim($str, '/');
	$str = $str.'/';
}

function include_with_variables($filePath, $variables = array(), $print = true)
{
    // Extract the variables to a local namespace
    extract($variables);

    // Start output buffering
    ob_start();

    // Include the template file
    include $filePath;

    // End buffering and return its contents
    $output = ob_get_clean();
    if (!$print) {
        return $output;
    }
    echo $output;
}


define('IN_GITLFS', true);
require_once 'config.inc.php';

$api = $_SERVER['REQUEST_URI'];
if(isset($_SERVER['HTTP_ACCEPT'])){
	header('Content-Type: '.$_SERVER['HTTP_ACCEPT']);
}

$server_url = $config['server_url'];

// treat before api as dir
$dir = '';

if (_str_ends_with($api, '/locks/verify'))
{
	$dir = _str_before($api, '/locks/verify');
	$dir = _slash_process($dir);
	// include 'api/locks_verify.inc.php';
	include_with_variables('api/locks_verify.inc.php', array('dir' => $dir, 'server_url' => $server_url));
}
elseif (_str_ends_with($api, '/objects/batch'))
{
	$dir = _str_before($api, '/objects/batch');
	$dir = _slash_process($dir);
	// include 'api/objects_batch.inc.php';
	include_with_variables('api/objects_batch.inc.php', array('dir' => $dir, 'server_url' => $server_url));
}
elseif (_str_ends_with($api, '/upload'))
{
	$dir = _str_before($api, '/upload');
	$dir = _slash_process($dir);
	// include 'api/upload.inc.php';
	include_with_variables('api/upload.inc.php', array('dir' => $dir, 'server_url' => $server_url));
}
elseif (_str_ends_with($api, '/download'))
{
	$dir = _str_before($api, '/download');
	$dir = _slash_process($dir);
	// include 'api/download.inc.php';
	include_with_variables('api/download.inc.php', array('dir' => $dir, 'server_url' => $server_url));
}