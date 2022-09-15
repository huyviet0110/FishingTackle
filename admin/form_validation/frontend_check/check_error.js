function check_error(input, regex, error_id, input_name, number_characters_limit) {
	
	if(input.trim().length === 0){
		document.getElementById(error_id).innerHTML = input_name + ' cannot be empty!';
		document.getElementById(error_id).style.color = 'red';
		return false;
	} else if(input.trim().length > number_characters_limit){
		document.getElementById(error_id).innerHTML = input_name + ' cannot exceed ' + number_characters_limit + ' characters!';
		document.getElementById(error_id).style.color = 'red';
		return false;
	} else if(!regex.test(input.trim())){
		document.getElementById(error_id).innerHTML = 'Wrong ' + input_name + ' format!';
		document.getElementById(error_id).style.color = 'red';
		return false;
	} else {
		document.getElementById(error_id).innerHTML = '';
		document.getElementById(error_id).style.color = 'black';
		return true;
	}
}