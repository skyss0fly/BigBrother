<?php

/**
 * Go to the "build" directory.
 * Run: php -dphar.readonly=0 build-phar.php
 */

$previousDirectory = dirname(__FILE__, 2);

$buildTo = $previousDirectory . "/BigBrother.phar";
if(file_exists($buildTo))
	unlink($buildTo);

$phar = new Phar($buildTo);
$phar->buildFromDirectory($previousDirectory);
$phar->setDefaultStub("plugin.yml", "/plugin.yml");
chmod($buildTo, 0770);

print("Created BigBrother.phar" . "\n");