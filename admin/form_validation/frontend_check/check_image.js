function check_image(){
	const file_elements = document.getElementById("input_image").value.split("\\");
	let file_name = file_elements[file_elements.length-1];

	const file_name_elements = file_name.split('.');
	let file_extension = file_name_elements[file_name_elements.length - 1];

	const file_extensions_array = ['png', 'jpg', 'jpec', 'gif'];

	if(!file_extensions_array.includes(file_extension)){
		document.getElementById('image_error').innerHTML = 'The file extension is not in the allowed format!';
		document.getElementById('image_error').style.color = 'red';
		alert('The file extension is not in the allowed format!');
		return false;
	} else {
		return true;
	}

	document.getElementById('image_error').innerHTML = '';
	document.getElementById('image_error').style.color = 'black';

}


