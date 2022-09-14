function check_insert_image(){
	const input = document.getElementById("input_image").value.split("\\");
	let file_name = input[input.length-1];
	let type = 'file_insert_image';
	return check_image(file_name, 'image_error', type);
}


