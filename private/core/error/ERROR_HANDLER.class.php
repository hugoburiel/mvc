<?php
/**
 * @author Hugo David Buriel-Vasquez
 * @copyright Hugo David Buriel-Vasquez 2016
 * @version 1.0.0
*/


/**
 * @namespace
 */
namespace FRAMEWORK\CORE\ERROR;


/**
 * Error handler for uncaught errors
 *
*/
class ERROR_HANDLER extends Exception
{
    //=============== Properties ===============//

	// General - Do not modify
	private static $_dt          = null;
	private static $_errno       = null;
	private static $_err         = array();
	private static $_errortype   = array();
	private static $_errmsg      = null;
	private static $_filename    = null;
	private static $_linenum     = null;
	private static $_vars        = null;

	// App specific - Can edit


    //=============== Methods ===============//

    // Non-implemented
//    final private function __construct(){} // Prevent direct object creation
//    final private function __clone(){} // Prevent object cloning
//    final public function __destruct(){} // Prevent direct object destruction


	/**
	 * Default error handler
	 */
    public static function errorHandler($_errno, $_errmsg, $_filename, $_linenum, $_vars)
	{
		if ( true === DEBUG )
		{
            // Date/Time stamp for error entry
            $_dt = date("Y-m-d H:i:s (T)");

            // Assoc array of error string
            $_errortype = array (
                                    E_ERROR              => 'Error',
                                    E_WARNING            => 'Warning',
                                    E_PARSE              => 'Parsing Error',
                                    E_NOTICE             => 'Notice',
                                    E_CORE_ERROR         => 'Core Error',
                                    E_CORE_WARNING       => 'Core Warning',
                                    E_COMPILE_ERROR      => 'Compile Error',
                                    E_COMPILE_WARNING    => 'Compile Warning',
                                    E_USER_ERROR         => 'User Error',
                                    E_USER_WARNING       => 'User Warning',
                                    E_USER_NOTICE        => 'User Notice',
                                    E_STRICT             => 'Runtime Notice',
                                    E_RECOVERABLE_ERROR  => 'Catchable Fatal Error'
                                );
            // Set of errors for which a var trace will be saved.
            $_userErrors = array(
                                    E_ERROR,
                                    E_WARNING,
                                    E_PARSE,
                                    E_NOTICE,
                                    E_CORE_ERROR,
                                    E_CORE_WARNING,
                                    E_COMPILE_ERROR,
                                    E_COMPILE_WARNING,
                                    E_USER_ERROR,
                                    E_USER_WARNING,
                                    E_USER_NOTICE,
                                    E_STRICT,
                                    E_RECOVERABLE_ERROR
                                );

		    $_err = '<section class="ErrorContainer">';
    		    $_err .= '<span class="ErrorToggle">+</span>';
                $_err .= '<section class="ErrorHandler">';
                    $_err .= '<h1>Default Error Nandler</h1>';
                    $_err .= '<pre>';
                        $_err .= "<errorentry>\n";
                        $_err .= "\t<datetime>" . $_dt . "</datetime>\n";
                        $_err .= "\t<errornum>" . $_errno . "</errornum>\n";
                        $_err .= "\t<errortype>" . $_errortype[$_errno] . "</errortype>\n";
                        $_err .= "\t<errormsg>" . $_errmsg . "</errormsg>\n";
                        $_err .= "\t<scriptname>" . $_filename . "</scriptname>\n";
                        $_err .= "\t<scriptlinenum>" . $_linenum . "</scriptlinenum>\n";

//            if (in_array($_errno, $_userErrors))
//            {
//                $_err .= "\t<vartrace>" . wddx_serialize_value($_vars, "Variables") . "</vartrace>\n";
//            }
                        $_err .= "</errorentry>\n\n";
                    $_err .= "</pre>\n\n";
                $_err .= "</section> <!-- end.ErrorHandler -->\n\n";
            $_err .= "</section> <!-- end.ErrorContainer -->\n\n";

            // Display errors
             echo $err;

            // Save to custom error log and send e-mail.
            //error_log($err, 3, "/usr/local/php4/error.log");
//            if ($errno == E_USER_ERROR) {
//                mail(BWERX_EMAIL, "Site Errors", $err);
//            }

			// Unset variables
	        unset( $_dt );
            unset( $_errno );
            unset( $_errmsg );
            unset( $_filename );
            unset( $_linenum );
            unset( $_vars );
            unset( $_err );
		}
		else
		{
			// Return
			return false;
		}

	} // End errorHandler

} // End ERROR_HANDLER


/**
 * Default error handler
*/
//set_error_handler('DEFAULT_ERROR_HANDLER::errorHandler');
//set_error_handler(array(new DEFAULT_ERROR_HANDLER(),'errorHandler'));

//set_error_handler(array("DEFAULT_ERROR_HANDLER", "errorHandler"), E_ALL);