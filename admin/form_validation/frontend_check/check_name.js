function check_name() {
	let input_name = document.getElementById('input_name').value;
	let regex = "/^(?:[ ]?(?:\w{1,20}))+$/";

	if(!regex.test(input_name)){
		document.getElementById('name_error').innerHTML = 'test';
		document.getElementById('name_error').style.color = 'red';
		return false;
	}

	document.getElementById('name_error').innerHTML = '';
	document.getElementById('name_error').style.color = 'black';
	return true;
}