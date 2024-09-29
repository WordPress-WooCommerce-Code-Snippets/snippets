<?php

function add_custom_stock_dashboard_widget() {
    wp_add_dashboard_widget(
        'custom_stock_dashboard_widget', // Widget slug
        'Product Stock Overview',        // Title of the widget
        'custom_stock_dashboard_widget_display' // Display callback function
    );
}
add_action( 'wp_dashboard_setup', 'add_custom_stock_dashboard_widget' );

// Callback function to display the widget content
function custom_stock_dashboard_widget_display() {
    // Query to get WooCommerce products
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1, // Get all products
        'post_status' => 'publish',
    );

    $products = new WP_Query( $args );

    if ( $products->have_posts() ) {
        echo '<table class="widefat striped">';
        echo '<thead><tr><th>Product Name</th><th>Quantity in Stock</th></tr></thead>';
        echo '<tbody>';

        while ( $products->have_posts() ) {
            $products->the_post();
            global $product;

            // Get the product object
            $product = wc_get_product( get_the_ID() );

            // Get product stock quantity
            $stock_quantity = $product->get_stock_quantity();

            // Display the product name and stock quantity
            echo '<tr>';
            echo '<td>' . esc_html( get_the_title() ) . '</td>';
            echo '<td>' . ( ! empty( $stock_quantity ) ? esc_html( $stock_quantity ) : 'Out of Stock' ) . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>No products found.</p>';
    }

    // Reset the query
    wp_reset_postdata();
}
