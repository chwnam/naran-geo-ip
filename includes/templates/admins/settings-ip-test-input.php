<?php
/**
 * NGIP: Admins IP test input field template.
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<input id="ngip-test-ip-input"
       type="text"
       placeholder="<?php esc_attr_e( 'External IP address', 'ngip' ); ?>">

<button id="ngip-test-ip-query"
        class="button button-secondary"
        type="button"><?php esc_html_e( 'Query', 'ngip' ); ?></button>

<p class="description">
	<?php esc_html_e( 'Test IP address here. Values are not stored.', 'ngip' ); ?>
</p>
