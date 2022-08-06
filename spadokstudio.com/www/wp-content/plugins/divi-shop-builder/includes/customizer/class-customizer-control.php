<?php
// Original file: wp-includes/customize/class-wp-customize-date-time-control.php

class AGS_Divi_WC_Customizer_HTML_Control extends WP_Customize_Control {

	/**
	 * Customize control type.
	 *
	 * @since 4.9.0
	 * @var string
	 */
	public $type = 'ags_divi_wc_html';
	
	public $content = '';

	/**
	 * Don't render the control's content - it's rendered with a JS template.
	 *
	 * @since 4.9.0
	 */
	public function render_content() {}

	/**
	 * Export data to JS.
	 *
	 * @since 4.9.0
	 * @return array
	 */
	public function json() {
		$data = parent::json();

		$data['content']          = $this->content;

		return $data;
	}

	/**
	 * Renders a JS template for the content of date time control.
	 *
	 * @since 4.9.0
	 */
	public function content_template() {
		$data          = $this->json();
		?>

		<# _.defaults( data, <?php echo wp_json_encode( $data ); ?> ); #>
		{{ data.content }}
		
		<?php
	}
	
}
