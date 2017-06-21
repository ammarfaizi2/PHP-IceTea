/**
 *
 * @author    Ammar Faizi    <ammarfaizi2@gmail.com>
 */

class crayner{
    xhr(method,to,func,data='a=1',header=null){
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
        a.send(data);
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
    move(page, url) {
        if (typeof (history.pushState) != "undefined") {
            var obj = {Page: page, Url: url};
            history.pushState(obj, obj.Page, obj.Url);
        } else {
            window.location.href = url;
        }
    }
}