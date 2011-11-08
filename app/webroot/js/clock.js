function clock() {
	setTimeout("clock()", 1000);
	now = new Date();
	current_time = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
	document.write current_time;
}
