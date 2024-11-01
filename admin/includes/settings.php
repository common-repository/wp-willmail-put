<?php
/**
 * WP WiLL Mail Put Settings.
 *
 * @since      0.1.0
 * @version    1.0.0
 * @package    wp-willmail-put
 * @subpackage wp-willmail-put/includes
 * @author     1yaan, {@link https://github.com/1yaan https://github.com/1yaan}
 * @copyright  1yaan, {@link https://github.com/1yaan https://github.com/1yaan}
 * @license    GPLv2 or later, {@link https://www.gnu.org/licenses/gpl.html https://www.gnu.org/licenses/gpl.html}
 */

$wp_willmail_put_target_db_id = get_option( 'wp_willmail_put_target_db_id' );
$wp_willmail_put_account_key  = get_option( 'wp_willmail_put_account_key' );
$wp_willmail_put_api_key      = get_option( 'wp_willmail_put_api_key' );
$wwp_test                     = '';

?>
<div class="wrap">
<form action="" method="post">
<?php
// おまじない.
wp_nonce_field( 'wp-willmail-put-settings', 'wwp-nonce' );
?>
	<h1 class-"wp-heading-inline">WP WiLL Mail Put</h1>
	<?php
	if ( ! empty( $_POST ) and check_admin_referer( 'wp-willmail-put-settings', 'wwp-nonce' ) ) {
		$validation_errors = array();
		if ( array_key_exists( 'wp_willmail_put_target_db_id', $_POST ) and is_numeric( $_POST['wp_willmail_put_target_db_id'] ) ) {
			$wp_willmail_put_target_db_id = sanitize_text_field( $_POST['wp_willmail_put_target_db_id'] );
			update_option( 'wp_willmail_put_target_db_id', $wp_willmail_put_target_db_id );
		} else {
			$validation_errors['wp_willmail_put_target_db_id'] = '入力値に誤りがあります.';
		}
		if ( array_key_exists( 'wp_willmail_put_account_key', $_POST ) and ctype_alnum( $_POST['wp_willmail_put_account_key'] ) ) {
			$wp_willmail_put_account_key = sanitize_text_field( $_POST['wp_willmail_put_account_key'] );
			update_option( 'wp_willmail_put_account_key', $wp_willmail_put_account_key );
		} else {
			$validation_errors['wp_willmail_put_account_key'] = '入力値に誤りがあります.';
		}
		if ( array_key_exists( 'wp_willmail_put_api_key', $_POST ) and ctype_alnum( $_POST['wp_willmail_put_api_key'] ) ) {
			$wp_willmail_put_api_key = sanitize_text_field( $_POST['wp_willmail_put_api_key'] );
			update_option( 'wp_willmail_put_api_key', $wp_willmail_put_api_key );
		} else {
			$validation_errors['wp_willmail_put_api_key'] = '入力値に誤りがあります.';
		}

		$wwp_test    = sanitize_text_field( $_POST['wp_willmail_put_test'] );
		$button_name = sanitize_text_field( $_POST['Submit'] );

		if ( 'Post' == $button_name and ! empty( $wwp_test ) ) {
			$wwp_test_put = array_values( array_filter( array_map( 'trim', explode( "\n", $wwp_test ) ), 'strlen' ) );
			if ( 2 == count( $wwp_test_put ) ) {
				$wwp_test_put = array_combine( explode( ',', $wwp_test_put[0] ), explode( ',', $wwp_test_put[1] ) );
				$response     = WWP_Sender::put( $wwp_test_put, true );
				echo <<<EOD
<div class="updated fade">
	<p><strong>テストに成功しました。WiLL Mailにログインして、データが登録されていることをご確認ください。
			重複したデータを入力した場合は、データは上書きされます。</strong></p>
</div>
EOD;
			} else {
				$validation_errors['wp_willmail_put_test'] = 'データの入力に誤りがあります。ご確認ください。.';
			}
		}

		if ( count( $validation_errors ) > 0 ) {
			foreach ( $validation_errors as $key => $em ) {
				echo <<<EOD
<div class="error"><p>{$key}:<strong>{$em}</strong></p></div>
EOD;
			}
		} else {
			echo <<<EOD
<div class="updated fade"><p><strong>設定が保存されました。</strong></p></div>
EOD;
		}
	}
	?>
	<p>
		WP WiLL Mail Putは、Contact Form 7で作成した登録フォームの情報を使って、WiLL MailのターゲットDBへ情報を登録するプラグインです.<br>
		詳しい説明は<a href="https://1yaan.github.io/wp-willmail-put/" target="_blank">こちら</a>をご確認ください。
	</p>
	<hr class="wp-header-end">

	<div id="poststuff" class="metabox-holder has-right-sidebar">
		<div id="side-info-column" class="inner-sidebar">
			<div id="side-sortables" class="meta-box-sortables ui-sortable">
				<div class="postbox ">
					<h2><span>このプラグインについて</span></h2>
					<div class="inside">
						<div class="submitbox">
							<div>
								<dl>
									<dt>使い方の説明<dt>
									<dd><a href="https://1yaan.github.io/wp-willmail-put/" target="_blank">GitHub Page</a></dd>
									<dt>ソースコード<dt>
									<dd><a href="https://github.com/1yaan/wp-willmail-put" target="_blank">wp-willmail-put</a></dd>
									<dt>Travis CI</dt>
									<dd><a href="https://travis-ci.org/1yaan/wp-willmail-put" target="_blank">wp-willmail-put</a></dd>
								</dl>
								<div class="clear"></div>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>

				<div id="contacttagsdiv" class="postbox ">
					<h2><span>PR</span></h2>
					<div class="inside">
						<div class="tagsdiv" id="flamingo_contact_tag">
							<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
							<!-- github-docs -->
							<ins class="adsbygoogle"
									style="display:block"
									data-ad-client="ca-pub-0119304545599366"
									data-ad-slot="8330348600"
									data-ad-format="auto"></ins>
							<script>
							(adsbygoogle = window.adsbygoogle || []).push({});
							</script>
						</div>
					</div>
				</div><!-- #contacttagsdiv -->
			</div><!-- #side-sortables -->
		</div><!-- #side-info-column -->

		<div id="post-body">
			<div id="post-body-content">
				<div id="normal-sortables">
					<div id="contactnamediv" class="postbox ">
						<h2><span>キーの設定</span></h2>
						<div class="inside content">
							<?php
							echo <<<EOD
