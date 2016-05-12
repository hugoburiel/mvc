<?php
/**
 * @author Hugo David Buriel-Vasquez
 * @copyright Hugo David Buriel-Vasquez 2016
 * @version 1.0.0
*/

class IN_ARRAY
{
    //=============== Properties ===============//
	private static $_item = NULL;
	private static $_check = FALSE;
	private static $_arrayToCheck = NULL;


    //=============== Methods ===============//
    private function __construct(){} // Prevent direct object creation
    private function __clone(){} // Prevent object cloning
    public function __destruct(){} // Prevent direct object destruction


    /**
	 * Check if item is in array (any type).
	 * Arguments: (string) item, (array) array
	 * Return: boolean
	 */
	public static function check( $_item = null, $_arrayToCheck = array() )
	{
		try
		{
			if (!self::$_item)
			{
				$_check = preg_match( "/$_item/i" , json_encode( $_arrayToCheck ) );

				if ( !empty( $_check ) )
				{
					$_check = TRUE;
				}

				// Return
				return $_check;
			}

			// Return
			return( self::$_item );
		}
		catch ( Exception $_errorMessage )
		{
			// PHP error handler
			Exception_Handler::phpError( memory_get_usage(), $_errorMessage->getMessage(), $_errorMessage->getFile(), $_errorMessage->getLine(), $_errorMessage );
		}

	} // End check

} // End IN_ARRAY