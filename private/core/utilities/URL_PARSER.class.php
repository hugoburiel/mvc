<?php
/**
 * @author Hugo David Buriel-Vasquez
 * @copyright Hugo David Buriel-Vasquez 2016
 * @version 1.0.0
*/

class URL_PARSER
{
    //=============== Properties ===============//
	private static $_path           = NULL;
	private static $_components     = NULL;
	private static $_pathArguments = NULL;


    //=============== Methods ===============//

    // Non-implemented
    private function __construct(){} // Prevent direct object creation
    private function __clone(){} // Prevent object cloning
    public function __destruct(){} // Prevent direct object destruction


    /**
	 * Parse URL components; returns component count and URL components
	 */
	public static function pathComponents( array $pathOptions = array() )
	{
		try
		{
			if ( !self::$_components )
			{
				//TODO: improve process and sanitize

                // ???
				$_pathArguments = array_keys( $pathOptions, true );

                // If no path options passed in then default to superglobal info
				$_path = ( !empty( $_pathArguments ) ) ? $_pathArguments : PATH;

                // Sanitize; TODO: needs to be more robust, create class for this purpose
				$_path = preg_replace('/[^a-z_\/\-0-9]/i', '', $_path);

                // Split out controller, action, and parameter array; array_pad set to require at least 3 values (controller, action, and parameter)
                list( $controller, $action, $params ) = array_pad( explode('/', $_path, 3), 3, null );

                $controller = !empty( $controller ) ? $controller : 'home';

				// Return
				return array( 'controller' => $controller, 'action' => $action, 'params' => $params );
			}

			// Return
			return( self::$_components );

		}
		catch ( Exception $_errorMessage )
		{
			// PHP error handler
			Exception_Handler::phpError( memory_get_usage(), $_errorMessage->getMessage(), $_errorMessage->getFile(), $_errorMessage->getLine(), $_errorMessage );
		}

	} // End pathComponents

} // End URL_PARSER
