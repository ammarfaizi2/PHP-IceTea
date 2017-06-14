window.onload = function(){
			/**
			 *	Buat tanggal lahir
			 */
			 var i = 1, b = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],oo='<option>',oc='</option>',so='<select ',sc='</select>',a=so+'required name="tanggal">'+oo+oc;
			 for(;i<=31;i++){
			 	a+=oo+i+oc;
			 }
			 a+=sc+so+'required name="bulan">';
			 for(x in b){
			 	a+=oo+b[x]+oc;
			 }
			 a+=sc+so+'required name="tahun">'+oo+oc;
			 for(i=<?php print date("Y"); ?>;i>=1960;i--){
			 	a+=oo+i+oc;
			 }
			 document.getElementById('tgl').innerHTML = a+'</select>';
		}