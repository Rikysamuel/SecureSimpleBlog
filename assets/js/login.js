function doLogin(username, password, csrftoken, rememberme) {
	if (window.XMLHttpRequest) {
	 	xmlhttp=new XMLHttpRequest();
	}
	else {
	 	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

 	xmlhttp.onreadystatechange=function() {
 		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
 			if (xmlhttp.responseText=="false") {
 				document.getElementById("login_comment").innerHTML = "Username/Password combination doesn't match!";
 				document.getElementById("PasswordLogin").innerHTML = "";
				document.getElementById("login_comment").style.color = "red";
 			} else {
 				if(rememberme){
 					setCookie("cookieid",xmlhttp.responseText,7); // cookie di set dengan batas expire 1 minggu	
 				}
 				window.location.href = "index.php";
 			}
 		}
 	}
 	
 	xmlhttp.open("POST", "login.php", true);
 	xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
 	xmlhttp.send("username=" + username + "&password=" + password + "&token=" + csrftoken);
}

function login() {
	var username = document.getElementById("UsernameLogin").value;
	var password = document.getElementById("PasswordLogin").value;
	var csrftoken = document.getElementById("csrf-token").value;
	var rememberme = document.getElementById("remember").checked;

	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();	//untuk browser IE7+, Firefox, Chrome, Opera, Safari
  	} else {
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");	//untuk browser IE6, IE5
  	}

	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			if(xmlhttp.responseText=="false") {
				document.getElementById("login_comment").innerHTML = "Username doesn't exist!";
				document.getElementById("login_comment").style.color = "red";
			} else {
				var ret = JSON.parse(xmlhttp.responseText);
				var n = parseInt(ret[0]);
				for (var i=0; i<n-1; i++) {
					password = CryptoJS.SHA256(password).toString();
				};

				doLogin(username, password, ret[1], rememberme);
			}
		}
	}

	xmlhttp.open("GET", "get_n.php?username=" + username + "&token=" + csrftoken, true);
	xmlhttp.send();

	return false;
}

