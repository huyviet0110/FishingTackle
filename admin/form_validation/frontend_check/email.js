function check_email() {
	let input = document.getElementById('input_email').value;

	if(input.trim().length === 0){
		document.getElementById('email_error').innerHTML = 'Email cannot be empty!';
		document.getElementById('email_error').style.color = 'red';
		return false;
	} else if(input.trim().length > 100){
		document.getElementById('email_error').innerHTML = 'Email cannot exceed 100 characters!';
		document.getElementById('email_error').style.color = 'red';
		return false;
	} else {
		document.getElementById('email_error').innerHTML = '';
		document.getElementById('email_error').style.color = 'black';
		return true;
	}
}