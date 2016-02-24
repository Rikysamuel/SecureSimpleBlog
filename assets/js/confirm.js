function hapus(id, user, token) {
  var answer = confirm("Are you sure want to delete this post?");
  
  if (answer){
    var d_id = "d_"+id;
    var link = document.getElementById(d_id);  
    link.href = "deletepost.php?var=" + id + "&user=" + user + "&token=" + token;
  }
}

function occurrences(string, subString, allowOverlapping) {
    string += "";
    subString += "";
    if (subString.length <= 0) return (string.length + 1);

    var n = 0,
        pos = 0,
        step = allowOverlapping ? 1 : subString.length;

    while (true) {
        pos = string.indexOf(subString, pos);
        if (pos >= 0) {
            ++n;
            pos += step;
        } else break;
    }
    return n;
}

function isAlphaNumeric(str) {
  var code, i, len;

  for (i = 0, len = str.length; i < len; i++) {
    code = str.charCodeAt(i);
    if (!(code > 47 && code < 58) && // numeric (0-9)
        !(code > 64 && code < 91) && // upper alpha (A-Z)
        !(code > 96 && code < 123)) { // lower alpha (a-z)
      return false;
    }
  }
  return true;
};

//fungsi untuk validasi format pada form tambah post
function checkformat() {
  //cek jika judul kosong atau tidak
  var judul = document.getElementById("Judul").value;
  if (judul == ""){
    //jika judul kosong
    document.getElementById("title_comment").innerHTML="Judul tidak boleh kosong!";
    document.getElementById("title_comment").style.color="red";
    return false;
  }
  else if(judul!=""){ //jika judul tidak kosong, validasi tanggal
    document.getElementById("title_comment").innerHTML="ok!";
    document.getElementById("title_comment").style.color="green";
    var tanggal = document.getElementById("Tanggal").value;
    if (tanggal.length>10){ //jika yang diinput pada tanggal >10 maka salah format
      document.getElementById("date_comment").innerHTML="Format tanggal salah!";
      document.getElementById("date_comment").style.color="red";
      return false;
    }
    else{
      //regex untuk cek tanggal yang valid
      var re = /^[0-9]{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])/;

      var date=tanggal.match(re); //matching input tanggal dengan regex
      
      if(!date){
        document.getElementById("date_comment").innerHTML="Format tanggal salah!";
        document.getElementById("date_comment").style.color="red";
        return false;
      }

      //mengambil tahun, bulan, dan tanggal dari hasil matching dengan regex
      var dtYear = date[0][0]+date[0][1]+date[0][2]+date[0][3];
      var dtMonth = date[0][5]+date[0][6];
      var dtDay=  date[0][8]+date[0][9];

      //memasukan hasil regex kedalam tipe Date
      var today = new Date();
      today.setHours(0,0,0,0);
      var in_date=new Date(dtYear,dtMonth-1,dtDay);

      if (in_date<today){ //jika input tanggal lebih kecil dari hari ini
        document.getElementById("date_comment").innerHTML="Tanggal tidak boleh lebih kecil dari hari ini";
        document.getElementById("date_comment").style.color="red";
        return false;
      }
      else{ //jika input tanggal sama dengan hari ini
        document.getElementById("date_comment").innerHTML="ok!";
        document.getElementById("date_comment").style.color="green";
        document.getElementById("form_submit").action = "new_post.php";
        
        return true;
      }
    }
  }
}

//fungsi untuk validasi format pada form edit
function checkformatedit(id) {
  //cek jika judul kosong atau tidak
  var judul = document.getElementById("Judul").value;
  if (judul==""){
    //jika judul kosong
    document.getElementById("title_comment").innerHTML="Judul tidak boleh kosong!";
    document.getElementById("title_comment").style.color="red";
    return false;
  }else{
    document.getElementById("edit_form").action = "editdb.php?var="+id;
    return true;
  }
}