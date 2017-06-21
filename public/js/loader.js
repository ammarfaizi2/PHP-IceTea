
class loader{
	constructor(cr,init,rt){
		this.router = rt;
		this.crayner = cr;
		this.init_page = init;
		this.npr_flag = 0;
	}
	load_cgf(){
		document.getElementById('crayner').innerHTML+='<div id="cgf"></div>';
	}
	init_load(){
		this.load_cgf();
		return this.crayner.xhr("GET",this.router+"/user/ajax?init="+encodeURIComponent(this.init_page),function(){
				document.getElementById('crayner').innerHTML+= this.responseText;
		});
	}
	pg(page, url){
		if (typeof (history.pushState) != "undefined") {
	        var obj = {Page: page, Url: url};
	        history.pushState(obj, obj.Page, obj.Url);
	        this.crayner.xhr("GET",this.router+"/user/ajax?load="+encodeURIComponent(url),function(){
					document.getElementById('crayner').innerHTML+= this.responseText;
				});
	    } else {
	        window.location.href = url;
	    }
	}
	npr(){
		var nb = document.getElementById('nbl'),
			qs = document.getElementsByClassName("qs"),i = 0;
		for (;i<qs.length;i++) {
		    qs[i].addEventListener('click', function (event) {
		    		// Error disini
		    		// TypeError: this.pg is not a function
		    		this.pg(this.innerHTML, this.href);
		        	event.preventDefault();
		        	return false;
		    });
		}
		this.npr_flag = 1;
	}
}
