<!-- Author: Stefan Bajić -->
function showSubcategories(id) {
    if (document.getElementById(id).style.display != "none") {
        document.getElementById(id).style.display = "none";
    }
    else 
        document.getElementById(id).style.display = "inline";
}

function userCheck() {
	if (document.cookie == "" ) {
		document.cookie = "guest";
	} else if (document.cookie != "guest") {
		document.getElementById("home").style.display = "block";
		document.getElementById("logout").style.display = "block";
		document.getElementById("register").style.display = "none";
		document.getElementById("login").style.display = "none";
		if (document.cookie.indexOf("admin") != -1) {
			document.getElementById("admin").style.display = "block";
			document.getElementById("feedback").style.display = "none";
		}
		if (document.cookie.indexOf("mod") != -1) {
			document.getElementById("mod").style.display = "block";
			document.getElementById("feedback").style.display = "none";
		}
	}
}

function logout() {
	document.cookie = "guest";
	document.getElementById("home").style.display = "none";
	document.getElementById("logout").style.display = "none";
	document.getElementById("register").style.display = "block";
	document.getElementById("login").style.display = "block";
	window.location.href = "index.html";
}