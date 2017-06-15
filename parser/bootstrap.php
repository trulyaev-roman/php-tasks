<?php
spl_autoload_register (function ($class) {
	$class = substr($class, strlen('Project'));
	$autoload = __DIR__ . str_replace ('\\', DIRECTORY_SEPARATOR, "$class.php");
	/** @define "$autoload" "/var/www/mysite/curl/files" */
	include_once $autoload;
});