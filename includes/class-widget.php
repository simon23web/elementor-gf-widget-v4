<?php
/**
 * Elementor widget for Gravity Forms.
 *
 * @package ElementorGFWidgetV4
 */

declare(strict_types=1);

namespace TwentyThreeWeb\ElementorGFWidgetV4;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Widget extends Widget_Base {
	/**
	 * Widget name.
	 */
	public function get_name(): string {
		return 'twentythreeweb-gravity-form';
	}

	/**
	 * Widget title.
	 */
	public function get_title(): string {
		return esc_html__( 'Gravity Form Styler', 'elementor-gf-widget-v4' );
	}

	/**
	 * Widget icon.
	 */
	public function get_icon(): string {
		return 'eicon-form-horizontal';
	}

	/**
	 * Widget categories.
	 *
	 * @return string[]
	 */
	public function get_categories(): array {
		return [ 'twentythreeweb' ];
	}

	/**
	 * Widget keywords.
	 *
	 * @return string[]
	 */
	public function get_keywords(): array {
		return [ 'gravity forms', 'gravity form', 'form', '23web' ];
	}

	/**
	 * Frontend style dependencies.
	 *
	 * @return string[]
	 */
	public function get_style_depends(): array {
		return [ 'twentythreeweb-egfw-widget' ];
	}

	/**
	 * Register widget controls.
	 */
	protected function register_controls(): void {
		$this->register_content_controls();
		$this->register_style_controls();
	}

