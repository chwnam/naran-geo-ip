<?php
/**
 * NGIP: Admins IP test yours template
 *
 * @var string $ip
 * @var string $country_code
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<ul class="ngip-result-list">
    <li>
        <span class="ngip-result-label"><?php esc_html_e('IP Address', 'ngip'); ?></span>
        <span class="ngip-result-value"><?php echo esc_html( $ip ); ?></span>
    </li>
    <li>
        <span class="ngip-result-label"><?php esc_html_e('Country Code', 'ngip'); ?></span>
        <span class="ngip-result-value"><?php echo esc_html( $country_code ); ?></span>
    </li>
</ul>
