# 23Web Elementor Gravity Forms Widget V4

WordPress plugin scaffold for a custom Elementor widget that embeds a Gravity Form and styles it with Gravity Forms' Theme Framework.

## What it does

- Registers a `Gravity Form Styler` widget in a `23Web` Elementor category.
- Forces the Gravity Forms `orbital` theme on each widget instance so Theme Framework styling is available.
- Maps Elementor controls to Gravity Forms' documented shortcode `styles` JSON keys:
  - `inputSize`
  - `inputBorderRadius`
  - `inputBorderColor`
  - `inputBackgroundColor`
  - `inputColor`
  - `inputPrimaryColor`
  - `labelFontSize`
  - `labelColor`
  - `descriptionFontSize`
  - `descriptionColor`
  - `buttonPrimaryBackgroundColor`
  - `buttonPrimaryColor`

## Requirements

- WordPress 6.2+
- PHP 7.4+
- Elementor 3.29.0+
- Gravity Forms with the Theme Framework / Orbital theme available

## Installation

1. Place this plugin folder in `wp-content/plugins/`.
2. Activate Elementor and Gravity Forms.
3. Activate `23Web Elementor Gravity Forms Widget V4`.
4. In Elementor, drag in `Gravity Form Styler` from the `23Web` category.
5. Set the Gravity Forms form ID and adjust the style controls.

## Notes

- The widget currently uses a manual `Form ID` field instead of querying Gravity Forms forms in the editor. That keeps the first version dependency-safe and avoids relying on a Gravity Forms admin API surface inside Elementor controls.
- The styling model follows Gravity Forms' documented shortcode and Theme Framework guidance rather than generating ad hoc CSS overrides.

## Reference docs

- Gravity Forms Theme Framework index: <https://docs.gravityforms.com/category/developers/theme-framework/>
- Gravity Forms CSS API: <https://docs.gravityforms.com/css-api/>
- Gravity Forms shortcode parameters and `styles` support: <https://docs.gravityforms.com/gravity-forms-form-shortcode/form_id/>
- Gravity Forms `gform_default_styles` accepted style keys: <https://docs.gravityforms.com/gform_default_styles/>
- Gravity Forms form themes and style settings: <https://docs.gravityforms.com/form-themes-and-style-settings/form-styles/>
- 23Web: <https://www.23web.dev>
