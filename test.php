<?php

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

use TikTok\Scanner\Client;

$client = new Client('172.50.1.100', 80);
$profile = 'itsjojosiwa';

var_dump($client->requestProfileInfo($profile));

$offset = 0;
do {
	$response = $client->requestPosts($profile, $offset);
	if (is_array($response)) {
		var_dump($response);
	}
	if (is_array($response) && ! empty($response['hasNextPage'])) {
		$offset = $response['nextPageOffset'];
	}
} while ($response && ! empty($response['hasNextPage']));