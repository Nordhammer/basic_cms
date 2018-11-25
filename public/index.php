<?php
session_start();
date_default_timezone_set('Europe/Berlin');
include_once '../config/global.php';
DB::connect($_CONF['db']['host'],$_CONF['db']['user'],$_CONF['db']['pw'],$_CONF['db']['name']);
if (getConfig('WARTUNG') == 1) {
	$err = true;
	if (isAdmin() == true) {
		$err = false;
	}
} else {
	$err = false;
}
if ($err === false) {
	$web = 'web';
	if (!isset($_SERVER['PATH_INFO']) || empty($_SERVER['PATH_INFO']) || $_SERVER['PATH_INFO'] == '/') {
		$content = ($_CONF['tpl']['start']);
	} else {
		$route = mb_substr($_SERVER['PATH_INFO'],1);
		$params = explode('/',$route);



		if (isset($_CONF['tpl'][$params[0]]) ) {
			$content = ($_CONF['tpl'][$params[0]]);
		} else {
			$content = ($_CONF['tpl']['error404']);
		}


		/*

		else if ($_CONF['acp'][$params[0]]) {
			$web = 'admin';
			$content = ($_CONF['acp'][$params[0]]);
		} else if ($_CONF['mcp'][$params[0]]) {
			$web = 'mod';
			$content = ($_CONF['mcp'][$params[0]]);
		}

		*/




	}
} else if ($err === true) {
	$web = 'wartung';
	$content = ($_CONF['tpl']['wartung']);
}
\ob_start('ob_gzhandler');
include_once RESOURCE_PATH.'layout/'.$web.'/header.php';
include_once $content;
include_once RESOURCE_PATH.'layout/'.$web.'/footer.php';
$page = ob_get_contents();
ob_end_clean();
echo $page;