
const b = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
class register{
	constructor(){
		this.crayner = new crayner;
		this.form 	 = null;
		this.alert   = "";
	}
	tgl(y){
		var i = 1,oo='<option>',oc='</option>',so='<select ',sc='</select>',a=so+'required name="tgl" id="tl">'+oo+oc,x;
		for(;i<=31;i++){
			a+=oo+i+oc;
		}
		a+=sc+so+'required name="bln" id="bln">';
		for(x in b){
			a+=oo+b[x]+oc;
		}
		a+=sc+so+'required name="thn" id="thn">'+oo+oc;
		for(i=y;i>=1960;i--){
			a+=oo+i+oc;
		}
		document.getElementById('tgl').innerHTML = a+'</select>';
	}
	gv(id){
		return document.getElementById(id).value;
	}
	
	fv(a){
		a = a.toString();
		return (a.length==1?"0"+a:a);
	}

	reg(url){
		if (nama.length<4) {
			alert("Harap masukkan nama yang valid !");
		}
		this.fr = {
			"nama"			:	this.gv("nama"),
			"tempat_lahir"	:	this.gv("tempat_lahir"),
			"tanggal_lahir"	:	(this.gv("thn")+"-"+(this.fv(b.indexOf(this.gv("bln"))))+"-"+(this.fv(this.gv("tl")))),
			"phone"			: 	this.gv("phone"),
			"email"			:	this.gv("email"),
			"alamat"		:	this.gv("alamat"),
			"username"		:	this.gv("username"),
			"password"		:	this.gv("password"),
			"cpassword"		:	this.gv("cpassword")
		};
		if (this.rule()) {
			this.send(JSON.stringify(this.fr));
		} else {
			alert(this.alert);
		}
	}
	rule(){
		if (this.fr.nama.length<4) {
			this.alert = "Nama terlalu pendek!";
			return false;
		}
		if (this.fr.tempat_lahir.length<5) {
			this.alert = "Tempat lahir terlalu pendek!";
		}
		if (!this.tgl_verify()) {
			this.alert = "Tanggal lahir tidak valid!";
			return false;
		}
		if (this.fr.phone.length<10) {
			this.alert = "Nomor hp tidak valid!";
			return false;
		}
		if (this.fr.alamat.length<10) {
			this.alert = "Alamat kurang lengkap!";
			return false;
		}
		if (this.fr.username.length<4) {
			this.alert = "Username terlalu pendek!\nMinimal 4 karakter.";
			return false;
		}
		if (this.fr.username.length>20) {
			this.alert = "Username terlalu panjang!\nMaksimal 20 karakter.";
			return false;
		}
		if (this.fr.password<6) {
			this.alert = "Password terlalu pendek!\nMinimal 6 karakter.";
			return false;
		}
		if (this.fr.password!==this.fr.cpassword) {
			this.alert = "Konfirmasi Password tidak sama!";
			return false;
		}
		return true;
	}
}