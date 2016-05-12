<?php
/**
 * @author Hugo David Buriel-Vasquez
 * @copyright Hugo David Buriel-Vasquez 2016
 * @version 1.0.0
*/

// Debug status (boolean); true = display error messages
!defined( 'DEBUG' ) ? define( 'DEBUG', true ) : NULL;

// Display errors: (yes = 1 / no = 0)
!defined('DISPLAY_ERRORS') ? define('DISPLAY_ERRORS', 1) : NULL;

// Default timezone.
date_default_timezone_set('America/Los_Angeles');



////////////////////////////////////////////////////////////////////////////////
/*** DO NOT EDIT BELOW THIS LINE **********************************************/
////////////////////////////////////////////////////////////////////////////////


/**
 * Constants
 */
require_once( __DIR__ . '/core/constants.inc.php' );


/**
 * Autoloader
 */
require_once( PRIVATE_CORE_CLASSES . '/AUTOLOADER.class.php' );


/**
 * Custom Exception Handler
 */
set_exception_handler( 'EXCEPTION_HANDLER::phpError' );
