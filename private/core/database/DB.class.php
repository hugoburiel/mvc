<?php
/**
 * @author Hugo David Buriel-Vasquez
 * @copyright Hugo David Buriel-Vasquez 2016
 * @version 1.0.0
 * TODO: ATOMIC; NEEDS TO BE 4NF+
*/

class DB extends DB_CONFIG
{
    //=============== Properties ===============//

	// General - Do not modify
    private static $_instance  = NULL;
    private static $_insert    = NULL;
    private static $_pdo       = NULL;
    private static $_sql       = NULL;
    private static $_statement = NULL;
    private static $_data      = array();

	// Database/query error handlers - Do not modify
	private static $_error            = NULL;
   	private static $_errorMessage     = array();
	private static $_fileName         = NULL;
	private static $_fileNameSQL      = NULL;
	private static $_fileNamePartsSQL = array();
	private static $_partsSQL0        = NULL;
	private static $_partsSQL1        = NULL;
	private static $_partsSQL2        = NULL;
	private static $_partsSQL3        = NULL;
	private static $_partsSQL4        = NULL;

	// App specific - Can edit
    private static $_value             = NULL;
    private static $_field             = NULL;
    private static $_sitePages         = NULL;
    private static $_nullCheck         = NULL;


    //=============== Methods ===============//

    private function __clone(){} // Prevent object cloning


