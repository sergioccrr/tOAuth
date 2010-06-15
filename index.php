<?php
/*
 * This file is part of tOAuth Class
 * Copyright (C) 2009-2010, Sergio Cruz aka scromega (scr.omega at gmail dot com)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

session_start();

require_once('tOAuth/tOAuth.class.php');
require('config.php');

# To test
//$_SESSION = array(); session_destroy(); die();

if(empty($_SESSION['toauth_at']) || empty($_SESSION['toauth_ats'])) {
	if(!empty($_GET['oauth_token']) && $_SESSION['toauth_state'] == 'start') {
		$connection = new tOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['toauth_rt'], $_SESSION['toauth_rts']);
		$a = $connection->authenticate(false);
		$_SESSION['toauth_at'] = $a['oauth_token'];
		$_SESSION['toauth_ats'] = $a['oauth_token_secret'];
		$_SESSION['toauth_state'] = 'returned';
	} else {
		$connection = new tOAuth(CONSUMER_KEY, CONSUMER_SECRET);
		$a = $connection->authenticate(true);
		$_SESSION['toauth_rt'] = $a['oauth_token'];
		$_SESSION['toauth_rts'] = $a['oauth_token_secret'];
		$_SESSION['toauth_state'] = 'start';
		echo "<a href=\"{$a['request_link']}\">Authentication</a>";
	}
}

if(!empty($_SESSION['toauth_at']) && !empty($_SESSION['toauth_ats'])) {
	echo "<h1>tOAuth Class</h1>";
	echo "<a href=\"get.php\">GET Example</a><br />\n";
	echo "<a href=\"post.php\">POST Example</a><br />\n";
}
