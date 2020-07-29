
function post(handler, form, result_id, files){
	//event.preventDefault();

	var formData = new FormData(form);

if(files == true){
	formData.append( "file", $("input[type=file]")[0].files[0]);
}

	$.ajax({
		processData: false,
		contentType: false,
		type: "POST",
		url: handler,
		data:  formData,
	success: function(data) {
		$('#'+result_id).html(data);
		get('ajax/messagebox.php?items=true', 'messagebox');
		console.log('callback');
		},
	error:  function(xhr, str){
		alert("Возникла ошибка: " + xhr.responseCode);
		}
});
}

function get(handler, result_id){
	$.ajax({
		url: handler,
	success: function(data) {
		$('#'+result_id).html(data);
		},
	error:  function(xhr, str){
		alert("Возникла ошибка: " + xhr.responseCode);
		}
});
}

