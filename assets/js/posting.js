 //fungsi untuk request komentar dari php
 function req_komentar(id)
 {
 	var xmlhttp;
 	if (window.XMLHttpRequest)
	  {
	  	xmlhttp=new XMLHttpRequest();	//untuk browser IE7+, Firefox, Chrome, Opera, Safari
	  }
	else
	  {
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");	//untuk browser IE6, IE5
	  }
	
	xmlhttp.onreadystatechange=function()
	{
  		if (xmlhttp.readyState==4 && xmlhttp.status==200)	//jika sudah selesai load dan status OK
    	{
    		document.getElementById("comment_here").innerHTML=xmlhttp.responseText;	//masukan respon ke id "comment_here"
    	}
  	}
	xmlhttp.open("GET","loadcomment.php?id="+id,true);
	xmlhttp.send();
 }

 function checkemail(email){
 	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	if(!email.match(re)){
		document.getElementById("email_comment").innerHTML="Email not Valid!";
  		document.getElementById("email_comment").style.color="red";
		return false;
	}
	else{
		return true;
	}
 }

 function getTodayDate(){
 	var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1;

    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 
    var today = yyyy+'-'+mm+'-'+dd;
    return today;
 }

 //fungsi mengirim komentar dari use ke php
 function ins_komentar(id){
 	var email = document.getElementById("Email").value;
 	if (checkemail(email)){
	 	var tanggal = getTodayDate();
	 	//ajax
	 	var xmlhttp;
	 	var nama = document.getElementById("Nama").value;
	 	if(nama==""){
	 		nama="undefined";
	 	}
		var komentar = document.getElementById("Komentar").value;
		var token = document.getElementById("csrf-token").value;
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
	 			document.getElementById("email_comment").innerHTML="";
	 			document.getElementById("Nama").value="";
	 			document.getElementById("Komentar").value="";
	 			document.getElementById("Email").value="";
	 			document.getElementById("comment_here").innerHTML=xmlhttp.responseText;	//masukan respon ke id "comment_here"
	 		}
	 	}
	 	xmlhttp.open("POST","add_comment.php",true);
	 	xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	 	xmlhttp.send("id="+id+"&nama="+nama+"&komentar="+komentar+"&tanggal="+tanggal+"&token="+token);
 	}
 	else{
 		return false;
 	}
 }