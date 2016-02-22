var csrftoken = document.getElementById("csrf-token").value;

function checkName(name) {
	if (name == "") {
		document.getElementById("name_comment").innerHTML="Name is empty!";
  		document.getElementById("name_comment").style.color="red";
		return false;
	} else {
		document.getElementById("name_comment").innerHTML="Name Ok!";
  		document.getElementById("name_comment").style.color="green";
		return true;
	}
}

function checkemail(email) {
 	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	if(!email.match(re)){
		document.getElementById("email_comment").innerHTML="Email not valid!";
  		document.getElementById("email_comment").style.color="red";
		return false;
	}
	else{
		document.getElementById("email_comment").innerHTML="Email Ok!";
  		document.getElementById("email_comment").style.color="green";
		return true;
	}
}

function checkpass(pass1, pass2) {
	if (pass1 == "") {
		document.getElementById("password_comment").innerHTML = "password is empty!"
		document.getElementById("password_comment").style.color="red";
	} else {
		document.getElementById("password_comment").innerHTML = "";
	}
	if (pass2 == "") {
		document.getElementById("repass_comment").innerHTML = "password is empty!"
		document.getElementById("repass_comment").style.color="red";
		return false;
	} else {
		document.getElementById("repass_comment").innerHTML = "";
	}
	if (pass1 != pass2) {
		document.getElementById("repass_comment").innerHTML = "password doesn't match!"
		document.getElementById("repass_comment").style.color="red";
		document.getElementById("Password").innerHTML = "";
		document.getElementById("repassword").innerHTML = "";

		return false;
	} else {
		return true;
	}
}

function register(name, username, email, password, csrftoken) {
	var n = 10000;

	// hash pass1 n-times
	for (var i = 0; i < n; i++) {
		password = CryptoJS.SHA256(password).toString();
	}

	if (window.XMLHttpRequest) {
 		xmlhttp=new XMLHttpRequest();
 	}
 	else {
 		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
 	}

 	xmlhttp.open("POST", "regist_user.php", true);
 	xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
 	xmlhttp.send("name=" + name + "&username=" + username + "&email=" + email + "&password=" + password + "&csrftoken=" + csrftoken);
}

function checkregistration() {
	var name = document.getElementById("Name").value;
	var username = document.getElementById("Username").value;
	var email = document.getElementById("Email").value;
	var pass1 = document.getElementById("Password").value;
	var pass2 = document.getElementById("repassword").value;

	if (checkName(name)) {
		if (username!="") {
			var xmlhttp;
			if (window.XMLHttpRequest) {
				xmlhttp=new XMLHttpRequest();	// IE7+, Firefox, Chrome, Opera, Safari
		  	} else {
		  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");	// IE6, IE5
		  	}

			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					if(xmlhttp.responseText.indexOf("Error") > -1 ) {
						document.getElementById("username_comment").innerHTML = xmlhttp.responseText;
						document.getElementById("username_comment").style.color = "red";
					} else {
						document.getElementById("username_comment").innerHTML="Username Ok";
						document.getElementById("username_comment").style.color = "green";

						csrftoken = xmlhttp.responseText;
						
						if (checkemail(email)) {
							if (checkpass(pass1, pass2)) {
								register(name, username, email, pass1, csrftoken);
								window.location.href = "index.php";
							}
						}
					}
				}
			}

			xmlhttp.open("GET", "check_user_exist.php?username=" + username + "&csrftoken=" + csrftoken, true);
			xmlhttp.send();
		} else {
			document.getElementById("username_comment").innerHTML="Username is empty!";
  			document.getElementById("username_comment").style.color="red";
		}
	}
	
	return false;
}