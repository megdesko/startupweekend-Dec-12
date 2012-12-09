<?php
include("./setupDb.php");
include("./landingPage.php");
include("./templateMaker.php");
$_SESSION['username'] = 'drSnickerdoodle';
$link = mysql_pconnect('localhost','root','root');

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
$template->emitMenu();
try {
	templateMaker::emitHeaders();
	$myPage = new landingPage();
	$myPage->emitCSS();
	$myPage->makeTopBox();
	$myPage->setMatches();
	$myPage->printMatches();
	templateMaker::emitFooters();
}
catch (Exception $e) {
	echo 'Caught exception: '.$e->getMessage();
}


?>
