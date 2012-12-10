<?php

include('./profileMatcher.php');
class landingPage {
function __construct() {
	$this->UserRow = $this->setUserRow();
	$this->gravURL = $this->setGravURL();

}
function setUserRow() {
	$sql = 'SELECT * FROM user WHERE 
			username = "'.$_REQUEST['sessionusername'].'"';
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	return $row;
}
function setGravURL($row) {
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
	//$url = "http://www.gravatar.com/avatar/" . md5( strtolower(
	//		trim ($email))) . "?d=" . urlencode($default) . "&s=" . $size;
	return $url;
}

function makeTopBox() {
echo '
    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
       		<div>
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
    echo '<h2>Honey Matches:</h2>';
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
function printDefault() {
echo '
      <!-- Example row of columns -->
      <div class="row">
        <div class="span4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
        </div>
        <div class="span4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
       </div>
        <div class="span4">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
        </div>
      </div>
';
} //end place holder

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
