<script>

	function add_a_new_one(element, label, name, button_width, input_properties) {

			let height = 170;
			let height_needs_to_be_reduced = 90;
			const count_element = document.getElementsByClassName(element);
			const count_input_by_properties = document.getElementsByClassName(input_properties);
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

					<div class="form-input ` + input_properties + `">
						<p>` + label + ` ` + (count_input_by_properties.length + entry_index_label) + `</p>
						<p style="font-weight: normal;">Name</p>
						<input type="text" name="` + name + `[` + count_input_by_properties.length + `]">
						<div class="` + name + `_error"></div>
					</div>

					<div class="form-input count-input">
						<p style="font-weight: normal; padding-top: 10px;">Image File</p>
						<input type="file" name="` + name + `_image[` + count_input_by_properties.length + `]">
						<div class="` + name + `_image_error"></div>
					</div>

				`;
			} else {
				document.getElementById(`new_` + name).innerHTML += `

					<div class="form-input count-input count-sub-image ` + input_properties + `">
						<p style="font-weight: normal; padding-top: 10px;">Image File</p>
						<input type="file" name="` + name + `[` + count_input_by_properties.length + `]">
						<div class="` + name + `_error"></div>
					</div>

				`;
			}

			

			if(count_input_by_properties.length < 5){
				document.getElementById(`new_` + name).innerHTML += `

					<div class="card-insert card_insert_` + name + `" style="margin: 0; padding-top: 10px">
						<button type="button" style="width: ` + button_width + `px" onclick="add_a_new_` + name + `()">
							<i class="fa-solid fa-plus"></i>
							<p>Add a new ` + name + `</p>
						</button>
					</div>

				`;
			}

			document.getElementById('layout').style.height = "calc(" + layout_height + "px + "
					 + (height * (count_input.length - number_of_count_input)) 
					 + "px - "
					 + (height_needs_to_be_reduced * (count_sub_image.length - 1))
					 + "px)";

			return true;

		}

</script>