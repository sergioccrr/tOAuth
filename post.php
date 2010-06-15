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

if(empty($_SESSION['toauth_at']) || empty($_SESSION['toauth_ats'])) {
	header('Location: index.php');
	die();
}

$connection = new tOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['toauth_at'], $_SESSION['toauth_ats']);

$r = $connection->post('statuses/update', array('status'=>'Hello World'));
if(isset($r['error'])) die('<b>Error:</b> '.$r['error']);
echo '<pre>'.print_r($r, true).'</pre>';
