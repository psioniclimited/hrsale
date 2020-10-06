<?php

error_reporting(0); //Setting this to E_ALL showed that that cause of not redirecting were few blank lines added in some php files.

$db_config_path = '../application/config/database.php';

// Only load the classes in case the user submitted the form
if($_POST) {

	// Load the classes and create the new objects
	require_once('includes/core_class.php');
	require_once('includes/database_class.php');

	$core = new Core();
	$database = new Database();


	// Validate the post data
	if($core->validate_post($_POST) == true)
	{

		// First create tables for database, then write the config file
		if ($database->create_tables($_POST) == false) {
			$message = $core->show_message('error',"The database tables could not be created, please verify your settings.");
		} else if ($core->write_config($_POST) == false) {
			$message = $core->show_message('error',"The database configuration file could not be written, please chmod application/config/database.php file to 777");
		}

		// If no errors, redirect to registration page
		if(!isset($message)) {
			$redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
			$redir .= "://".$_SERVER['HTTP_HOST'];
			$redir .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
			$redir = str_replace('install/','',$redir); 
			header( 'Location:'.$redir.'install/success.php') ;
		}

	}
	else {
		$message = $core->show_message('error','Not all fields have been filled in correctly. The host, username, password, and database name are required.');
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HRSALE - The Ultimate HRM</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<style type="text/css">
body {
	font-size: 12px;
}
.form-control {
	height: 32px;
}
.error {
	background: #ffd1d1;
	border: 1px solid #ff5858;
	padding: 4px;
}
</style>
</head>
<body style="background:linear-gradient(90deg, #000000 0%, #d3e9ff 100%);">
<div class="container" style="margin-top:50px ">
  <div class="row">
    <div class="col-md-6 col-md-offset-5" style="margin-bottom:15px;"> <img src="../skin/img/hrsale-white.png" /> </div>
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-primary">
        <div class="panel-heading"> <strong class="">HRSALE - The Ultimate HRM</strong> </div>
        <div class="panel-body">
          <?php if(isset($message)) {echo '<p class="error">' . $message . '</p>';}?>
          <h4>Database Setings</h4>
          <hr/>
          <form class="form-horizontal" id="install_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Hostname</label>
              <div class="col-sm-8">
                <input class="form-control" type="text" id="hostname" value="localhost" name="hostname">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-4 control-label">Database Username</label>
              <div class="col-sm-8">
                <input class="form-control" type="text" id="username" name="username">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-4 control-label">Database Password</label>
              <div class="col-sm-8">
                <input class="form-control" type="password" id="password" name="password">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-4 control-label">Database Name</label>
              <div class="col-sm-8">
                <input class="form-control" type="text" id="database" name="database">
              </div>
            </div>
            <div class="form-group last">
              <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="btn btn-success btn-sm" id="submit">Install</button>
                <button type="reset" class="btn btn-default btn-sm">Reset</button>
              </div>
            </div>
          </form>
          <p class="error">Please make sure the application/config/database.php file is writable.<br />
            <br />
            <strong>Example:</strong> <code>chmod 777 application/config/database.php</code></p>
        </div>
        <div class="panel-footer"><?php echo date('Y');?> &copy HRSALE - The Ultimate HRM</div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
