var counter = 2;
function addInput(divName) {
	var newDiv = document.createElement('div');
	newDiv.setAttribute('id', 'child' + counter);
	newDiv.setAttribute('class', 'input textarea required');
	newDiv.innerHTML = "<textarea name='data[Vote][choice" + (counter + 1) + "]' cols='30' rows='6' id='VoteChoice" + (counter + 1) + "' value='Enter choice" + (counter + 1) + " here'></textarea>"
	document.getElementById(divName).appendChild(newDiv);
	counter++;
}
function deleteInput(divName) {
	if (counter == 2) {
		alert("You can have a least 2 rows.");
	} else {
		var dynamicDiv = document.getElementById(divName);
		var oldDiv = document.getElementById('child' + counter);
		dynamicDiv.removeChild(oldDiv);
		counter--;
	}
}