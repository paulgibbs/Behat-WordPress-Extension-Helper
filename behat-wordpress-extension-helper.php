<?php
/**
 * Plugin Name: Behat WordPress Extension Helper
 * Description: Helper plugin for the Behat WordPress Extension library.
 * Author: Paul Gibbs
 * Author URI: https://byotos.com/
 * Version: 0.1.0
 * Plugin URI: https://github.com/paulgibbs/behat-wordpress-extension-helper/
 * License: GPL2+
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Modify SQL statements to support transactions.
 *
 * @param string $query
 */
function bweh_create_temporary_tables( $query ) {
	if ( 'CREATE TABLE' === substr( trim( $query ), 0, 12 ) ) {
		return substr_replace( trim( $query ), 'CREATE TEMPORARY TABLE', 0, 12 );

	} elseif ( 'DROP TABLE' === substr( trim( $query ), 0, 10 ) ) {
		return substr_replace( trim( $query ), 'DROP TEMPORARY TABLE', 0, 10 );
	}

	return $query;
}
add_filter( 'query', 'bweh_support_mysql_transactions' );
