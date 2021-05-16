<?php

/**
 * Here was production/dev environment switch in slim skeleton application
 */

// Load default settings
$settings = require __DIR__ . '/defaults.php';

require __DIR__ . '/env.local.php';

return $settings;