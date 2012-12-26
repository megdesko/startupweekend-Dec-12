<?php
// included files
include('./profileMatcher.php');

class landingPage {

function __construct() {
	$this->UserRow = $this->setUserRow();
	$this->gravURL = $this->setGravURL();

}

function setUserRow() {
// gets the user info for the current user
	$sql = 'SELECT * FROM user WHERE 
			username = "'.$_REQUEST['sessionusername'].'"';
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	return $row;
}

function setGravURL($row) {
// sets the gravatar URL to get the user's picture
	if (!$row) {
		$email = $this->UserRow['email'];
	}
	else {
		$email = $row['email'];
	}
	$default = "http://www.gravatar.com/avatar/".
			md5(strtolower(trim('mdesko@gmail.com')));
	$size = 120;
	$url = "http://www.gravatar.com/avatar/" . md5( strtolower(
			trim ($email))) . "?s=" . $size;
	return $url;
}

function makeTopBox() {
// put current user's info in the top box of the page
echo '
    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
       		<div>
			<!-- print the gravatar image -->
			<img src="'.$this->gravURL.'"/>
			</div> 
			<div class="userInfo">
			<h3>Hello, '.$this->UserRow['first_name'].'</h3>
        		<p>'.$this->UserRow['city'].', '.$this->UserRow['state'].' / '
			.$this->UserRow['age'].' 
				</p>
      </div>
      </div>
';
}
function emitCSS() {
	echo '<style>
		.userInfo {
			left-margin:300px;
		}
	</style>';
}


function setMatches() {
// get the matches for this user to display them
	$sql = 'SELECT * FROM user WHERE interested_in="'.$this->UserRow['gender'].'"';
	$result = mysql_query($sql);
	if (!$result) {
		echo mysql_errno() .'- '.mysql_error().'<br>';
		echo 'Query- '.$sql.'<br>';
		exit();
	}	
	while ($result and $row = mysql_fetch_assoc($result)) {
		$this->Matches[] = $row;	
	}
	if (empty($this->Matches)) {
	}	
}

function printMatches() {
// prints the matches for this user
    echo '<h2>Honey Matches:</h2>';
	// show the top matches for this user
	foreach ($this->Matches as $row) {
		$matchSet = new profileMatcher($this->UserRow['user_id'],
$row['user_id']);
		$matchSet->doMatch();
		$charities = $matchSet->getMatchArray();
		//print_r($charities);
		if (! empty($charities)) {
		if ($count % 3 ===0) {
			echo '  <div class="row">';
		}
		$url = $this->setGravURL($row);
		echo '
        <div class="span4">
			<img src="'.$url.'"/>
         <div>
			 <h4>'.$row['username'].'</h4>
		
          <p>'.$row['about_me'].'</p>
        <p>You both like: <b>'.$matchSet->printCharities().'</b></p>  
		<p><a class="btn"
href="./profile.php?user='.$row['username'].'&sessionusername='.$_REQUEST['sessionusername'].'">View
Profile  &raquo;</a></p>
		</div>
		</div>';
		$count ++;
		if ($count % 3 ===0) {
			echo '</div>';
		}
	}
	}
	if ($count == 0) {
		echo '<p>You have no matches at this time.  <br>
			<b>Add a charity</b> to find more matches!</p>';
	}
	if ($count %3 != 0 or $count == 0) {
		echo '</div>';
	}
	echo '</div>';
}

function setVarArray($tableName) {
	try {
		$sql = 'SELECT * FROM '.$tableName;
		$result = mysql_query($sql);
		while ($result && $row = mysql_fetch_assoc($result)) {
			$menuItems[] = $row;
		}
	return $menuItems;	
	}
	catch (Exception $e) {
	throw $e;
	}		
}		
} //end class
