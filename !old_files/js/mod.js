//Author: Nemanja Stojoski
function approveEvent(eventID) {
	var flag = confirm("Are you sure you want to approve this event?");
		if (flag == true){
			document.getElementById(eventID).style.display = "none";
			alert("The event has been approved");
		}
		return false;
}

function removeEvent(eventID) {
	var flag = confirm("Are you sure you don't want to approve this event?");
		if (flag == true){
			document.getElementById(eventID).style.display = "none";
			alert("The event has been removed.");
		}
		return false;
}

function deleteFeedback(feedbackID) {
	var flag = confirm("Are you sure you want to delete this user feedback?");
		if (flag == true){
			document.getElementById(feedbackID).style.display = "none";
			alert("The feedback has been deleted.");
		}
		return false;
}