<table class="form-table">
	<tr valign="top">
		<th><label for="wp_willmail_put_target_db_id">ターゲットDB ID</label></th>
		<td><input type="text" name="wp_willmail_put_target_db_id" value="{$wp_willmail_put_target_db_id}" class="regular-text"></td>
	</tr>
	<tr valign="top">
		<th><label for="wp_willmail_put_account_key">アカウントキー</label></th>
		<td><input type="text" name="wp_willmail_put_account_key" value="{$wp_willmail_put_account_key}" class="regular-text"></td>
	</tr>
	<tr valign="top">
		<th><label for="wp_willmail_put_api_key">API キー</label></th>
		<td><input type="text" name="wp_willmail_put_api_key" value="{$wp_willmail_put_api_key}" class="regular-text"></td>
	</tr>
</table>
EOD;
?>
							<input type="submit" name="Submit" class="button-primary" value="Settings">

							<br>
							<br>
							<hr>
							<br>
						</div>

						<h2><span>【上級者向け】お試し送信</span></h2>
						<div class="inside content">
							<p>
								WiLL Mailへきちんと接続できているのか、お試し用のフォームを用意しました。下のフィールドへCSV形式でターゲットDBへ送信する内容を入力し、送信ボタンを押してください。<br>
								1列目がキー（フィールド名）、2列目が値（これから入力してもらうデータ）を入力してください。<br>
								例）<br>
								email,prefecture,tel,name<br>
								test@example.jp,東京都,00-0000-0000,田中太郎<br>
							</p>
				<?php
				echo <<<EOD
<textarea name="wp_willmail_put_test" style="width:100%;height:100px;">{$wwp_test}</textarea>
EOD;
?>
							<h4>注意</h4>
							<ul>
								<li>データの構造（JSONオブジェクト構造）については、API情報の"データベースAPI情報"を参照ください。送信できるデータは1つのみです。</li>
								<li>送信データに空白を含めることはできません。空白はプログラム内で除去されます。</li>
							</ul>

							<input type="submit" name="Submit" class="button-primary" value="Post">
						</div>

						<br>
						<br>
						<hr>
						<br>

						<h2><span>設定方法</span></h2>
						<div class="inside content">
							<ol>
								<li><a href="https://willap.jp/login?wordpres-plugin=wp-willmail-put" target="_blank">WiLL Cloud ログイン</a>より、ログインしてください。</li>
								<li>まずはメニューの「データベース」から、「データベース設計」を選択してください。</li>
								<li>"ターゲットDB"を作成ください。ご不明点はWiLL Mailのサポートセンターへどうぞ！ターゲットDBのIDを以下のフォームへ設定してください。</li>
								<li>次にメニューの「アカウント」から、「API情報」を選択してください。</li>
								<li>API情報画面にて表示される"アカウントキー"と"APIキー"を以下のフォームへ設定してください。</li>
								<li>
									次に、<a href="https://contactform7.com/" target="_blank">Contact Form 7</a>でフォームを作ります。
									フォームの各項目の名前を先ほど作ったデータベースの項目のJSONフィールド名と同じにしてください。<br>
									項目のJSONフィールド名は、API情報画面の"データベースAPI情報"に表示される"JSONフィールド情報"を見てください。</li>
								<li>
									フォームの中に"[hidden wwp_mail]"もしくは"[hidden wwp_submit]"を設定します。この項目を設定することで、当プラグインは動きます。<br>
									"[hidden wwp_mail]"を設定した場合は、Contact Form 7がメールを送信するときに、WiLL Mailへputします。<br>
									"[hidden wwp_submit]"を設定した場合は、Contact Form 7で作ったフォームで、送信ボタンを押した処理の最後にWiLL Mailへputします。<br>
									今のところ、2つの違いは特にありません！
								</li>
								<li>これで準備完了です。</li>
							</ol>
						</div>
					</div>
				</div>
				<div id="advanced-sortables" class="meta-box-sortables ui-sortable"></div>
		</div><!-- #post-body-content -->
	</div>
</form>
</div>
