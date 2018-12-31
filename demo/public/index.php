<?php
require_once('../../vendor/autoload.php');

$dotenv = new Dotenv\Dotenv(dirname(__DIR__));
$dotenv->load();
$api = new Dfrt82\FootballData\Client(getenv('API_TOKEN'));

require_once('../markup.php');
