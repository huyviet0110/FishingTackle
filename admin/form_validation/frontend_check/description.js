function check_description(){
	let input = document.getElementById('input_description').value.trim();
	let regex = /^(?:(?:.{1,20})(?: .{1,20})?|[\n])*$/;
	return check_error(input, regex, 'description_error', 'Description', 5000);
}