<?php
/**
 * Add a fixed amount and a percentage to all WooCommerce product prices.
 */

// Ensure WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    // Hook into WooCommerce price retrieval
    add_filter( 'woocommerce_get_price', 'add_fixed_and_percentage_to_product_price', 10, 2 );

    /**
     * Function to add a fixed amount and percentage to product prices.
     *
     * @param float $price Original product price.
     * @param WC_Product $product WooCommerce product object.
     * @return float Modified price with the fixed amount and percentage added.
     */
    function add_fixed_and_percentage_to_product_price( $price, $product ) {
        // Define the fixed amount to add (e.g., 10.00)
        $fixed_amount = 10.00;

        // Define the percentage increase to add (e.g., 15%)
        $percentage_increase = 15; // 15% percentage increase

        // Ensure the price is valid
        if ( is_numeric( $price ) ) {
            // Add the fixed amount to the price
            $price += $fixed_amount;

            // Calculate the percentage increase and add it to the price
            $price += ( $price * ( $percentage_increase / 100 ) );
        }

        return $price;
    }

}
