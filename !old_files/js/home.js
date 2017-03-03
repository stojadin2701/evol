//Author: Ana Peško
function deleteEvent(eventID) {
	var flag = confirm("Are you sure you want to delete this event?");
		if (flag == true)
			document.getElementById(eventID).style.display = "none";
		return false;
}