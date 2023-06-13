<?php

// example of config file in /config/telegram.example.php

$config = require(dirname(__DIR__, 2) . '/config/telegram.php');

$token = $config['TLG_TOKEN'];
$groupId = $config['TLG_GROUP'];

$text = "Hello world";
$message = urlencode($text);

$urlQuery = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $groupId . "&text=" . $message;

$result = file_get_contents($urlQuery);
