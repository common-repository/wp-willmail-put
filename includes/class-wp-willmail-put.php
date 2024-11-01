<?php
/**
 * WordPress WiLL Mail Put.
 *
 * @since      0.1.0
 * @version    1.0.0
 * @package    wp-willmail-put
 * @subpackage wp-willmail-put
 * @author     1yaan, {@link https://github.com/1yaan https://github.com/1yaan}
 * @copyright  1yaan, {@link https://github.com/1yaan https://github.com/1yaan}
 * @license    GPLv2 or later, {@link https://www.gnu.org/licenses/gpl.html https://www.gnu.org/licenses/gpl.html}
 */

/**
 * Wp_Willmail_Put
 */
class Wp_Willmail_Put {

	/**
	 * Construct.
	 *
	 * @access public
	 * @since  0.1.0
	 */
	public function __construct() {
		// Contact formへのフック.
		add_action( 'wpcf7_submit', array( $this, 'wwp_cf7_submit' ), 10, 2 );
		add_action( 'wpcf7_mail_sent', array( $this, 'wwp_cf7_mail_sent' ), 10, 1 );
	}

	/**
	 * Contact Form 7 のメール送信時に、$_REQUESTのデータをすべてWiLL Mailへ送信する.
	 *
	 * @access public
	 * @since  0.1.0
	 * @param  Object $cf Contact Form クラス.
	 * @return void
	 */
	public function wwp_cf7_mail_sent( $cf ) {
		if ( array_key_exists( 'wwp_mail', $_REQUEST ) ) {
			WWP_Sender::put( $_REQUEST, true );
		}
	}

	/**
	 * Contact Form 7 のsubmit時に、$_REQUESTのデータをすべてWiLL Mailへ送信する.
	 *
	 * @access public
	 * @since  0.1.0
	 * @param  Object $cf     Contact Form クラス.
	 * @param  array  $result Contact Formのレスポンス.
	 * @return void
	 */
	public function wwp_cf7_submit( $cf, $result ) {
		if ( array_key_exists( 'wwp_submit', $_REQUEST ) and ! in_array( 'validation_failed', $result ) ) {
			WWP_Sender::put( $_REQUEST, true );
		}
	}
}
