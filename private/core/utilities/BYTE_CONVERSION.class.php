<?php
/**
 * @author Hugo David Buriel-Vasquez
 * @copyright Hugo David Buriel-Vasquez 2016
 * @version 1.0.0
*/

/**
 * TODO: add comments
 */
class BYTE_CONVERSION
{
    //=============== Properties ===============//
	private static $_bytes = NULL;
	private static $_MB    = 1048576;

	// Error handlers - Do not modify
   	private static $_errorMessage     = array();

	// App specific - Can edit


    //=============== Methods ===============//

    // Non-implemented
    private function __construct(){} // Prevent direct object creation
    private function __clone(){} // Prevent object cloning
    public function __destruct(){} // Prevent direct object destruction


    /**
	 * Convert bytes to various units
	 */
	public static function byteConversion($_bytes)
	{
		try
		{
		    if ($_bytes < 1024)
		    {
		        // Bytes
		        return $_bytes . ' Bytes';
		    }
		    elseif ($_bytes < self::$_MB)
		    {
		        // Kilobytes
		        return round($_bytes/1024, 2) . ' KB';
		    }
		    else
		    {
		        // Megabytes
		        return round($_bytes/self::$_MB, 2) . ' MB';
		    }
		}
		catch (Exception $_errorMessage)
		{
			// PHP error handler
			Exception_Handler::phpError(memory_get_usage(), $_errorMessage->getMessage(), $_errorMessage->getFile(), $_errorMessage->getLine(), $_errorMessage);
		}

	} // End byteConversion

} // End BYTE_CONVERSION