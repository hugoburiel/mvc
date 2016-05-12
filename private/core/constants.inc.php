<?php
/**
 * @author Hugo David Buriel-Vasquez
 * @copyright Hugo David Buriel-Vasquez 2016
 * @version 1.0.0
*/

################################################################################
############ GLOBAL SERVER VARIABLES ###########################################
################################################################################

// Absolute path to document root; this is public
// e.g. /home/www/webroot
!defined('WEB_ROOT') ? define('WEB_ROOT', $_SERVER['DOCUMENT_ROOT']) : NULL;

// Private root
// e.g. /home/private; this is private
!defined( 'PRIVATE_ROOT' ) ? define( 'PRIVATE_ROOT', dirname(WEB_ROOT) . '/private' ) : NULL;

// Core
// e.g. /home/private/core/
!defined( 'PRIVATE_CORE' ) ? define( 'PRIVATE_CORE ', dirname(WEB_ROOT) . '/private/core') : NULL;

// Core classes
// e.g. /home/private/core/classes/
!defined( 'PRIVATE_CORE_CLASSES' ) ? define( 'PRIVATE_CORE_CLASSES', dirname(WEB_ROOT) . '/private/core/classes' ) : NULL;

// Core utilities
// e.g. /home/private/core/utilities/
!defined( 'PRIVATE_CORE_UTILITIES' ) ? define( 'PRIVATE_CORE_UTILITIES', dirname(WEB_ROOT) . '/private/core/utilities' ) : NULL;

// Core database
// e.g. /home/private/core/database/
!defined( 'PRIVATE_CORE_DATABASE' ) ? define( 'PRIVATE_CORE_DATABASE', dirname(WEB_ROOT) . '/private/core/database' ) : NULL;

// Admin
// e.g. /home/private/admin/
!defined( 'PRIVATE_ADMIN' ) ? define( 'PRIVATE_ADMIN ', dirname(WEB_ROOT) . '/private/admin') : NULL;

// Admin classes
// e.g. /home/private/admin/classes/
!defined( 'PRIVATE_ADMIN_CLASSES' ) ? define( 'PRIVATE_ADMIN_CLASSES', dirname(WEB_ROOT) . '/private/admin/classes' ) : NULL;

// App
// e.g. /home/private/app/
!defined( 'PRIVATE_APP' ) ? define( 'PRIVATE_APP ', dirname(WEB_ROOT) . '/private/app') : NULL;

// App classes
// e.g. /home/private/app/classes/
!defined( 'PRIVATE_APP_CLASSES' ) ? define( 'PRIVATE_APP_CLASSES', dirname(WEB_ROOT) . '/private/app/classes' ) : NULL;

// Error classes
// e.g. /home/private/core/error/
!defined( 'PRIVATE_CORE_ERROR' ) ? define( 'PRIVATE_CORE_ERROR', dirname(WEB_ROOT) . '/private/core/error' ) : NULL;


################################################################################
############ QUERY STRING AND PAGE #############################################
################################################################################

// Page; trailing slash removed from REQUEST_URI; if no value, default to 'home'
!defined('PATH') ? define( 'PATH', trim( parse_url( $_SERVER["REQUEST_URI"], PHP_URL_PATH ), '/' ) ) : NULL;
