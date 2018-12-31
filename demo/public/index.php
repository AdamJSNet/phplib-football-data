<?php
require_once('../../vendor/autoload.php');

$dotenv = new Dotenv\Dotenv(dirname(__DIR__));
$dotenv->load();
$api = new AdamJsNet\FootballData\Client(getenv('API_TOKEN'));

require_once('../markup.php');
