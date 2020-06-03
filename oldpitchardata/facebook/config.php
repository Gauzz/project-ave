<?php 

	require_once 'Facebook/autoload.php';

	$FB= new \Facebook\Facebook([
		'app_id' => '967697310259672',
		'app_secret' => 'd2bcc0978baa465d47bf53ddee46ca35',
		'default_graph_version' => 'v2.10'
	]);

	$helper= $FB->getRedirectLoginHelper();


?>