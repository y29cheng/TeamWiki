$(document).ready(function() {
	var links = "nav a";
	$(links).each(function() {
		$(this).attr("class", "unselected");
	});
});