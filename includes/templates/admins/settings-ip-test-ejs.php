<?php
/**
 * NGIP: Setings IP test EJS
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<# console.log( data ); #>

<li>
    <span class="ngip-result-label"><?php esc_html_e( 'Continent', 'ngip' ); ?></span>
    <span class="ngip-result-value">{{ data.continent.code }}, {{ data.continent.names.en }}</span>
</li>
<li>
    <span class="ngip-result-label"><?php esc_html_e( 'Country', 'ngip' ); ?></span>
    <span class="ngip-result-value">{{ data.country.iso_code }}, {{ data.country.names.en }}</span>
</li>
<li>
    <span class="ngip-result-label"><?php esc_html_e( 'City', 'ngip' ); ?></span>
    <span class="ngip-result-value">{{ data.city.names.en }}</span>
</li>
<li>
    <span class="ngip-result-label"><?php esc_html_e( 'Postal', 'ngip' ); ?></span>
    <span class="ngip-result-value">{{ data.postal.code }}</span>
</li>
<li>
    <span class="ngip-result-label"><?php esc_html_e( 'Location', 'ngip' ); ?></span>
    <span class="ngip-result-value"><?php esc_html_e( 'Lat.', 'ngip' ); ?>
        {{ data.location.latitude }} / <?php esc_html_e( 'Lng.', 'ngip' ); ?>
        {{ data.location.longitude }}</span>
    <span class="ngip-result-value"><a
                href="https://www.google.com/maps/search/?api=1&query=<# print(encodeURIComponent(data.location.latitude + ',' +    data.location.longitude)); #>"
                target="ngip_google_map"><?php esc_html_e( 'Google Map', 'ngip' ); ?></a></span>
</li>
<li>
    <span class="ngip-result-label"><?php esc_html_e( 'Timezone', 'ngip' ); ?></span>
    <span class="ngip-result-value">{{ data.location.time_zone }}</span>
</li>
