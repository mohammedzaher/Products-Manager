<?php

define('ROOT', str_replace("public/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

require '../vendor/autoload.php';

$router = require '../app/Routes/web.php';
