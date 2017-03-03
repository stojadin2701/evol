//Author: Stefan Bajic

function approveEvent(eventID) {
	var flag = confirm("Are you sure you want to approve this event?");
		if (flag == true){
            $.ajax({
                url: 'mod/approveEvent',
                type: 'POST',
                data: {eventID: eventID}
            }).done(function() {
                location.reload();
            });
		}
}

function deleteEvent(eventID) {
	var flag = confirm("Are you sure you don't want to approve this event?");
		if (flag == true){
            $.ajax({
                url: 'mod/deleteEvent',
                type: 'POST',
                data: {eventID: eventID}
            }).done(function() {
                location.reload();
            });
		}
}

function deleteFeedback(feedbackID) {
	var flag = confirm("Are you sure you want to delete this user feedback?");
		if (flag == true){
            $.ajax({
                url: 'mod/deleteFeedback',
                type: 'POST',
                data: {feedbackID: feedbackID}
            }).done(function() {
                location.reload();
            });
		}
		return false;
}

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});