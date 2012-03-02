$(document).ready(function() {
	var bodyid = $(body).attr("id");
	var navs = "nav li a";
	$(navs).each(function() {
		if (bodyid == $(this).text()) $(this).attr("id", "selected");
		else $(this).attr("id", "unselected");
	});
})