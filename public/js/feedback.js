//Author: Ana Peško
function displayForm(formID) {
	document.getElementById("suggestionBttn").style.display = "none";
	document.getElementById("eventBttn").style.display = "none";
	document.getElementById("userBttn").style.display = "none";

	/*
	if ("suggestion" == formID) {
		document.getElementById(formID).style.display = "inline";
	}
	else {
		document.getElementById(formID + "1").style.display = "inline";
		document.getElementById(formID + "2").style.display = "inline";
	}
	document.getElementById("submitBttn").style.display = "inline";
	*/

	document.getElementById(formID).style.display = 'inline';
}

function reset() {
	document.getElementById("suggestionBttn").style.display = "inline";
	document.getElementById("eventBttn").style.display = "inline";
	document.getElementById("userBttn").style.display = "inline";

	document.getElementById("suggestion").style.display = "none";
	document.getElementById("event").style.display = 'none';
	document.getElementById("user").style.display = 'none';

}
