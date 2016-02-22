var validFileExtensions = ["jpg", "jpeg", "bmp", "png"];
var imageVal = false;

//fungsi untuk konfirmasi jadi hapus/tidak sebuah post
function hapus(id) {
  //memunculkan prompt konfirmasi yes-or-no
  var answer = confirm("Apakah Anda yakin menghapus post ini?");
  if (answer){
    var d_id = "d_"+id;
    //mengambil data dari dokumen html yang mempunyai id bernama "d_id"
    var link = document.getElementById(d_id);
    //menuju halaman tepat post dihapus
    link.href = "deletepost.php?var="+id;
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

function checkImage(filename) {
  filename = filename.files[0].name;
  if (occurrences(filename, ".") == 1) {
    var ext = filename.substring(filename.lastIndexOf(".") + 1);
    filename = filename.substring(0, filename.lastIndexOf("."));
    if (validFileExtensions.indexOf(ext) > -1) {
      if (isAlphaNumeric(filename)) {
        document.getElementById("img_comment").innerHTML = "File ok";
        document.getElementById("img_comment").style.color = "green";
        imageVal = true;
      } else {
        document.getElementById("img_comment").innerHTML = "Filename should not contains special chars";
        document.getElementById("img_comment").style.color = "red";
      }
    } else {
        document.getElementById("img_comment").innerHTML = "Extension unknown";
        document.getElementById("img_comment").style.color = "red";
    }
  } else {
    document.getElementById("img_comment").innerHTML = "File unknown";
      document.getElementById("img_comment").style.color = "red";
  }
}

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

        return image;
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