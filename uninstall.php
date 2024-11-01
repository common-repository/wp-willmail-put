<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @since      0.1.0
 * @version    1.0.0
 * @package    wp-willmail-put
 * @author     1yaan, {@link https://github.com/1yaan https://github.com/1yaan}
 * @copyright  1yaan, {@link https://github.com/1yaan https://github.com/1yaan}
 * @license    GPLv2 or later, {@link https://www.gnu.org/licenses/gpl.html https://www.gnu.org/licenses/gpl.html}
 */

// If uninstall, not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Delete options.
delete_option( 'wp_willmail_put_target_db_id' );
delete_option( 'wp_willmail_put_account_key' );
delete_option( 'wp_willmail_put_api_key' );
