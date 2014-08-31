<?php
chdir(dirname(__DIR__));

include 'vendor/Zend/Loader/AutoloaderFactory.php';

Zend\Loader\AutoloaderFactory::factory(array(
	'Zend\Loader\StandardAutoloader' => array(
		'autoregister_zf' => true
	)
));

Zend\Mvc\Application::init(require 'config/application.php')->run();
