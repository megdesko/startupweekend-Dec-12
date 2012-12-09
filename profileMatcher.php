<?php 
class profileMatcher {

function __construct($currentUser, $matchedUser) {
$this->currentID = $currentUser;
$this->matchedID = $matchedUser;
}

function getMatchArray() {
	return $this->MatchArray;
}

function printCharities() {
	$comma = '';
	foreach ($this->MatchArray as $match) {
		$ret .= $comma.$match;
		$comma = ', ';
	}
	return $ret;
}

function doMatch() {
	$sql1 = 'SELECT * FROM org_match, organization 
			WHERE user_id = '.$this->currentID.'
			AND organization.organization_id = org_match.organization_id';
	$result1 = mysql_query($sql1);
	while ($result1 && $row = mysql_fetch_assoc($result1)) {
		$current[] = $row['org_name'];
	}
	$sql2 = 'SELECT * FROM org_match, organization 
			WHERE user_id = '.$this->matchedID.'
			AND organization.organization_id = org_match.organization_id';
	$result2 = mysql_query($sql2);
	while ($result2 && $row = mysql_fetch_assoc($result2)) {
		$other[] = $row['org_name'];
	}
	foreach ($current as $org) {
		if (in_array($org, $other)) {
			$this->MatchArray[] = $org;
		}		
	}	
}
function setCharitySet($userid) {
	$sql1 = 'SELECT * FROM org_match, organization 
			WHERE user_id = '.$userid.'
			AND organization.organization_id = org_match.organization_id';
	$result1 = mysql_query($sql1);
	while ($result1 && $row = mysql_fetch_assoc($result1)) {
		$current[] = $row['org_name'];
	}
	return $current;
}
} // end class
?>
