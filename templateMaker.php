<?php

class templateMaker {

static function emitHeaders() {
echo '
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>HoneyComb</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="./lib/twitter/docs/assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="./lib/twitter/docs/assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="./lib/twitter/docs/assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="./lib/twitter/docs/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="./lib/twitter/docs/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="./lib/twitter/docs/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="./lib/twitter/docs/assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>
';
}

function emitMenu() {
// print the menu items at the top of the page
$menuItems = $this->setVarArray('menuHolder');
echo '
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="#">
			<img src="./images/honeycomb_light_long.png" 
			width="10%" height="10%"/>
			</a>
          <div class="nav-collapse collapse">
            <ul class="nav">';

// emit the menu items so that the currently active one is selected
foreach ($menuItems as $row) {
	// if strpos then do this
	// doing it this way because PHP gives weird false positives
	if (strpos($row['url'], 'username') !== FALSE) {
	$row['url'] = str_replace('username',$_REQUEST['sessionusername'], $row['url']);
	}
	if (strpos($_SERVER['SCRIPT_FILENAME'], $row['base_name']) !== FALSE) {
		echo '<li class="active" ><a href="'.$row['url'].'">'.$row['menu_name'].'</a></li>';
	}
	else {
		echo '<li><a href="'.$row['url'].'">'.$row['menu_name'].'</a></li>';
	}
}
echo '
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
';
}
static function emitFooters() {
// print the page footers and included javascript files
echo '
      <hr>

      <footer>
        <p>&copy; Honeycomb 2012</p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./lib/twitter/js/jquery.js"></script>
    <script src="./lib/twitter/js/bootstrap-transition.js"></script>
    <script src="./lib/twitter/js/bootstrap-alert.js"></script>
    <script src="./lib/twitter/js/bootstrap-modal.js"></script>
    <script src="./lib/twitter/js/bootstrap-dropdown.js"></script>
    <script src="./lib/twitter/js/bootstrap-scrollspy.js"></script>
    <script src="./lib/twitter/js/bootstrap-tab.js"></script>
    <script src="./lib/twitter/js/bootstrap-tooltip.js"></script>
    <script src="./lib/twitter/js/bootstrap-popover.js"></script>
    <script src="./lib/twitter/js/bootstrap-button.js"></script>
    <script src="./lib/twitter/js/bootstrap-collapse.js"></script>
    <script src="./lib/twitter/js/bootstrap-carousel.js"></script>
    <script src="./lib/twitter/js/bootstrap-typeahead.js"></script>

  </body>
</html>
';
} //end footers
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
