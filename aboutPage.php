<?php

include('./profileMatcher.php');
class aboutPage {
function __construct($user1, $user2) {
	$this->UserRow1 = $this->setUserRow($user1);
	$this->UserRow2 = $this->setUserRow($user2);

}
function setUserRow($user) {
	$sql = 'SELECT * FROM user WHERE 
			username = "'.$user.'"';
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
	$size = 300;
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
			<div class="userInfo">
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
function printMatches() {
		echo '<br><br><h1>Meet '.$this->UserRow1['first_name'].' &
'.$this->UserRow2['first_name'].'</h1><br>';
		$matchSet = new profileMatcher($this->UserRow1['user_id'],
$this->UserRow2['user_id']);
		$matchSet->doMatch();
	foreach (array($this->UserRow1, $this->UserRow2) as $row) {
		$charities = $matchSet->setCharitySet($row['user_id']); 
		$turnred = $matchSet->getMatchArray();
		//print_r($charities);
		if (! empty($charities)) {
			echo '  <div class="row">';
		$url = $this->setGravURL($row);
		echo '
        <div class="span6">
			<img src="'.$url.'"/>
         <div>
			 <h2>'.$row['username'].'</h2>';
		foreach ($charities as $c) {
			if (in_array($c, $turnred)) {
				echo '<span class="label label-important"><h4>&nbsp;&nbsp;&nbsp;
'.$c.'  &nbsp;&nbsp;&nbsp;</h4></span><br><br>';
		}
		else {
				echo '<span
class="label"><h4>&nbsp;&nbsp;&nbsp;'.$c.'&nbsp;&nbsp;&nbsp;</h4></span><br><br>';
		}		
}
	echo '	
		</div>
		</div>';
	}
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
