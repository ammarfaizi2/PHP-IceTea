class header{
	constructor(router){
		this.router = router;
	}
	navbar(){
		document.getElementById("cgf").innerHTML = '<div id="nv"><form id="frb" method="get" action="'+this.router+'/search"><div id="nvb"><input type="text" name="q" id="nb" class="q"><button id="nb" class="bq">Cari</button></div></form></div id="nv">';
		var n = {
			"Beranda": "/home",
			"Profile": "/profile",
			"Pengaturan": "/settings",
			"Logout": "/logout"
		}, nvb = document.getElementById('nvb'), x;
		for(x in n){
			nvb.innerHTML += "<a href=\""+this.router+n[x]+"\" id=\"nbl\" class=\"qs\"><li id=\"nb\" class=\"px\">"+x+"</li></a>\n";
		}
	}

}