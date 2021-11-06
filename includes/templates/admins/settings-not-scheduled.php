<?php
/**
 *
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<p>
	<?php esc_html_e( 'Not scheduled.', 'ngip' ); ?>
	<?php echo wp_kses(
		__( '<a href="#" id="ngip-activate-db-schedule">Click here</a> to activate DB update schdule now.', 'ngip' ),
		[ 'a' => [ 'id' => true, 'href' => true ] ] ); ?>
</p>
