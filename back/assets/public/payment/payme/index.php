<?php
// Enable to debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'vendor/autoload.php';
require_once 'functions.php';

use Paycom\Application;

const CONFIG_FILE = 'paycom.config.php';
$data = $_POST;
file_put_contents("post_m.txt", json_encode($_REQUEST).PHP_EOL);
// load configuration
$paycomConfig = require_once CONFIG_FILE;

$application = new Application($paycomConfig);
$application->run();
