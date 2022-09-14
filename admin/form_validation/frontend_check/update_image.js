function check_update_image(){
	if(document.getElementById("input_image").value === ''){
		return true;
	} else {
		const input = document.getElementById("input_image").value.split("\\");
		let file_name = input[input.length-1];
		let type = 'file_update_image';
		return check_image(file_name, 'image_error', type);
	}
}