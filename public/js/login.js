
/**
 * @author	Ammar Faizi	<ammarfaizi2@gmail.com>
 */ 
class login{
	constructor(t){
		this.crayner = new crayner;
		this.dt = (new Date).getTime();
		this.dv = 0;
		this.t = t;
	}
	l(urlx){
		this.crayner.xhr("GET",urlx+"?tq="+(this.t.substr(0,32))+"&ts="+this.dt,
			function(){
				var x;
				try{
					x = JSON.parse(this.responseText);
				} catch(e){ x = null; }
				if (x!=null) {
					window.location = x[0];
				}
			}
		);
		if ((this.dv++)%2==0) {
			this.dt += 12;
		} else {
			this.dt += (132912 + this.dv);
		}
		this.t = this.t.split("").sort(function(){
			return 0.5-Math.random();
		}).join("");
	}
	lg(urlx,u,p,t,hash){
		t = this.crayner.strrev(t);
		this.crayner.xhr("POST",urlx+"?hk="+hash,function(){
				var x;
				try{
					x = JSON.parse(this.responseText);
				} catch(e){
					x = null;
				}
				if(x!=null){
					if(x['login']!=true){
						var s="background-color:#F47878;";
						document.getElementById("u").style = s;
						document.getElementById("p").style = s;
					}
					(x['alert']!='') && (alert(x['alert']));
					(x['r']!='') && (window.location=x['r']);
				}
			},"login=1&username="+encodeURI(u)+"&password="+encodeURI(p)+"&_token="+encodeURI(t),
			{
				"Content-type":"application/x-www-form-urlencoded"
			}
		);
	}
}
