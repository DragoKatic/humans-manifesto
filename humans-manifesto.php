<?php
/**
 * Plugin Name: Humans Manifesto
 * Plugin URI: https://github.com/DragoKatic/humans-manifesto
 * Description: Shows random lines from the Humans Manifesto in the WordPress admin dashboard.
 * Version: 1.0.0
 * Requires at least: 6.8
 * Tested up to: 6.8
 * Requires PHP: 7.4
 * Author: Drago Katić
 * Author URI: https://dragokatic.github.io/
 * License: GPLv2 or later
 * Text Domain: humans-manifesto
 *
 * @package Humans_Manifesto
 */

defined( 'ABSPATH' ) || exit;

function humans_manifesto_get_line() {
	$lines = array(
		__( 'I am active and engaged.', 'humans-manifesto' ),
		__( 'I am aware of my surroundings, and those in my immediate sphere.', 'humans-manifesto' ),
		__( 'I am attentive.', 'humans-manifesto' ),
		__( 'I am focused on the essential, to the exclusion of all else.', 'humans-manifesto' ),
		__( 'I am unsure of the future, but I am not concerned.', 'humans-manifesto' ),
		__( 'I will rely on those closest to me.', 'humans-manifesto' ),
		__( 'I will share their burdens, as they share mine.', 'humans-manifesto' ),
		__( 'I will live.', 'humans-manifesto' ),
		__( 'And I will love.', 'humans-manifesto' ),
	);

	return wptexturize( $lines[ wp_rand( 0, count( $lines ) - 1 ) ] );
}

function humans_manifesto_display() {
	$chosen = humans_manifesto_get_line();
		$data_url = 'data:image/svg+xml;base64,PHN2ZyB2aWV3Qm94PSIwIDAgMTAwMCAxMDAwIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxyZWN0IGZpbGw9IndoaXRlIiB4PSI1MzguNSIgeT0iNDk5LjUiIHdpZHRoPSIyNDkiIGhlaWdodD0iMjQ5Ii8+PHJlY3QgZmlsbD0id2hpdGUiIHg9IjE4Ny41IiB5PSI0NTIuNSIgd2lkdGg9IjI0OSIgaGVpZ2h0PSIyNDkiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0zNDMuNyA1NTguNykgcm90YXRlKC02MCkiLz48cmVjdCBmaWxsPSJ3aGl0ZSIgeD0iNDAyLjUiIHk9IjE3MS41IiB3aWR0aD0iMjQ5IiBoZWlnaHQ9IjI0OSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTc3LjQgMzAzLjE2KSByb3RhdGUoLTMwKSIvPjwvc3ZnPg==';
	printf(
		'<div class="hm-entry">
			<p>
				<img src="%s" alt="Robots Manifesto" class="hm-logo-image">
			</p>
			<span class="screen-reader-text">%s </span>
			<span dir="ltr" class="humans-manifesto-text-line">%s</span>
			<button class="hm-close-btn" title="%s">×</button>
		</div>',
				esc_attr( $data_url ),
		esc_html__( 'Humans Manifesto:', 'humans-manifesto' ),
		esc_html( $chosen ),
		esc_attr__( 'Close', 'humans-manifesto' )
	);
}

function humans_manifesto_assets() {
	wp_enqueue_style(
		'humans-manifesto-style',
		plugin_dir_url( __FILE__ ) . 'assets/css/style.css',
		array(),
		'1.0.0'
	);
	wp_enqueue_script(
		'humans-manifesto-script',
		plugin_dir_url( __FILE__ ) . 'assets/js/script.js',
		array(),
		'1.0.0',
		true
	);
}
add_action( 'admin_enqueue_scripts', 'humans_manifesto_assets' );

function humans_manifesto_load_textdomain() {
// phpcs:ignore PluginCheck.CodeAnalysis.DiscouragedFunctions.load_plugin_textdomainFound	
    load_plugin_textdomain(
        'humans-manifesto',
        false,
        dirname( plugin_basename( __FILE__ ) ) . '/languages/'
    );
}
add_action( 'plugins_loaded', 'humans_manifesto_load_textdomain' );

function humans_manifesto_admin_wrapper() {
	echo '<div id="humans-manifesto-section">';
	humans_manifesto_display();
	echo '</div>';
}
add_action( 'all_admin_notices', 'humans_manifesto_admin_wrapper', 23 );