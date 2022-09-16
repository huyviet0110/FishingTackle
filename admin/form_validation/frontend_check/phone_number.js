function check_phone_number() {
	let input = document.getElementById('input_phone_number').value.trim();
	let regex = /^[+]?\d+$/;
	return check_error(input, regex, 'phone_number_error', 'Phone number', 20)
}