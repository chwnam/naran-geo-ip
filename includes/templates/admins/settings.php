<?php
/**
 * NGIP: admin/settings template.
 *
 * @var string $option_group
 * @var string $page
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="wrap">
    <h1><?php _e( 'Naran GeoIP Settings', 'ngip' ); ?></h1>
    <form action="<?php echo admin_url( 'options.php' ); ?>" method="post">
		<?php
		settings_fields( $option_group );
		do_action( 'ngip_after_settings_fields' );

		do_settings_sections( $page );
		do_action( 'ngip_after_settings_sections' );

		submit_button();
		?>
    </form>
</div>
