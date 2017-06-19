<!DOCTYPE html>
<html manifest="cache">
<head>
	<title>Daftar Nilai Siswa</title>
	
<script type="text/javascript">
/**
 *
 * @author    Ammar Faizi    <ammarfaizi2@gmail.com>
 */
class crayner{
    xhr(method,to,func,data='a=1',header=null,funcerr=null){
        var a = new XMLHttpRequest();
        a.open(method,to,true);
        a.setRequestHeader("X-Requested-With","XMLHttpRequest");
        if (header!=null) {
            var b;
            for(b in header){
                a.setRequestHeader(b,header[b]);
            }
        }
        a.withCredentials = true;
        a.onload = func;
        if (funcerr!==null) {
        	a.onerror = funcerr;
        }
        try{
        	a.send(data);
        } catch(e){
        	funcerr();
        }
        return a;
    };
    strrev(str){
        var i = str.length-1,
        r ='';
        for (;i>=0;i--){
            r+=str[i];
        }
        return r;
    }
    setCookie(cname, cvalue, exmin) {
        var d = new Date();
        d.setTime(d.getTime() + (exmin*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
}
class siswa
{
	constructor(){
		this.crayner = new crayner();
	}
	getData(){
		try{
			this.crayner.xhr("GET","/data_siswa",function(){
				var x;
				try{
					x = JSON.parse(this.responseText);
				} catch(e){					
					x = null;
				}
				if (x!==null) {
					if (this.status==200) {
						document.getElementById("qwe").value="online";
					}
					var dt = document.getElementById('dt'),j=0;
					localStorage.setItem("siswa",JSON.stringify(x));
					for(var i=1;i<=x.length;i++){
						dt.innerHTML += "<tr><td align=\"center\">"+(i)+"</td><td align=\"center\">"+x[j]['id']+"</td><td align=\"center\">"+x[j]['nama']+"</td><td align=\"center\">"+x[j]['kelas']+"</td><td align=\"center\">"+x[j++]['nilai']+"</td></tr>";
					}
				}
			},null);
		} catch(e){

		}
	}
}
var s = new siswa;
s.getData();
if (typeof(Storage) !== "undefined") {
	window.onload = function(){
		var inte = setInterval(function(){
			var x = localStorage.getItem("siswa"), status = document.getElementById('qwe').value;
			x = JSON.parse(x);
			console.log(x);
			var dt = document.getElementById('dt'),j=0;
			console.log(dt.innerHTML);
			if (dt.innerHTML=="") {
				var xz = "";
				for(var i=1;i<=x.length;i++){
						xz += "<tr><td align=\"center\">"+(i)+"</td><td align=\"center\">"+x[j]['id']+"</td><td align=\"center\">"+x[j]['nama']+"</td><td align=\"center\">"+x[j]['kelas']+"</td><td align=\"center\">"+x[j++]['nilai']+"</td></tr>";
				}
				dt.innerHTML = xz;
			}

			console.log(dt.innerHTML);
			if (dt.innerHTML!=="") {
				clearInterval(inte);
			}
		},1000);
	}
} else {
	alert("Browser anda tidak mendukung localstorage");
}
	</script>
	<style type="text/css">
		th{
			padding: 10px;
		}
	</style>
</head>
<body>
<center>
	<h3>Latihan web storage by IceTea</h3>
	<table>
	<thead>
		<tr><th>No.</th><th>ID Siswa</th><th>Nama</th><th>Kelas</th><th>Nilai</th></tr>
	</thead>
	<tbody id="dt"></tbody>
	</table>
	<form>
		<input type="hidden" name="status" id="qwe" value="offline">
	</form>
</center>
</body>
</html>