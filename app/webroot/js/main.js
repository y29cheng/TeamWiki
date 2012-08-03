//main.js
$(document).ready(function() {
	$('article').hide();
	$('article').fadeIn(3000);
	$('#id').hide();
	
});

function slide() {
	var links = ".pages a";
	$(links).each(function(i) {
		$(this).hover(function(){
			$(this).animate({"padding-left": "2em"}, 150);
		}, function(){
			$(this).animate({"padding-left": "1em"}, 150);
		});
	});
}