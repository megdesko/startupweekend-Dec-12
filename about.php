<?php
include("./setupDb.php");
include("./aboutPage.php");
include("./templateMaker.php");

if (! $_REQUEST['sessionusername']) {
	$_REQUEST['sessionusername'] = 'helloandyhihi';
	$_REQUEST['altuser'] = 'drSnickerdoodle';
}
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
	$myPage = new aboutPage($_REQUEST['sessionusername'], $_REQUEST['altuser']);
	$myPage->emitCSS();
	$myPage->makeTopBox();
	$myPage->printMatches();
	templateMaker::emitFooters();
}
catch (Exception $e) {
	echo 'Caught exception: '.$e->getMessage();
}


?>
