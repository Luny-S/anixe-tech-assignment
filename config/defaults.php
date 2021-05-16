<?php

use Cake\Database\Driver\Postgres as PostgresDriver;

error_reporting(0);
ini_set('display_errors', '0');

// Timezone
date_default_timezone_set('Europe/Berlin');

$settings = [];

$settings['root'] = dirname(__DIR__);
$settings['public'] = $settings['root'] . '/public';


$settings['db'] = [
	'driver' => PostgresDriver::class,
	'host' => 'localhost',
	'database' => 'task-db'
];

return $settings;
