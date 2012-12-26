<?php
// included files
include("./setupDb.php");
include("./aboutPage.php");
include("./templateMaker.php");

// set the user name for the "main" user in this match
$_REQUEST['sessionusername'] = 'helloandyhihi';
// set the user name for the alternate user in this match
$_REQUEST['altuser'] = 'drSnickerdoodle';

// connect to database; not on web and would need to configure
// so using default username and passwork
//** Fix this**
$link = mysql_pconnect('localhost','root','root');

// if creating the mysql connection fails, error out.
if (!$link) {
	printf("Connect failed: %s\n", mysql_connect_error());
	exit;
}


try {
	mysql_select_db('sexygiving');
	setupDB::setupSexyGiving($link);
}

catch (Exception $e) {
	echo 'Caught exception: '.$e->getMessage();
}
$template = new templateMaker();
// emit the page menu
$template->emitMenu();
try {
	// emit the html headers
	templateMaker::emitHeaders();
	// instantiate the object for the about page 
	$myPage = new aboutPage($_REQUEST['sessionusername'], $_REQUEST['altuser']);
	// emit the additional CSS for this page
	$myPage->emitCSS();
	// print the box containing general info
	$myPage->makeTopBox();
	// print the matches shown on this page
	$myPage->printMatches();
	// print the page footer
	templateMaker::emitFooters();
}
catch (Exception $e) {
	echo 'Caught exception: '.$e->getMessage();
}


?>
