<?php

$include_success = 0;
include $_SERVER['DOCUMENT_ROOT']."/OldSiteArchives/include.php";
if ($include_success == 0) {
	echo "<PRE>Failure to include files: ".$_SERVER['DOCUMENT_ROOT']."/OldSiteArchives/include.php</pre>";
	exit(1);
}

#echo '<pre>Include flag:'.$include_success.'</pre>';

$find_str = $_POST["find_str"];
$match_count = 0;

if (empty($find_str)) {
	echo '
	<html>
	<head>
	<title>Form:'.$find_str.'</title>
	</head>
	<body>

	<h1>Enter word to search for</h1>

	<form method="post" action="test_mail.php">
	<input type="text" name="find_str">
	<input type="submit">
	</form>

	</body>
	</html>
	';
	exit;
}

list($find_str,) = explode(' ', $find_str);

//read the subjects of the demo mailbox
error_reporting(E_ALL);
ini_set('display_errors', 'on');
ini_set("include_path", '/home/linderor/php:' . ini_get("include_path") ); 

require_once 'Mail/Mbox.php';
require_once 'HTTP/Request2.php';

//reads a mbox file

echo '<PRE>Searching for "'.$find_str.'".</PRE>';
//$file = dirname(__FILE__) . '/public_html/corvette-resto.com/OldSiteArchives/crpl-archive/crpl/2000-04/mbox.txt';

$file_path = realpath("$filebase");
$Directory = new RecursiveDirectoryIterator($file_path);
$Iterator = new RecursiveIteratorIterator($Directory);
$objects = new RegexIterator($Iterator, '/mbox.txt$/i', RecursiveRegexIterator::GET_MATCH);

#$objects = new RecursiveIteratorIterator(
#				new RecursiveDirectoryIterator($path),
#					RecursiveIteratorIterator::SELF_FIRST
#			);

foreach ($objects as $file => $object) {
	#$file = $filebase . '/2000-04/mbox.txt';

	echo 'Using file ' . $file . "<hr>\n";

	$mbox = new Mail_Mbox($file);

	$mbox->open();
	for ($n = 0; $n < $mbox->size(); $n++) {
	    echo '<pre>1:'.$file.'</PRE>';
	    echo '<pre>2:'.$n.'</PRE>';

	    $message = $mbox->get($n);

	    if (preg_match("/$find_str/im", $message, $matches)) {
			preg_match('/Subject: (.*)$/m', $message, $matches);
			$subject = $matches[1];
			
			$temp_filebase = preg_replace("#/#","\/",$filebase);
			$FN = preg_replace("/$temp_filebase/","",$file);
	    	echo '<pre>'.$FN.'</PRE>';
			list(, $YM, $FN) = explode('/', $FN);
			list($Y, $M) = explode('-', $YM, 2);
	    	$match_count--;
			echo '<A HREF="'.$baseurl.$view_email
					.'?Y='.$Y
					.'&M='.$M
					.'&FN='.$FN
					.'&MATCH='.$n
					."&find_str=".$find_str
				 	. '">Mail #'.$n.': '.$subject.'</A><br>';
	    }
	}
	$mbox->close();

	if ($match_count <= 0) {
		MatchCountExceeded($file, $find_str);
	}
}

 


function MatchCountExceeded($mfile, $mfind_str) {
	echo "<BR><HR><PRE>Match count exceeded.</PRE>";
	exit(1);
}
?>