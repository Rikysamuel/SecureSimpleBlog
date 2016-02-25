function checkCookie(cookiename) {
    var user = getCookie(cookiename);
    if (user != "") {
        return true;
    } else {
        return false;
    }
}

function cookieLogin(csrftoken) {
	if(checkCookie("cookieid")){
		var cookie = getCookie("cookieid");
		if (window.XMLHttpRequest) {
		 	xmlhttp=new XMLHttpRequest();
		}
		else {
		 	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}

	 	xmlhttp.onreadystatechange=function() {
	 		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	 			if (xmlhttp.responseText != "false") {
	 				var ret = JSON.parse(xmlhttp.responseText);
	 				setCookie("cookieid", ret[0], 7); // cookie di set dengan batas expire 1 minggu	
	 				window.location.href = "index.php";
	 			}
	 		}
	 	}

		xmlhttp.open("POST", "remember_login.php", true);
 		xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
 		xmlhttp.send("token=" + cookie+"&csrftoken="+ csrftoken);

 		return false;
	}
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires+"; path=/; secure";
}