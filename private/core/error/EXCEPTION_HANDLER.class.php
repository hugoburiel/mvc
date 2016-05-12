<?php
/**
 * @author Hugo David Buriel-Vasquez
 * @copyright Hugo David Buriel-Vasquez 2016
 * @version 1.0.0
*/

/**
 * Exception handler to provide PHP debugging information
 *
*/
class EXCEPTION_HANDLER extends Exception
{
    //=============== Properties ===============//

	// General - Do not modify
   	public static  $_memStart     = null;
   	private static $_memEnd       = null;
   	private static $_memoryUsage  = null;
	private static $_bt           = null;
	private static $_dt           = null;
	private static $_err          = array();
	private static $_errmsg       = null;
	private static $_filename     = null;
	private static $_linenum      = null;
	private static $_callType     = null;
	private static $_errorMessage = null;

	// App specific - Can edit


    //=============== Methods ===============//

	// Non-implemented
//    final private function __construct(){} // Prevent direct object creation
//    final private function __clone(){} // Prevent object cloning
//    final public function __destruct(){} // Prevent direct object destruction


	/**
	 * PHP error handler
	 */
    public static function phpError($_memStart, $_errmsg, $_filename, $_linenum, $_errorMessage)
	{
		if ( true === DEBUG )
		{
			// Final memory usage
            $_memEnd = memory_get_usage();

			// Calculate total memory engaged
            $_memoryUsage = BYTE_CONVERSION::byteConversion($_memEnd - $_memStart);

		    // Datetime stamp for error entry
		    $_dt = date("n-d-Y g:i:s A (T)");

			// Backtrace
		    $_bt = debug_backtrace();

		    $_err = '<section class="ErrorContainer" style="margin:25px; padding:10px;">';
    		    $_err .= '<span class="ErrorToggle" style="	display:block; width:20px; height:20px; color:rgb(255,255,255); text-align:center; background:gray; cursor:pointer;">+</span>';
                $_err .= '<section class="ErrorHandler PHPError" style="height:300px; padding:10px; border:6px ridge #888; background:#FDFD9F; overflow-y:scroll;">';
				$_err .= '<h1>PHP Error</h1>';
			    $_err .= '<pre>';
					$_err .= '<reportingclass><b>Reporting File</b></reportingclass><br>';
					$_err .= '<datetime>Datetime: ' . $_dt . '</datetime><br>';
					$_err .= '<errormsg>Error Message: ' . $_errmsg . '</errormsg><br>';
					$_err .= '<filename>Reporting File: ' . $_filename . '</filename><br>';
					$_err .= '<linenum>Reporting Line: ' . $_linenum . '</linenum><br>';
					$_err .= '<br>';
					$_err .= '<location><b>Location of Error</b></location><br>';
					$_err .= '<scriptfile>File: ' . $_bt[0]['file'] . '</scriptfile><br />';
					$_err .= '<scriptline>Line: ' . $_bt[0]['line'] . '</scriptline><br />';
					$_err .= '<scriptclass>Class: ' . $_bt[0]['class'] . '</scriptclass><br />';
					$_err .= '<scriptfunction>Function: ' . $_bt[0]['function'] . '</scriptfunction><br />';
					$_err .= '<methodtype>Method Type: ' . $_callType = ( true === strpos($_bt[0]['type'],'::') ) ? 'Static method (::)' : 'Standard Method (->)' . '</methodtype><br />';
					$_err .= '<memoryusage>Memory usage up to error: ' . $_memoryUsage . '</memoryusage><br>';
		    $_err .= '</pre>';

				// Display trace dumps
					echo $_err;

					echo '<pre>';
						echo '<h3><span class="ErrorToggle">+</span>print_r()</h3>';
						echo '<section class="PrintR" style="margin:30px 0;">';
								print_r($_errorMessage);
						echo '</section>';

						echo '<h3><span class="ErrorToggle">+</span>var_dump()</h3>';
						echo '<section class="TraceDump" style="margin:30px 0;">';
								var_dump($_errorMessage);
						echo '</section>';
					echo '</pre>';
                echo '</section> <!-- end.ErrorHandler -->';
            echo '</section> <!-- end.ErrorContainer -->';

			// Unset variables
	        unset( $_memEnd );
            unset( $_memStart );
	        unset( $_memoryUsage );
	        unset( $_bt );
	        unset( $_dt );
            unset( $_errmsg );
            unset( $_filename );
            unset( $_linenum );
            unset( $_callType );
            unset( $_err );
            unset( $_errorMessage );
		}
		else
		{
			// Return
			return false;
		}

	} // End phpError

} // End EXCEPTION_HANDLER


/**
 * Set custom PHP error handler
*/
//set_error_handler( array('EXCEPTION_HANDLER', 'phpError') );
set_error_handler('EXCEPTION_HANDLER::phpError');



