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
function holdOtherStuff() {
echo '
    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>Hello, world!</h1>
        <p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <p><a class="btn btn-primary btn-large">Learn more &raquo;</a></p>
      </div>

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
static function emitFooters() {
echo '
      <hr>

      <footer>
        <p>&copy; HoneyComb 2012</p>
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
