function check_description(){
	let input = document.getElementById('input_description').value;
	let regex = /^.{1,500}$/;
	return check_error(input, regex, 'description_error', 'Description', 500);
}