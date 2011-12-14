function addInput(divName) {
	var parentDiv = document.getElementById(divName);
	var newDiv = document.createElement('div');
	var counter = parentDiv.getElementsByTagName('div').length - 1;
	newDiv.setAttribute('id', 'VoteChoice' + (counter + 1));
	newDiv.setAttribute('class', 'input textarea');
	newDiv.innerHTML = "<label for='VoteChoice" + (counter + 1) + "'>Choice" + (counter + 1) + "</label><textarea name='data[Vote][choice" + (counter + 1) + "]' cols='30' rows='6' id='VoteChoice" + (counter + 1) + "'></textarea>"
	parentDiv.appendChild(newDiv);
}
function deleteInput(divName) {
	var parentDiv = document.getElementById(divName);
	var counter = parentDiv.getElementsByTagName('div').length - 1;
	alert(counter);
	if (counter == 2) {
		alert("You can have a least 3 rows.");
	} else {
		var badDiv = parentDiv.getElementById('VoteChoice' + counter);
		parentDiv.removeChild(badDiv);
	}
}