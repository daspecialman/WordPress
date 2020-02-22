<?php
/**
 * Child-Theme functions and definitions
 */
add_action( 'wp_enqueue_scripts', 'buzzstone_child_scripts' );
function buzzstone_child_scripts() {
    wp_enqueue_style( 'buzzstone-parent-style', get_template_directory_uri(). '/style.css' );
}
 
?>

