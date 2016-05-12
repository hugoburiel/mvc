<?php
/**
 * @author Hugo David Buriel-Vasquez
 * @copyright Hugo David Buriel-Vasquez 2016
 * @version 1.0.0
*/

 // Compress output; if no browser support, default to ob_start()
 if( !ob_start("ob_gzhandler") ) { ob_start(); }

// Bootstrap
require_once( dirname( __DIR__ ) . '/private/bootstrap.php' );

// Init
PAGE::init();

// // Flush output buffers
ob_end_flush();