<!-- Author: Stefan Bajić -->
function login() {
    document.cookie = "user";
    document.getElementById("home").style.display = "block";
    document.getElementById("logout").style.display = "block";

    if (document.getElementById("inputUsername").value == "admin" && document.getElementById("inputPassword").value == "rootbeer") {
        document.cookie = document.cookie + " admin";
        document.getElementById("admin").style.display = "block";
	}
	
	else if (document.getElementById('inputUsername').value == 'moderator' && document.getElementById('inputPassword').value == 'moderator') {
      document.cookie = document.cookie + ' mod';
      document.getElementById('mod').style.display = 'block';
    }
}

$(document).ready(function() {
$('#contact_form').bootstrapValidator({
    // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
    feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        username: {
            validators: {
                stringLength: {
                    min: 4,
                }
            },
            notEmpty: {
                message: 'Username field cannot be empty'
            }
        },
        password: {
            validators: {
                stringLength: {
                    min: 8,
                }
            },
            notEmpty: {
                message: 'Password field cannot be empty'
            }
        },
    },
    submitHandler: {
    }
   
})
});