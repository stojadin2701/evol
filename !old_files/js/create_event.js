//Author: Vladimir Nikolić

function create() {
	if (
		document.getElementById("title").value != "" &&
		document.getElementById("category").value != "" &&
		document.getElementById("from").value != "" &&
		document.getElementById("to").value != "" &&
		document.getElementById("location").value != "" &&
		document.getElementById("summary").value != "" &&
		document.getElementById("description").value != ""
		) 
	{
	
		if (document.getElementById("from").value.localeCompare(document.getElementById("to").value) == 1)
		{
			window.alert("End date must be after the start date.");
		}
		else
		{
			window.location.href = "index.html";
		}
		
	}
	else
	{
		window.alert("Please fill in every field.");
	}
}


