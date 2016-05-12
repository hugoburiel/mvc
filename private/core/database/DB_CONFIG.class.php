<?php
/**
 * @author Hugo David Buriel-Vasquez
 * @copyright Hugo David Buriel-Vasquez 2016
 * @version 1.0.0
*/

class DB_CONFIG
{
	//--------------- DATABASE CREDENTIALS -------------------------------------

    //=============== Properties ===============//

    protected static $_DSN       = "";
    protected static $_USERNAME  = '';
    protected static $_PASSCODE  = '';


    //=============== Methods ===============//

    // Non-implemented
    private function __construct(){} // Prevent direct object creation
    private function __clone(){} // Prevent object cloning
    public function __destruct(){} // Prevent direct object destruction

} // End DB_CONFIG