<?php
/**
 * NGIP: Next schedule template.
 *
 * @var string $iso_datetime
 * @var string $text
 * @var string $human_diff
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<p>
    <time datetime="<?php echo esc_attr( $iso_datetime ); ?>">
		<?php echo esc_html( $text ); ?>
        (<?php echo esc_html( $human_diff ); ?>)
    </time>
</p>
