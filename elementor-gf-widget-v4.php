<?php
/**
 * Plugin Name: 23Web Elementor Gravity Forms Widget V4
 * Plugin URI:  https://www.23web.dev
 * Description: Adds a 23Web Elementor widget for embedding and styling Gravity Forms with the Theme Framework in Elementor's V4 editor.
 * Version:     0.1.0
 * Author:      23Web
 * Author URI:  https://www.23web.dev
 * Text Domain: elementor-gf-widget-v4
 * Requires PHP: 7.4
 * Requires at least: 6.2
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TWENTYTHREEWEB_EGFW_VERSION', '0.1.0' );
define( 'TWENTYTHREEWEB_EGFW_FILE', __FILE__ );
define( 'TWENTYTHREEWEB_EGFW_PATH', plugin_dir_path( __FILE__ ) );
define( 'TWENTYTHREEWEB_EGFW_URL', plugin_dir_url( __FILE__ ) );

require_once TWENTYTHREEWEB_EGFW_PATH . 'includes/class-plugin.php';

\TwentyThreeWeb\ElementorGFWidgetV4\Plugin::instance();
