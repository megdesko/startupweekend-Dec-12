<?php

class profilePage{
function __construct($profileUsername) {
	$this->ProfileName = $profileUsername;
	$this->UserRow = $this->setUserRow();
	$this->gravURL = $this->setGravURL();

}
function setUserRow() {
	$sql = 'SELECT * FROM user WHERE 
			username = "'.$this->ProfileName.'"';
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
			<h3>'.$this->UserRow['username'].'</h3>
        		<p>'.$this->UserRow['city'].', '.$this->UserRow['state'].' / '
			.$this->UserRow['age'].' 
				</p>';
			if ($this->UserRow['username'] != $_SESSION['username']){
				echo '<p>'.$this->UserRow['about_me'].'</p>';
			}
		echo '
          <p><a class="btn" href="#">Message Me &raquo;</a></p>
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
	$sql = 'SELECT * FROM organization, org_match
			WHERE user_id = '.$this->UserRow['user_id'].'
			AND organization.organization_id = org_match.organization_id';
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
		$this->Matches['org_name'] = 'chicken';
		$this->Matches['org_name'] = 'frog';
		$this->Matches['org_name'] = 'butterfly';
	}	
}

function printMatches() {
    echo '<h2>My Charities</h2>';
	foreach ($this->Matches as $row) {
		if ($count %3 === 0) {
		echo '  <div class="row">';
		}
		echo '
        <div class="span4">
          <h4>'.$row['org_name'].'</h4>
		  <p>'.$row['reason'].'</p>	
          <p><a class="btn" href="#">Learn More &raquo;</a></p>
        </div>';
		$count ++;
		if ($count %3 ===0 ) {	
		echo '</div>';
		}
	}
	if ($count %3 != 0) {
		echo '</div>';
	}
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
