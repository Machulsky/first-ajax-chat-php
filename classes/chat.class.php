<?php
date_default_timezone_set('Europe/Moscow');
class Chat {	

	private $db;
	function __construct($cfg)
	{
		 $this->db = $cfg['db'];
	}

	private function openDB($id){
		$host = $this->db[$id]['host'];
		$user = $this->db[$id]['user'];
		$pass = $this->db[$id]['pass'];
		$name = $this->db[$id]['name'];
		$mysqli = new mysqli($host, $user, $pass, $name);
		$mysqli->query("SET NAMES utf8");
		return $mysqli;
		if ($mysqli -> connect_errno)
      {
        printf("Verbindung fehlgeschlagen: %s\n", $mysqli->connect_error);
        exit();
      }
	}


	public function sendMessage($name, $text, $to){
		$mysqli = $this->openDB(1);
		$time = time();
		$mysqli->query("INSERT INTO chat (id, sender, message, message_to, time) VALUES ('0', '$name', '$text','$to','$time')") or die($mysqli->error);
		$mysqli->close();
		return 'Сообщение отправлено';
	}

	public function getMessages($user){
		$mysqli = $this->openDB(1);

		if($user != 'all'){
				$query = 'SELECT id,sender,message,time FROM chat WHERE sender ='.$user;
		}else{
			$query = 'SELECT id,sender,message,time FROM chat WHERE id > 0';
		}

		if($stmt = $mysqli->prepare($query)){
		$stmt->execute();
		$stmt->bind_result($id, $sender, $message, $time);

		while ($stmt->fetch()) {
			$date = date('d.m.Y/H:i:s', $time);
			printf("<div class='message'>[%s] %s написал(а) %s </div>\n", $date, $sender, $message);
		}

		}
		
	}

	public function getMessagesCount($user){
		$mysqli = $this->openDB(1);

		if($user != 'all'){
				$query = 'SELECT id FROM chat WHERE sender ='.$user;
		}else{
			$query = 'SELECT id FROM chat WHERE id > 0';
		}

		$result = $mysqli->query($query);
		echo '<script>messages_count = '.$result->num_rows.';</script>';
		
	}

}