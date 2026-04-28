<?php
/**
 * Plugin bootstrap.
 *
 * @package ElementorGFWidgetV4
 */

declare(strict_types=1);

namespace TwentyThreeWeb\ElementorGFWidgetV4;

use Elementor\Elements_Manager;
use Elementor\Widgets_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Plugin {
	/**
	 * Minimum Elementor version that includes Editor V4 support.
	 */
	private const MINIMUM_ELEMENTOR_VERSION = '3.29.0';

	/**
	 * Minimum PHP version.
	 */
	private const MINIMUM_PHP_VERSION = '7.4';

	/**
	 * Singleton instance.
	 *
	 * @var Plugin|null
	 */
	private static ?Plugin $instance = null;

	/**
	 * Get singleton instance.
	 */
	public static function instance(): Plugin {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	/**
	 * Initialize plugin once WordPress is ready.
	 */
	public function init(): void {
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_elementor' ] );
			return;
		}

		if ( defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		if ( ! class_exists( 'GFCommon' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_gravity_forms' ] );
			return;
		}

		add_action( 'elementor/elements/categories_registered', [ $this, 'register_widget_category' ] );
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'register_assets' ] );
	}

	/**
	 * Register frontend/editor styles.
	 */
	public function register_assets(): void {
		wp_register_style(
			'twentythreeweb-egfw-widget',
			TWENTYTHREEWEB_EGFW_URL . 'assets/css/widget.css',
			[],
			TWENTYTHREEWEB_EGFW_VERSION
		);
	}

	/**
	 * Register custom Elementor category.
	 */
	public function register_widget_category( Elements_Manager $elements_manager ): void {
		$elements_manager->add_category(
			'twentythreeweb',
			[
				'title' => esc_html__( '23Web', 'elementor-gf-widget-v4' ),
				'icon'  => 'fa fa-plug',
			]
		);
	}

	/**
	 * Register Elementor widgets.
	 */
	public function register_widgets( Widgets_Manager $widgets_manager ): void {
		if ( ! class_exists( '\Elementor\Widget_Base' ) || ! class_exists( '\Elementor\Controls_Manager' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_elementor_widget_api' ] );
			return;
		}

		require_once TWENTYTHREEWEB_EGFW_PATH . 'includes/class-widget.php';

		$widgets_manager->register( new Widget() );
	}

	/**
	 * Admin notice for missing Elementor.
	 */
	public function admin_notice_missing_elementor(): void {
		$this->render_admin_notice(
			sprintf(
				/* translators: %s: plugin name */
				esc_html__( '"%s" requires Elementor to be installed and activated.', 'elementor-gf-widget-v4' ),
				esc_html__( '23Web Elementor Gravity Forms Widget V4', 'elementor-gf-widget-v4' )
			)
		);
	}

	/**
	 * Admin notice for missing Gravity Forms.
	 */
	public function admin_notice_missing_gravity_forms(): void {
		$this->render_admin_notice(
			sprintf(
				/* translators: %s: plugin name */
				esc_html__( '"%s" requires Gravity Forms to be installed and activated.', 'elementor-gf-widget-v4' ),
				esc_html__( '23Web Elementor Gravity Forms Widget V4', 'elementor-gf-widget-v4' )
			)
		);
	}

	/**
	 * Admin notice for minimum Elementor version.
	 */
	public function admin_notice_minimum_elementor_version(): void {
		$this->render_admin_notice(
			sprintf(
				/* translators: 1: plugin name, 2: version number */
				esc_html__( '"%1$s" requires Elementor version %2$s or greater.', 'elementor-gf-widget-v4' ),
				esc_html__( '23Web Elementor Gravity Forms Widget V4', 'elementor-gf-widget-v4' ),
				esc_html( self::MINIMUM_ELEMENTOR_VERSION )
			)
		);
	}

	/**
	 * Admin notice for minimum PHP version.
	 */
	public function admin_notice_minimum_php_version(): void {
		$this->render_admin_notice(
			sprintf(
				/* translators: 1: plugin name, 2: version number */
				esc_html__( '"%1$s" requires PHP version %2$s or greater.', 'elementor-gf-widget-v4' ),
				esc_html__( '23Web Elementor Gravity Forms Widget V4', 'elementor-gf-widget-v4' ),
				esc_html( self::MINIMUM_PHP_VERSION )
			)
		);
	}

	/**
	 * Admin notice for incomplete Elementor widget API availability.
	 */
	public function admin_notice_missing_elementor_widget_api(): void {
		$this->render_admin_notice(
			sprintf(
				/* translators: %s: plugin name */
				esc_html__( '"%s" could not access Elementor widget classes during registration. Make sure Elementor is fully up to date and active.', 'elementor-gf-widget-v4' ),
				esc_html__( '23Web Elementor Gravity Forms Widget V4', 'elementor-gf-widget-v4' )
			)
		);
	}

	/**
	 * Output shared admin notice markup.
	 */
	private function render_admin_notice( string $message ): void {
		printf(
			'<div class="notice notice-warning"><p>%s</p></div>',
			wp_kses_post( $message )
		);
	}
}
