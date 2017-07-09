<?php
//read the subjects of the demo mailbox
echo '<html>
';  # Start the page.

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
# Hack to get script to find some ASmallOrange shared hosting libraries.
ini_set("include_path", '/home/linderor/php:' . ini_get("include_path") );

$inc_file = "include.php";
$include_success = 0;
include $inc_file;
if ($include_success == 0) {
	echo "<PRE>Failure to include files: ".$inc_file."</pre>";
	exit(1);
}

if ( isset($_POST["find_str"]) ) {
	$find_str = $_POST["find_str"];
} else {
	$find_str = "";
}

if ( isset($_POST["start_month"]) ) {
	$start_month = $_POST["start_month"];
} else {
	$start_month = 1;
}

if ( isset($_POST["start_year"]) ) {
	$start_year  = $_POST["start_year"];
} else {
	$start_year = $archive_start_year;
}

if ( isset($_POST["start_index"]) ) {
	$start_index  = $_POST["start_index"];
} else {
	$start_index = 0;
}

#echo '<pre> post-find_str:'; var_dump($_POST["find_str"]); echo '</pre>';
$match_count = 0;

// Print the common search field on each page.
echo '<head><title>Form:'.$find_str.'</title></head><body>
<h1>Enter word to search for</h1>
	<form method="post">
  	<input type="text" name="find_str" value="'.$find_str.'"/>
  	<input type="text" name="start_year" value="'.$start_year.'"/>
  	<input type="text" name="start_month" value="'.$start_month.'"/>
  	<input type="text" name="start_index" value="'.$start_index.'"/>
  	<input type="submit">
 </form>
</body>
';

// Only search for the first word provided
list($find_str,) = explode(' ', $find_str);

if ( ! empty($find_str) ) {
	# Sanitize the year
	$start_year = sanitize_int($start_year, $archive_start_year, $archive_start_year, PHP_INT_MAX);
	$start_year = sprintf("%04d", $start_year);

	# Sanitize the month
	$start_month = sanitize_int($start_month, 1, 1, 12);
	$start_month = sprintf("%04d", $start_month);

	# Sanitize the index
	$start_index = sanitize_int($start_index, 0, 0, PHP_INT_MAX);
	$start_index = sprintf("%04d", $start_index);

echo '<PRE>YEAR: '.$start_year.' - MONTH: '.$start_month.' - INDEX: '.$start_index.'</PRE>';

	# Start searching files starting with YYYY-MM@INDEX
	# Build objects based on filebase and filter where year-month folder is less than YYYY-MM
	# if file == YYYY-MM, then start at INDEX
	# use mbox->get and iterate all
	# use preg_match to look for find_str
	# display up to match_count
	# build next button based on find_str and start_index+match_count
}

echo '</html>
'; # end the page.
?>
