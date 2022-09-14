function check_image(file_name, error_id, type){
	const file_elements = file_name.split('.');
	let file_extension = file_elements[file_elements.length - 1];
	const file_extensions_allowed = ['png', 'jpg', 'jpec', 'gif'];

	if(file_name.trim().length === 0 && type === 'file_insert_image'){
		document.getElementById(error_id).innerHTML = 'The image file cannot be empty!';
		document.getElementById(error_id).style.color = 'red';
		alert('The image file cannot be empty!');
		return false;
	} else if(!file_extensions_allowed.includes(file_extension)){
		document.getElementById(error_id).innerHTML = 'The file extension is not in the allowed format!';
		document.getElementById(error_id).style.color = 'red';
		alert('The file extension is not in the allowed format!');
		return false;
	} else {
		document.getElementById(error_id).innerHTML = '';
		document.getElementById(error_id).style.color = 'black';
		return true;
	}
}


