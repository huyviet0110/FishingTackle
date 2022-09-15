function check_name() {
	let input = document.getElementById('input_name').value;
	let regex = /^(?:\w{1,15})(?: \w{1,15})*$/;
	return check_error(input, regex, 'name_error', 'Name', 100);
}