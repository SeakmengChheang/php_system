function check_if_no_error() {
	let ps = document.getElementsByClassName('error');
	for (p of ps) {
		if (p.textContent != '') {
			alert("Please resolve the errors first before submit!");
			return false;
		}
	}
	return true;
}

function check_exist(field, course_id) {
	let value = document.getElementById(field).value;
	const data = new FormData();

	data.append('value', value);
	data.append('field', field);
	data.append('course_id', course_id);

	const xhr = new XMLHttpRequest();
	xhr.open("POST", 'check_exist.php', true);
	xhr.send(data);

	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			console.log(this.responseText);
			if (this.responseText) {
				arr = field.split('_');
				arr[0] = arr[0][0].toUpperCase() + arr[0].slice(1);
				arr[1] = arr[1][0].toUpperCase() + arr[1].slice(1);
				document.getElementById('e_' + field).textContent = arr[0] + ' ' + arr[1] + " is already exists, try new one.";
			}
			else
				document.getElementById(field).textContent = '';
		}
	};
}

function validate_academic() {
	let y1 = Number.parseInt(document.getElementById('academic_y1').value);
	let y2 = Number.parseInt(document.getElementById('academic_y2').value);
	let acad = document.getElementById('e_academic');
	if (y1 + 1 != y2)
		acad.textContent = 'The start year should be smaller than the next year by only 1 year';
	else
		acad.textContent = '';
}

function validate_semester() {
	let semester = document.getElementById('semester').value;
	let sem = document.getElementById('e_semester');
	if (semester > 8 || semester < 1) {
		sem.textContent = 'Semester should be in range 1 to 8';
		return;
	}

	sem.textContent = '';
}

function validate_course_name(course_id) {
	let course_name = document.getElementById('course_name').value;
	let c_name = document.getElementById('e_course_name');
	if (
		course_name == ''
		|| course_name.length > 255
	) {
		c_name.textContent = 'Course Name should be shorter or equal 255 characters';
		return;
	}
	else {
		//There exists that course_code in db
		//Which is not it self
		if (check_exist('course_name', course_id)) {
			c_name.textContent = "Course Name is already exists, try new one.";
			return;
		} else {
			c_name.textContent = '';

		}
	}

}

function validate_course_code(course_id) {
	let course_code = document.getElementById('course_code').value;
	let c_code = document.getElementById('e_course_code');
	if (
		course_code == ''
		|| course_code.length > 20
	) {
		c_code.textContent = 'Course Code should be shorter or equal 20 characters';
		return;
	}
	else {
		//There exists that course_code in db
		//Which is not it self
		if (check_exist('course_code', course_id)) {
			c_code.textContent = "Course Code is already exists, try new one.";
			return;
		}
	}

	c_code.textContent = '';
}

function validate_cg_id() {
	let cg_id = document.getElementById('cg_id').value;
	let cg = document.getElementById('e_cg_id');
	if (cg_id > 4 || cg_id < 1)
		cg.textContent =  'Course Group ID should be in range 1 to 4';
	else
		cg.textContent=  '';
}

function validate_course_desc() {
	let course_desc = document.getElementById('course_desc').value;
	let c_desc = document.getElementById('e_course_desc');
	if (empty(course_desc) || strlen(course_desc) > 65535)
		c_desc.textContent = 'Course Code should be shorter or equal to 65,535 characters';
	else
		c_desc.textContent = '';
}