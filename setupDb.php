<?php

class setupDB  {
	
	static function setupSexyGiving() {
		try {
			$sql = 'CREATE TABLE IF NOT EXISTS user (
				user_id		INT(11)  NOT NULL AUTO_INCREMENT PRIMARY KEY
				, username  CHAR(50)
				, first_name CHAR(50)
				, last_name CHAR(50)
				, city        CHAR(50)
				, zip_code    CHAR(50)
				, state		  CHAR(2)
				, gender	  CHAR(1)
				, email		  CHAR(100)
			)';
			$result = mysql_query($sql);
			if (!$result) {
				echo mysql_error().' - '.mysql_errno().'<br>';
				echo $sql;
				exit();
			}
			$sql = 'CREATE TABLE IF NOT EXISTS interests (
				focus_area_id  INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
				, user_id 	   INT(11)
				, interest		CHAR(100)
			)';	
			$result = mysql_query($sql);
			if (!$result) {
				echo mysql_error().' - '.mysql_errno().'<br>';
				echo $sql;
				exit();
			}
			$sql = 'CREATE TABLE IF NOT EXISTS org_match (
				org_match_id  INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
				, user_id 	   INT(11)
				, organization_id		CHAR(100)
				, reason		CHAR(200)
			)';	
			$result = mysql_query($sql);
			if (!$result) {
				echo mysql_error().' - '.mysql_errno().'<br>';
				echo $sql;
				exit();
			}
			$sql = 'CREATE TABLE IF NOT EXISTS menuHolder (
				menuHolder_id  INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
				, url		CHAR(200)
				, menu_name		CHAR(200)
			)';	
			$result = mysql_query($sql);
			if (!$result) {
				echo mysql_error().' - '.mysql_errno().'<br>';
				echo $sql;
				exit();
			}
			$sql = 'CREATE TABLE IF NOT EXISTS organization (
				organization_id  INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
				, org_name			CHAR(150)
				, main_focus_area	CHAR(100)
				, city				CHAR(100)
				, state				CHAR(2)
				, zip				CHAR(5)
				, street_1			CHAR(100)
				, street_2			CHAR(100)  
				, phone				CHAR(15)
				, main_contact		CHAR(100)
				, main_contact_email CHAR(150)
			)';
			$result = mysql_query($sql);
			if (!$result) {
				echo mysql_error().' - '.mysql_errno().'<br>';
				echo $sql;
				exit();
			}
			$sql = 'CREATE TABLE IF NOT EXISTS event (
				event_id	INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
				, organization_id   INT(11)
				, event_name		CHAR(150)
				, description 		TEXT
				, datetime_start	DATETIME
				, datetime_end		DATETIME
				, city				CHAR(100)
				, state				CHAR(2)
				, zip				CHAR(5)
				, street_1			CHAR(100)
				, street_2			CHAR(100)  
				, phone				CHAR(15)
				, main_contact		CHAR(100)
				, main_contact_email CHAR(150)
				, location			CHAR(100)
			)';
			$result = mysql_query($sql);
			if (!$result) {
				echo mysql_error().' - '.mysql_errno().'<br>';
				echo $sql;
				exit();
			}
	}
		catch (Exception $e) {
			throw ($e);
		}
	}






} //end class setupDB






?>
