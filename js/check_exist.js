function check_exist(field, course_id) {
	console.log(course_id);
	let course_name = document.getElementById(field);
	const data = new FormData();

	data.append('value', course_name.value);
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
				document.getElementsByClassName(field)[0].textContent = arr[0] + ' ' + arr[1] + " is already exists, try new one.";
			}
			else
				document.getElementsByClassName(field)[0].textContent = '';
		}
	}
}