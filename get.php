<?php

session_start();

require_once('tOAuth/tOAuth.class.php');
require('config.php');

if(empty($_SESSION['toauth_at']) || empty($_SESSION['toauth_ats'])) {
	header('Location: index.php');
	die();
}

$connection = new tOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['toauth_at'], $_SESSION['toauth_ats']);

$r = $connection->get('account/verify_credentials');
if(isset($r['error'])) die('<b>Error:</b> '.$r['error']);
echo '<pre>'.print_r($r, true).'</pre>';
