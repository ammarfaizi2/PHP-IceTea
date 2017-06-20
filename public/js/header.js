class header{
	constructor(router){
		this.router = router;
	}
	navbar(){
		var n = {
			"Beranda": "/home",
			"Profile": "/profile",
			"Pengaturan": "/settings",
			"Logout": "/logout"
		}, nvb = document.getElementById('nvb'), x;
		for(x in n){
			nvb.innerHTML += "<a href=\""+this.router+n[x]+"\" id=\"nbl\"><li id=\"nb\">"+x+"</li></a>";
		}
	}
}