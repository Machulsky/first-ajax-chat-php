<?php
require '../data/config.php';
require '../classes/chat.class.php';
$ajax = new Chat($cfg);
if(isset($_GET['items']) && $_GET['items'] == true){
	$ajax->getMessages('all');
}

if (isset($_GET['count']) && $_GET['count'] == true) {
	$ajax->getMessagesCount('all');
}