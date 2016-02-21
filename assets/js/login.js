function doLogin(username, password) {
	var key = CryptoJS.enc.Hex.parse("0123456789abcdef0123456789abcdef");
	var iv =  CryptoJS.enc.Hex.parse("abcdef9876543210abcdef9876543210");
	var param = username+":"+password;
	
	// encrypt param
	param = CryptoJS.AES.encrypt(param, key, {iv:iv});
	param = param.ciphertext.toString(CryptoJS.enc.Base64);

	if (window.XMLHttpRequest)
	 	{
	 		xmlhttp=new XMLHttpRequest();
	 	}
	 	else
	 	{
	 		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	 	}

	 	xmlhttp.onreadystatechange=function()
	 	{
	 		if (xmlhttp.readyState==4 && xmlhttp.status==200)
	 		{
	 			if (xmlhttp.responseText=="success") {
	 				window.location.href = "index.php";
	 			} else {
	 				document.getElementById("login_comment").innerHTML = "Username/Password combination doesn't match!";
	 				document.getElementById("PasswordLogin").innerHTML = "";
					document.getElementById("username_comment").style.color = "red";
	 			}
	 		}
	 	}
	 	xmlhttp.open("POST","login.php",true);
	 	xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	 	xmlhttp.send("param=" + encodeURIComponent(param));
}

function login() {
	var username = document.getElementById("UsernameLogin").value;
	var password = document.getElementById("PasswordLogin").value;

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
				var n = parseInt(xmlhttp.responseText);
				for (var i=0; i<n-1; i++) {
					password = CryptoJS.SHA256(password).toString();
				};

				doLogin(username, password);
			}
		}
	}

	xmlhttp.open("GET", "get_n.php?username="+username, true);
	xmlhttp.send();

	return false;
}