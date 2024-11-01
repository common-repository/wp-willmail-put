<?php
/**
 * This class sends information to WiLLMail.
 *
 * @since      1.0.0
 * @version    1.0.0
 * @package    wp-willmail-put
 * @subpackage wp-willmail-put/includes
 * @author     1yaan, {@link https://github.com/1yaan https://github.com/1yaan}
 * @copyright  1yaan, {@link https://github.com/1yaan https://github.com/1yaan}
 * @license    GPLv2 or later, {@link https://www.gnu.org/licenses/gpl.html https://www.gnu.org/licenses/gpl.html}
 */

/**
 * WWP_Sender
 */
class WWP_Sender {

	/**
	 * Put data into WiLL Mail.
	 *
	 * @access public
	 * @since  1.0.0
	 * @param  array   $body Input fields.
	 * @param  boolean $sanitizable Body fields will sanitaize.
	 * @return array
	 */
	public static function put( $body, $sanitizable = false ) {

		if ( $sanitizable ) {
			self::sanitize_all_field( $body );
		}

		$wp_willmail_put_target_db_id = get_option( 'wp_willmail_put_target_db_id' );
		$wp_willmail_put_account_key  = get_option( 'wp_willmail_put_account_key' );
		$wp_willmail_put_api_key      = get_option( 'wp_willmail_put_api_key' );

		// Request header.
		$auth = base64_encode( $wp_willmail_put_account_key . ':' . $wp_willmail_put_api_key );
		$url  = WWP__WILLMAIL_URL . $wp_willmail_put_account_key . '/' . $wp_willmail_put_target_db_id . '/put';
		$body = json_encode( $body );

		$args = array(
			'method'      => 'POST',
			'body'        => $body,
			'blocking'    => true,
			'sslverify'   => false,
			'httpversion' => '1.0',
			'headers'     => array(
				'Content-Type'  => 'application/json',
				'Authorization' => 'Basic ' . $auth,
			),
		);

		$response = wp_remote_post( $url, $args );

		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			echo "Something went wrong: $error_message";
		}
		return $response;
	} // end put

	/**
	 * Sanitize All Field.
	 *
	 * @param  mixed $args Input fields.
	 * @param  array $allow_html List of allowed HTML elements.
	 * @return void
	 */
	public static function sanitize_all_field( &$args = array(), $allow_html = array() ) {
		if ( is_array( $args ) ) {
			foreach ( $args as $key => $val ) {
				$args[ $key ] = wp_kses( sanitize_text_field( $val ), $allow_html );
			}
		} else {
			$args = wp_kses( sanitize_text_field( $args ) );
		}
	}
}