	/**
	 * Constructor
	*/
    private function __construct()
	{
		try
		{
			// Ensure variable is null
            if ( !self::$_instance )
			{
                self::$_pdo = new PDO(self::$_DSN, self::$_USERNAME, self::$_PASSCODE);
                self::$_pdo-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
		}
        catch ( PDOException $_errorMessage )
		{
            // Database error handler
            return self::dbError( $_errorMessage );
		}

	} // End Constructor


	/**
	 * Establish database connection instance
	*/
    public static function getInstance()
	{
        try
		{
			// If db connection not set
            if ( !isset( self::$_instance ) )
			{
				// Create db connection
				self::$_instance = new DB();
			}

			// Return db connection
            return self::$_instance;
        }
        catch ( PDOException $_errorMessage )
		{
            // Database error handler
            return( self::dbError( $_errorMessage ) );
   		}

    } // End getInstance



/*** ERROR HANDLERS ***********************************************************/

	/**
	 * Database error handler
	*/
	public static function dbError( $_errorMessage )
	{
		if ( true === DEBUG )
		{
		    echo '<section class="ErrorContainer" style="margin:25px; padding:10px;">';
    		    echo '<span class="ErrorToggle" style="	display:block; width:20px; height:20px; color:rgb(255,255,255); text-align:center; background:gray; cursor:pointer;">+</span>';
                echo '<section class="ErrorHandler DatabaseError" style="height:300px; padding:10px; border:6px ridge #888; background:#FDFD9F; overflow-y:scroll;">';
					echo '<h1>Database Connection Error</h1>';
					echo '<pre>';
						echo '<p><strong>Message:</strong>'.$_errorMessage->getMessage().'</p>';
						echo '<p><strong>Code:</strong>'.$_errorMessage->getCode().'</p>';
						echo '<p><strong>File:</strong>'.$_errorMessage->getFile().'</p>';
						echo '<p><strong>Line:</strong>'.$_errorMessage->getLine().'</p>';
						echo '<p><strong>Using Echo:</strong>'.$_errorMessage.'</p>';
						echo '<p><strong>Trace:</strong>';
						print_r($_errorMessage->getTrace());
						echo '</p>';
						echo '<p><strong>Trace as string:</strong>'.$_errorMessage->getTraceAsString().'</p>';
					echo '</pre>';
                echo '</section> <!-- end.ErrorHandler -->';
            echo '</section> <!-- end.ErrorContainer -->';

			// Send email notification
//	        echo (NOTIFY_BWERX == 'Yes') ? mail(EMAIL_TO_BWERX, "Site Errors", $errorMessage->getCode()) : '';
		}
		else
		{
			// Return
			return false;
		}

	} // End dbError


	/**
	 * Query error handler
	 */
	public static function queryError( $_errorMessage )
	{
		if ( true === DEBUG )
		{
		    echo '<section class="ErrorContainer" style="margin:25px; padding:10px;">';
    		    echo '<span class="ErrorToggle" style="	display:block; width:20px; height:20px; color:rgb(255,255,255); text-align:center; background:gray; cursor:pointer;">+</span>';
                echo '<section class="ErrorHandler DatabaseError" style="height:300px; padding:10px; border:6px ridge #888; background:#FDFD9F; overflow-y:scroll;">';
					echo '<h1>Query Error</h1>';
					echo '<pre>';
						echo '<p><strong>Message:</strong>'.$_errorMessage->getMessage().'</p>';
						echo '<p><strong>Code:</strong>'.$_errorMessage->getCode().'</p>';
						echo '<p><strong>File:</strong>'.$_errorMessage->getFile().'</p>';
						echo '<p><strong>Line:</strong>'.$_errorMessage->getLine().'</p>';
						echo '<p><strong>Using Echo:</strong>'.$_errorMessage.'</p>';
						echo '<p><strong>Trace:</strong>';
						print_r($_errorMessage->getTrace());
						echo '</p>';
						echo '<p><strong>Trace as string:</strong>'.$_errorMessage->getTraceAsString().'</p>';
					echo '</pre>';
                echo '</section> <!-- end.ErrorHandler -->';
            echo '</section> <!-- end.ErrorContainer -->';

			// Get everything after last newline (file name)
			$_fileNameSQL = substr( strrchr( $_errorMessage->getFile(), '/' ), 1 );

			// Split file name at every '.' character
			$_fileNamePartsSQL = explode( '.', $_fileNameSQL );

			// Make space for the file name and four additional extensions
			// Check each extension for a value, if none, return empty space
			$_partsSQL0 = ( !isset( $_fileNamePartsSQL[0] ) ) ? '' : $_fileNamePartsSQL[0];
			$_partsSQL1 = ( !isset( $_fileNamePartsSQL[1] ) ) ? '' : $_fileNamePartsSQL[1].' -> ';
			$_partsSQL2 = ( !isset( $_fileNamePartsSQL[2] ) ) ? '' : $_fileNamePartsSQL[2].' -> ';
			$_partsSQL3 = ( !isset( $_fileNamePartsSQL[3] ) ) ? '' : $_fileNamePartsSQL[3].' -> ';
			$_partsSQL4 = ( !isset( $_fileNamePartsSQL[4] ) ) ? '' : $_fileNamePartsSQL[4].' -> ';

			// Make filename and extension(s) uppercase for readability
			$_fileName = ' ===> Check: '.strtoupper( $_partsSQL1.$_partsSQL2.$_partsSQL3.$_partsSQL4.$_partsSQL0 );

			// Display file where error occurred
			//echo $_fileNameSQL;

			// Unset variables
	        unset( $_errorNessage );
            unset( $_fileName );
            unset( $_fileNameSQL );
	        unset( $_fileNamePartsSQL );
	        unset( $_partsSQL0 );
	        unset( $_partsSQL1 );
	        unset( $_partsSQL2 );
	        unset( $_partsSQL3 );
	        unset( $_partsSQL4 );
		}
		else
		{
			// Return
			return false;
		}

	} // End queryError




////////////////////////////////////////////////////////////////////////////////
/*** TODO: MOVE THIS TO ITS OWN CLASS ******************************************/
////////////////////////////////////////////////////////////////////////////////


	/**
	 * Get list of allowed site pages
	*/
	public static function getAllowedPages( $_order = 'DESC' )
	{
        try
		{
			if ( !self::$_sitePages )
			{
				// Structure SQL
				self::$_sql = "
								SELECT
									page_name,
									display,
									display_order
							    FROM
									`allowed_pages`
							    ORDER BY
									page_name " .
									$_order;

				// Prepare SQL
				if( self::$_statement = self::$_pdo->prepare( self::$_sql ) )
				{
					// Execute SQL
					self::$_statement->execute();

					// Retrieve results
					self::$_data = self::$_statement->fetchAll( PDO::FETCH_ASSOC );

					return self::$_data;

				} // End if
			} // End null check

			// Return
			return( self::$_sitePages );
		}
        catch ( PDOException $_errorMessage )
		{
            // Query error handler
            return( self::queryError( $_errorMessage ) );
   		}

	} // End getAllowedPages


	/**
	 * Load Page Data
	*/
	public static function getPageData( $_page )
	{
        try
		{
			if ( !self::$_sitePages )
			{
				// Structure SQL
				self::$_sql = "
								SELECT
									page_id,
									page_name,
									page_type
							    FROM
									`page_data`
								WHERE
									page_name = '".$_page."'";


				// Prepare SQL
				if( self::$_statement = self::$_pdo->prepare( self::$_sql ) )
				{
					// Execute SQL
					self::$_statement->execute();

					// Retrieve results
					self::$_data = self::$_statement->fetchAll( PDO::FETCH_ASSOC );

					return self::$_data;

				} // End if

			}

			// Return
			return( self::$_sitePages );
		}
        catch ( PDOException $_errorMessage )
		{
            // Query error handler
            return( self::queryError( $_errorMessage ) );
   		}

	} // End getPageData

} // End DB