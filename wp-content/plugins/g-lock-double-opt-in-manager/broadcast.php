<?php

////////////////////////////////////////////////////////////////////////
///
///                 Configuration
///
////////////////////////////////////////////////////////////////////////

require_once ('../../../wp-config.php');

define('GSOM_INCLUDE','1'); // this definition turns off plugin initialization code of glsft-optin.php
require_once('glsft-optin.php');


////////////////////////////////////////////////////////////////////////
///
///                 Code
///
////////////////////////////////////////////////////////////////////////

if ( $_GET['check'] != wp_hash('gsom1384695') )
	die('hash mismatch');	

error_reporting(0);
ignore_user_abort(true);

gsom_run_broadcast();    

echo 'OK';