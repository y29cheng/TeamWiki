function clock() {
	setTimeout("clock()", 1000);
	now = new Date();
	current_time = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
	return current_time;
}
