
const b = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

/**
 *	Buat tanggal lahir
 */
class register{
	constructor()
	{
		this.crayner = new crayner;
		this.form 	 = null;
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
	
	gv(id)
	{
		return document.getElementById(id).value;
	}
	
	fv(a)
	{
		a = a.toString();
		return (a.length==1?"0"+a:a);
	}

	reg(url)
	{
		if (nama.length<4) {
			alert("Harap masukkan nama yang valid !");
		}
		this.form = {
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
		this.form = JSON.stringify(this.form);
	}
	rule()
	{

	}
}