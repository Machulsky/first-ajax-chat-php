<?php
define ( 'ROOT_DIR', dirname ( __FILE__ ) );
define ( 'ENGINE_DIR', ROOT_DIR . '/engine' );
define ('CONFIG_FILE', ROOT_DIR . '/data/config.php');
require CONFIG_FILE;
require 'classes/chat.class.php';
if(isset($_POST['message'])){
$ajax = new Chat($cfg);
echo $ajax->sendMessage($_POST['name'], $_POST['message'], 'admin');
}
