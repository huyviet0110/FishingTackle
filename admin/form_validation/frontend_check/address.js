function check_address() {
	let input = document.getElementById('input_address').value;
	let regex = /^(?:[A-Za-z]{1,15}|\d{1,10})(?:[,]?(?: (?:[A-Za-z]{1,15}|\d{1,10}))+)*[.]?$/;
	return check_error(input, regex, 'address_error', 'Address', 200);
}