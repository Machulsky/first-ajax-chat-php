<script src="js/jquery.min.js"></script>
<script src="js/chat.js"></script>
<title id="title">Чат</title>
<body>
	
</body>
<div id="scripts"></div>
	<div id="messagebox"></div>

<form action="javascript:void(null);" id="1" onSubmit="post('handler.php', this, 'result', false)">
	<input type="text" name="name" placeholder="name">
	<input type="text" name="message" placeholder="text">
	<button>Submit</button>
</form>
<div id="result"></div>

<script type="text/javascript">
	var default_title = document.getElementById("title").innerHTML;
	var messages_count;
	var new_count=0;
	var notify_sound = new Audio('assets/sounds/notify.ogg');
$('<audio id="notify"><source src="assets/sounds/notify.ogg" type="audio/ogg"></audio>').appendTo('body');
function num2str(n, text_forms) {  
        n = Math.abs(n) % 100; var n1 = n % 10;
        if (n > 10 && n < 20) { return text_forms[2]; }
        if (n1 > 1 && n1 < 5) { return text_forms[1]; }
        if (n1 == 1) { return text_forms[0]; }
        return text_forms[2];
    }

	function reloadMessages(messages_count){
		get('ajax/messagebox.php?count=true', 'scripts');
		if(messages_count!= 0 && getLength()!=0 && messages_count>getLength()){
			$('#notify')[0].play();

			if (document.hidden) {
			new_count = new_count+1;
  			var text = num2str(new_count, ['Новое сообщение', 'Новых сообщения', 'Новых сообщений']);
			document.title = "+"+new_count+" "+text;
			}
			//console.log('NewMessage');
			get('ajax/messagebox.php?items=true', 'messagebox');
		}



		if(messages_count != 0 && messages_count!=undefined && getLength()==0){
			$('#notify')[0].play();

			if (document.hidden) {
			new_count = new_count+1;
  			var text = num2str(new_count, ['Новое сообщение', 'Новых сообщения', 'Новых сообщений']);
			document.title = "+"+new_count+" "+text;
			}
			//console.log('NewMessage');
			get('ajax/messagebox.php?items=true', 'messagebox');
		}

		if(getLength() > messages_count){
			//console.log('DelMessage');
			get('ajax/messagebox.php?items=true', 'messagebox');
		}


		
	}
		$(window).focus(function() {
document.title = default_title;
//console.log(default_title);
new_count=0;
});


	get('ajax/messagebox.php?items=true', 'messagebox');

	setInterval('reloadMessages(messages_count)', 1000);

	function getLength(){
		return $('.message').length;
	}

</script>

<?php
