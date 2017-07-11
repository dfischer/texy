<?php

/**
 * This demo shows how control modifiers usage
 */


// include Texy!
require_once __DIR__ . '/../../src/texy.php';


$texy = new Texy();
$texy->htmlOutputModule->baseIndent = 1;


function doIt($texy)
{
	// processing
	$text = file_get_contents('sample.texy');
	$html = $texy->process($text);  // that's all folks!

	// echo formated output
	echo $html;

	// and echo generated HTML code
	echo '<pre>';
	echo htmlSpecialChars($html);
	echo '</pre>';
	echo '<hr />';
}


header('Content-type: text/html; charset=utf-8');

echo '<h2>mode: Styles and Classes allowed (default)</h2>';
$texy->allowedClasses = true;
$texy->allowedStyles = true;
doIt($texy);

echo '<h2>mode: Styles and Classes disabled</h2>';
$texy->allowedClasses = false;
$texy->allowedStyles = false;
doIt($texy);

echo '<h2>mode: Custom</h2>';
$texy->allowedClasses = ['one', '#id'];
$texy->allowedStyles = ['color'];
doIt($texy);
