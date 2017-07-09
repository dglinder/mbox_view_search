<?php

$include_success = 0;
include $_SERVER['DOCUMENT_ROOT']."/OldSiteArchives/include.php";
if ($include_success == 0) {
	echo "<PRE>Failure to include files: ".$_SERVER['DOCUMENT_ROOT']."/OldSiteArchives/include.php</pre>";
	exit(1);
}

//read the subjects of the demo mailbox
error_reporting(E_ALL);
ini_set('display_errors', 'on');
ini_set("include_path", '/home/linderor/php:' . ini_get("include_path") ); 

require_once 'Mail/Mbox.php';

$Y = intval($_GET["Y"]);
	if (! is_int($Y)) { echo "Year error ($Y).";}
$M = intval($_GET["M"]);
	if (! is_int($M)) { echo "Month error ($M).";}
$FN = $_GET["FN"];
	if (! is_string($FN)) { echo "FN error ($FN).";}
$messagenum = intval($_GET["MATCH"]);
	if (! is_int($messagenum)) { echo "Messagenum error ($messagenum).";}
$file = sprintf("%04d-%02d/%s", $Y, $M, $FN);
	if (! is_string($file)) { echo "File error ($file).";}

if ( is_int($Y) && is_int($M) && is_string($FN) && is_int($messagenum)) {

	$file = $filebase . $file;
	//echo 'Using file ' . $file . "<hr>\n";

	$mbox = new Mail_Mbox($file);

	$mbox->open();

	$message = $mbox->get($messagenum);
	$message = preg_replace($pattern, $replacement, $message);
	echo "<pre>$message</pre>";

	$mbox->close();	
} else {
	echo "<PRE>Error in input: $Y / $M / $FN / $messagenum / $file</PRE><BR>";
}

?>