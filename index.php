<?php
include("./setupDb.php");
include("./landingPage.php");
include("./templateMaker.php");

// if there isn't a username on the command line
// fill it in-- prevents errors in demo
// should not go any further if this isn't here **Fix**
if (! $_REQUEST['sessionusername']) {
	$_REQUEST['sessionusername'] = 'drSnickerdoodle';
}
// connect to the MySQL
$link = mysql_pconnect('localhost','root','root');

// exit if connect to db fails
if (!$link) {
	printf("Connect failed: %s\n", mysql_connect_error());
	exit;
}

// choose the database
try {
	mysql_select_db('sexygiving');
	setupDB::setupSexyGiving($link);
}

catch (Exception $e) {
	echo 'Caught exception: '.$e->getMessage();
}
// start a new template for the page
$template = new templateMaker();
// and print the menu
$template->emitMenu();
try {
	// print the headers
	templateMaker::emitHeaders();
	// instantiate the landing page for this user
	$myPage = new landingPage();
	$myPage->emitCSS();
	// show user's info
	$myPage->makeTopBox();
	// set user's matches
	$myPage->setMatches();
	// print the user's matches
	$myPage->printMatches();
	// call method to print page footers
	templateMaker::emitFooters();
}
// show exception
catch (Exception $e) {
	echo 'Caught exception: '.$e->getMessage();
}


?>
