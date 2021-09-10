<?php

function workio_child_enqueue_styles() {
	wp_enqueue_style( 'workio-child-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'workio_child_enqueue_styles', 100 );