<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}
## Database connection
$GLOBALS['TYPO3_CONF_VARS']['DB']['database'] = 'pdPm'; // Your database name, e.g: local-luvwise
$GLOBALS['TYPO3_CONF_VARS']['DB']['host']     = 'localhost'; // Your database host, e.g: localhost
$GLOBALS['TYPO3_CONF_VARS']['DB']['password'] = 'root'; // Your database password, e.g: ess:3
$GLOBALS['TYPO3_CONF_VARS']['DB']['username'] = 'root'; // Your database username, e.g: root
// You may add PHP code here, wich is executed on every request after the configuration is loaded.
// The code here should only manipulate TYPO3_CONF_VARS for example to set the database configuration
// dependent to the requested environment.

?>
