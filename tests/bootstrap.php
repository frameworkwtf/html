<?php

declare(strict_types=1);
session_start();
// Enable Composer autoloader
/** @var \Composer\Autoload\ClassLoader $autoloader */
$autoloader = require __DIR__.'/../vendor/autoload.php';

// Register test classes
$autoloader->addPsr4('Wtf\\Html\\Tests\\', __DIR__);
