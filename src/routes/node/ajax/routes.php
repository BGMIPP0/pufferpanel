<?php
/*
	PufferPanel - A Minecraft Server Management Panel
	Copyright (c) 2013 Dane Everitt

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see http://www.gnu.org/licenses/.
*/
namespace PufferPanel\Core;
use \ORM;

$klein->respond('POST', '/node/ajax/console/power', function($request, $response, $service) use ($core) {

	if(!$core->user->hasPermission('console.power')) {

		$response->code(403);
		$response->body('You do not have permission to perform this action.')->send();
		return;

	}

	$generate = $core->gsd->generateServerProperties();
	if($generate !== true) {
		$response->body($generate)->send();
	} else {

		if(!$core->gsd->powerOn()) {
			$response->body("Unable to power on server due to a daemon error.")->send();
		} else {
			$response->body("ok")->send();
		}

	}

});

include('files/routes.php');