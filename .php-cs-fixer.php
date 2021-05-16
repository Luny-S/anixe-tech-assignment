<?php

use PhpCsFixer\Finder;
use PhpCsFixer\Config;

$finder = Finder::create()
	->exclude('vendor')
	->in(__DIR__);

$config = new Config();

return $config->setRules([
	'@PSR12' => true,
])->setFinder($finder);