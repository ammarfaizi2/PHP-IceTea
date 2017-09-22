<?php

function ___icetea_error_handler($err_severity, $err_msg, $err_file, $err_line, array $err_context)
{
	echo "<h2>Whoops... Terjadi Error!</h2><br>";
	echo "File&nbsp;&nbsp;: ".htmlspecialchars($err_file)."<br>";
	echo "Line&nbsp;: ".$err_line."<br>";
	echo "Pesan Error : ".htmlspecialchars($err_msg)."<br><br>";
	echo "Penyebab kira-kira : <br><pre>".htmlspecialchars(file($err_file)[$err_line-1])."</pre><br><br>";
	echo "Debug backtrace : <br>";
	foreach (debug_backtrace() as $key => $value) {
		echo "File : ".htmlspecialchars($value['file'])."<br>";
		echo "Line : ".htmlspecialchars($value['line'])."<br>";
		echo "Function : ".htmlspecialchars($value['function'])."<br><br>";
	}
	echo "<br><br><!--";
}

set_error_handler("___icetea_error_handler");