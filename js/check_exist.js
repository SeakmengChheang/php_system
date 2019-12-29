function check_course_name() {
	let course_name = document.getElementById('course_name');
	const data = new FormData();

	data.append('course_name', course_name.nodeValue);

	const xhr = new XMLHttpRequest();
	xhr.open("POST", '../php/course/add_handler.php', true);
	xhr.send(data);
	//TODO Make this happened
}