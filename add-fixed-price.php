<?php
/**
 * Add a fixed amount to all WooCommerce product prices.
 */

// Ensure WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    // Hook into WooCommerce price retrieval
    add_filter( 'woocommerce_get_price', 'add_fixed_amount_to_product_price', 10, 2 );

    /**
     * Function to add a fixed amount to product prices.
     *
     * @param float $price Original product price.
     * @param WC_Product $product WooCommerce product object.
     * @return float Modified price with the fixed amount added.
     */
    function add_fixed_amount_to_product_price( $price, $product ) {
        // Define the fixed amount to add (e.g., 10.00)
        $fixed_amount = 10.00;

        // Ensure the price is valid
        if ( is_numeric( $price ) ) {
            // Add the fixed amount to the price
            $price += $fixed_amount;
        }

        return $price;
    }

}
