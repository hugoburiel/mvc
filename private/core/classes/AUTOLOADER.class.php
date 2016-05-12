<?php
/**
 * @author Hugo David Buriel-Vasquez
 * @copyright Hugo David Buriel-Vasquez 2016
 * @version 1.0.0
*/

/**
 * Autoloader
 */
class AUTOLOADER
{
    //=============== Properties ===============//
   	private $_className = null;
    private $_obj = null;

    //=============== Methods ===============//
    private function __clone(){} // Prevent object cloning
    public function  __destruct(){} // Prevent direct object destruction

    public function __construct()
    {
        spl_autoload_register( array( $this, '_classLoader' ) );
    }


    /**
	 * Class Loader
	 */
    private function _classLoader( $_className )
    {
		// Core
		if( file_exists( PRIVATE_CORE_UTILITIES . '/' . $_className.'.class.php' ) )
		{
            require_once( PRIVATE_CORE_UTILITIES . '/' . $_className . '.class.php' );
		}

        // Database classes
		elseif( file_exists( PRIVATE_CORE_DATABASE . '/' . $_className . '.class.php' ) )
		{
            require_once( PRIVATE_CORE_DATABASE . '/' . $_className . '.class.php' );
		}

        // Admin
        elseif( file_exists( PRIVATE_ADMIN_CLASSES . '/' . $_className . '.class.php' ) )
        {
            require_once(PRIVATE_ROOT . '/admin/classes/' . $_className . '.class.php');
        }

        // Core
        elseif( file_exists( PRIVATE_CORE_CLASSES . '/' . $_className . '.class.php' ) )
        {
            require_once( PRIVATE_CORE_CLASSES . '/' . $_className . '.class.php');
        }

        // App
		elseif( file_exists( PRIVATE_APP_CLASSES . '/' . $_className . '.class.php' ) )
		{
            require_once( PRIVATE_APP_CLASSES . '/' . $_className . '.class.php');
		}

        // Error
        elseif( file_exists( PRIVATE_CORE_ERROR . '/' . $_className . '.class.php' ) )
        {
            require_once( PRIVATE_CORE_ERROR . '/' . $_className . '.class.php');
        }

    } // End _classLoader() method

} // End AUTOLOADER


// Declare variables
$autoloader = NULL;

// Instantiate object
$autoloader = new AUTOLOADER();
