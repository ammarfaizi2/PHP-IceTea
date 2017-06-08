/**
 *
 * @author	Ammar Faizi	<ammarfaizi2@gmail.com>
 */
class crayner{
	xhr(method,to,func,data='a=1',header=null){
		var a = new XMLHttpRequest();
		a.open(method,to,data);
		a.setRequestHeader("X-Requested-With","XMLHttpRequest");
		if (header!=null) {
			var b;
			for(b in header){
				a.setRequestHeader(b,header[b]);
			}
		}
		a.withCredentials = true;
		a.onload = func;
		a.send(data);
	};
	strrev(str){
		var i = str.length-1,
			r ='';
		for (;i>=0;i--){
			r+=str[i];
		}
		return r;
	}
}