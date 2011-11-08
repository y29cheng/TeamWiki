function clock() {
	var now = new Date();
	var timeString = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
	document.getElementById("clock").firstChild.nodeValue = timeString;
}
