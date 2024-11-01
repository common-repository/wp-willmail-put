<?php
/**
 * WP WiLL Mail Put Admin.
 *
 * @since      0.1.0
 * @version    1.0.0
 * @package    wp-willmail-put
 * @subpackage wp-willmail-put/includes
 * @author     1yaan, {@link https://github.com/1yaan https://github.com/1yaan}
 * @copyright  1yaan, {@link https://github.com/1yaan https://github.com/1yaan}
 * @license    GPLv2 or later, {@link https://www.gnu.org/licenses/gpl.html https://www.gnu.org/licenses/gpl.html}
 */

/**
 * WWP_Admin
 */
class WWP_Admin {

	/**
	 * Construct.
	 *
	 * @access public
	 * @since  0.1.0
	 */
	public function __construct() {
		$this->define_admin_hooks();
	}

	/**
	 * Define admin hooks.
	 *
	 * @access private
	 * @since  0.1.0
	 */
	private function define_admin_hooks() {
		add_filter( 'plugin_action_links_' . WWP__PLUGIN_BASENAME, array( $this, 'add_plugin_settings_link' ) );
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );
	}

	/**
	 * Add action links.
	 *
	 * @access public
	 * @since  0.1.0
	 * @param  array $links Plugin index links.
	 * @return array
	 */
	public function add_plugin_settings_link( $links ) {
		$links[] = '<a href="' . admin_url( 'admin.php?page=' . WWP__PLUGIN_NAME ) . '">' . __( 'Settings' ) . '</a>';
		return $links;
	}

	/**
	 * Add plugin admin menu pages.
	 *
	 * @access public
	 * @since  0.1.0
	 * @return void
	 */
	public function add_plugin_admin_menu() {
		// Dashicons https://developer.wordpress.org/resource/dashicons/#external list.
		add_menu_page( 'WP WiLL Mail Put', 'WiLL Mail', 'manage_options', WWP__PLUGIN_NAME, array( $this, 'display_plugin_admin_page' ), 'dashicons-email' );
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @access public
	 * @since  0.1.0
	 * @return void
	 */
	public function display_plugin_admin_page() {
		include_once( WWP__PLUGIN_DIR . 'admin/includes/settings.php' );
	}
}
