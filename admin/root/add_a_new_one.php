<script>

	function add_a_new_one(element, label, name, button_width) {

			let height = 170;
			let height_needs_to_be_reduced = 90;
			const count_element = document.getElementsByClassName(element);
			const count_input = document.getElementsByClassName('count-input');
			const count_sub_image = document.getElementsByClassName('count-sub-image');

			if(count_element.length > 4){
				return false;
			}
			for(let i = 0; i < count_element.length; i++){
				count_element[i].innerHTML = '';
				count_element[i].style.height = 0;
			
			}

			if(name !== 'sub_image'){
				document.getElementById(`new_` + name).innerHTML += `

					<div class="form-input">
						<p>` + label + ` ` + (count_element.length + 1) + `</p>
						<p style="font-weight: normal;">Name</p>
						<input type="text" name="` + name + `[` + count_element.length + `]">
						<div class="` + name + `_error"></div>
					</div>

					<div class="form-input count-input">
						<p style="font-weight: normal; padding-top: 10px;">Image File</p>
						<input type="file" name="` + name + `_image[` + count_element.length + `]">
						<div class="` + name + `_image_error"></div>
					</div>

				`;
			} else {
				document.getElementById(`new_` + name).innerHTML += `

					<div class="form-input count-input count-sub-image">
						<p style="font-weight: normal; padding-top: 10px;">Image File</p>
						<input type="file" name="` + name + `[` + count_element.length + `]">
						<div class="` + name + `_error"></div>
					</div>

				`;
			}

			

			if(count_element.length < 4){
				document.getElementById(`new_` + name).innerHTML += `

					<div class="card-insert card_insert_` + name + `" style="margin: 0; padding-top: 10px">
						<button type="button" style="width: ` + button_width + `px" onclick="add_a_new_` + name + `()">
							<i class="fa-solid fa-plus"></i>
							<p>Add a new ` + name + `</p>
						</button>
					</div>

				`;
			}

			if(count_input.length > 4){
				document.getElementById('layout').style.height = "calc(2000px + "
						 + (height * (count_input.length - 4)) 
						 + "px - "
						 + (height_needs_to_be_reduced * (count_sub_image.length - 1))
						 + "px)";
			}

			return true;

		}

</script>