	/**
	 * Content controls.
	 */
	private function register_content_controls(): void {
		$this->start_controls_section(
			'section_form',
			[
				'label' => esc_html__( 'Form', 'elementor-gf-widget-v4' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_id',
			[
				'label'       => esc_html__( 'Form ID', 'elementor-gf-widget-v4' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 1,
				'step'        => 1,
				'description' => esc_html__( 'Enter the Gravity Forms form ID to render.', 'elementor-gf-widget-v4' ),
			]
		);

		$this->add_control(
			'show_title',
			[
				'label'        => esc_html__( 'Show Title', 'elementor-gf-widget-v4' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'elementor-gf-widget-v4' ),
				'label_off'    => esc_html__( 'No', 'elementor-gf-widget-v4' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'show_description',
			[
				'label'        => esc_html__( 'Show Description', 'elementor-gf-widget-v4' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'elementor-gf-widget-v4' ),
				'label_off'    => esc_html__( 'No', 'elementor-gf-widget-v4' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'enable_ajax',
			[
				'label'        => esc_html__( 'Enable AJAX', 'elementor-gf-widget-v4' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'elementor-gf-widget-v4' ),
				'label_off'    => esc_html__( 'No', 'elementor-gf-widget-v4' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'tabindex',
			[
				'label'       => esc_html__( 'Tab Index', 'elementor-gf-widget-v4' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 0,
				'step'        => 1,
				'default'     => 0,
				'description' => esc_html__( 'Leave at 0 to let the browser manage tab order.', 'elementor-gf-widget-v4' ),
			]
		);

		$this->add_control(
			'field_values',
			[
				'label'       => esc_html__( 'Dynamic Field Values', 'elementor-gf-widget-v4' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'description' => esc_html__( 'Use an ampersand-separated query string, for example: email=test@example.com&source=Elementor', 'elementor-gf-widget-v4' ),
			]
		);

		$this->add_control(
			'theme_framework_note',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => esc_html__( 'This widget forces the Gravity Forms Orbital theme so the documented Theme Framework style settings can be applied per form instance.', 'elementor-gf-widget-v4' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Style controls mapped to Gravity Forms documented style keys.
	 */
	private function register_style_controls(): void {
		$this->start_controls_section(
			'section_style_inputs',
			[
				'label' => esc_html__( 'Input Styles', 'elementor-gf-widget-v4' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'input_size',
			[
				'label'   => esc_html__( 'Input Size', 'elementor-gf-widget-v4' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'md',
				'options' => [
					'sm' => esc_html__( 'Small', 'elementor-gf-widget-v4' ),
					'md' => esc_html__( 'Medium', 'elementor-gf-widget-v4' ),
					'lg' => esc_html__( 'Large', 'elementor-gf-widget-v4' ),
				],
			]
		);

		$this->add_control(
			'input_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'elementor-gf-widget-v4' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 40,
					],
				],
			]
		);

		$this->add_control(
			'input_border_color',
			[
				'label' => esc_html__( 'Border Color', 'elementor-gf-widget-v4' ),
				'type'  => Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'input_background_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor-gf-widget-v4' ),
				'type'  => Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'input_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor-gf-widget-v4' ),
				'type'  => Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'input_primary_color',
			[
				'label'       => esc_html__( 'Accent Color', 'elementor-gf-widget-v4' ),
				'type'        => Controls_Manager::COLOR,
				'description' => esc_html__( 'Used by Orbital for active and primary control accents.', 'elementor-gf-widget-v4' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_labels',
			[
				'label' => esc_html__( 'Label Styles', 'elementor-gf-widget-v4' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'label_font_size',
			[
				'label'      => esc_html__( 'Font Size', 'elementor-gf-widget-v4' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 10,
						'max' => 40,
					],
				],
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor-gf-widget-v4' ),
				'type'  => Controls_Manager::COLOR,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_descriptions',
			[
				'label' => esc_html__( 'Description Styles', 'elementor-gf-widget-v4' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_font_size',
			[
				'label'      => esc_html__( 'Font Size', 'elementor-gf-widget-v4' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 10,
						'max' => 32,
					],
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor-gf-widget-v4' ),
				'type'  => Controls_Manager::COLOR,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_buttons',
			[
				'label' => esc_html__( 'Button Styles', 'elementor-gf-widget-v4' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_primary_background_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor-gf-widget-v4' ),
				'type'  => Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'button_primary_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor-gf-widget-v4' ),
				'type'  => Controls_Manager::COLOR,
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render frontend output.
	 */
	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$form_id  = isset( $settings['form_id'] ) ? absint( $settings['form_id'] ) : 0;

		echo '<div class="twentythreeweb-egfw">';

		if ( ! class_exists( 'GFCommon' ) ) {
			echo '<div class="twentythreeweb-egfw__notice">';
			echo esc_html__( 'Gravity Forms is not active. Activate Gravity Forms to render this widget.', 'elementor-gf-widget-v4' );
			echo '</div></div>';
			return;
		}

		if ( $form_id < 1 ) {
			echo '<div class="twentythreeweb-egfw__notice">';
			echo esc_html__( 'Select a valid Gravity Forms form ID in the widget settings.', 'elementor-gf-widget-v4' );
			echo '</div></div>';
			return;
		}

		$attributes = [
			'id'          => (string) $form_id,
			'title'       => ( 'yes' === ( $settings['show_title'] ?? '' ) ) ? 'true' : 'false',
			'description' => ( 'yes' === ( $settings['show_description'] ?? '' ) ) ? 'true' : 'false',
			'ajax'        => ( 'yes' === ( $settings['enable_ajax'] ?? '' ) ) ? 'true' : 'false',
			'theme'       => 'orbital',
		];

		if ( ! empty( $settings['tabindex'] ) ) {
			$attributes['tabindex'] = (string) absint( $settings['tabindex'] );
		}

		if ( ! empty( $settings['field_values'] ) ) {
			$attributes['field_values'] = sanitize_text_field( (string) $settings['field_values'] );
		}

		$styles = $this->build_gravity_forms_styles( $settings );

		if ( ! empty( $styles ) ) {
			$attributes['styles'] = wp_json_encode( $styles );
		}

		$shortcode = $this->build_shortcode( $attributes );

		echo do_shortcode( $shortcode );
		echo '</div>';
	}

	/**
	 * Build Gravity Forms style settings array.
	 *
	 * @param array<string, mixed> $settings Widget settings.
	 * @return array<string, string>
	 */
	private function build_gravity_forms_styles( array $settings ): array {
		$styles = [
			'theme' => 'orbital',
		];

		$map = [
			'input_size'                      => 'inputSize',
			'input_border_color'              => 'inputBorderColor',
			'input_background_color'          => 'inputBackgroundColor',
			'input_color'                     => 'inputColor',
			'input_primary_color'             => 'inputPrimaryColor',
			'label_color'                     => 'labelColor',
			'description_color'               => 'descriptionColor',
			'button_primary_background_color' => 'buttonPrimaryBackgroundColor',
			'button_primary_color'            => 'buttonPrimaryColor',
		];

		foreach ( $map as $control_key => $style_key ) {
			if ( empty( $settings[ $control_key ] ) ) {
				continue;
			}

			$styles[ $style_key ] = sanitize_text_field( (string) $settings[ $control_key ] );
		}

		if ( ! empty( $settings['input_border_radius']['size'] ) ) {
			$styles['inputBorderRadius'] = (string) absint( $settings['input_border_radius']['size'] );
		}

		if ( ! empty( $settings['label_font_size']['size'] ) ) {
			$styles['labelFontSize'] = (string) absint( $settings['label_font_size']['size'] );
		}

		if ( ! empty( $settings['description_font_size']['size'] ) ) {
			$styles['descriptionFontSize'] = (string) absint( $settings['description_font_size']['size'] );
		}

		return $styles;
	}

	/**
	 * Build Gravity Forms shortcode string.
	 *
	 * @param array<string, string> $attributes Shortcode attributes.
	 */
	private function build_shortcode( array $attributes ): string {
		$parts = [];

		foreach ( $attributes as $key => $value ) {
			$clean_value = str_replace( "'", '&#039;', $value );

			$parts[] = sprintf(
				"%s='%s'",
				sanitize_key( $key ),
				$clean_value
			);
		}

		return '[gravityform ' . implode( ' ', $parts ) . ']';
	}
}
