<?php

error_reporting(0);
ini_set('display_errors', '0');

// Timezone
date_default_timezone_set('Europe/Berlin');

$settings = [];

$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';
$settings['template'] = $settings['root'] . '/templates';

// Error handler
$settings['error'] = [
	// Should be set to false in production
	'display_error_details' => true,
	// Should be set to false for unit tests
	'log_errors' => false,
	// Display error details in error log
	'log_error_details' => false,
];

$settings['db'] = [
	'driver' => '',
	'host' => 'localhost',
];

return $settings;
