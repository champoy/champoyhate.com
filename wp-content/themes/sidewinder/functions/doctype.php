<?php
function html_or_xhtml() {
	$newLine = "\r\n";
	$language = get_option('theme_html_or_xhtml');
	
	if($language=="HTML 4.0 Strict") {
		ob_start('xml2html');
		echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">'.$newLine;
	} else {
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'.$newLine;
	}
}

function xhtml_attributes() {
	$language = get_option('theme_html_or_xhtml'); 
	if($language=="XHTML 1.0 Strict") {
		echo ' xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"';
	}
}

function xml2html($buffer) {
	$XML = array(' />');
	$HTML = array('>');
	return str_replace($XML, $HTML, $buffer);
}
?>