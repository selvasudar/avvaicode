<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Adds Thirukural_Widget widget.
 */
class Thirukural_Widget extends WP_Widget
{
	/**
	 * Register widget with WordPress.
	 */
	public function __construct()
	{
		parent::__construct(
			'Thirukural_Widget', // Base ID
			'Thirukural', // Name
			array('description' => __('Display a random Thirukural with a brief explanation in tamil', 'text_domain'))
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		$kural_font_size = (!empty($instance['kural_font_size'])) ? absint($instance['kural_font_size']) : 16;
		if (!$kural_font_size) {
			$kural_font_size = 16;
		}
		$kural_font_size = $kural_font_size . "px";

		$kural_italics = empty($instance['kural_italics']) ? 'normal' : 'italic';

		$kural_bold = empty($instance['kural_bold']) ? 'normal' : 'bold';

		$show_chapter_section = !empty($instance['show_chapter_section']);

		$show_explanation = !empty($instance['show_explanation']);

		$explanation_by = $instance['explanation_by'];

		$explanation_font_size = (!empty($instance['explanation_font_size'])) ? absint($instance['explanation_font_size']) : 16;
		if (!$explanation_font_size) {
			$explanation_font_size = 16;
		}
		$explanation_font_size = $explanation_font_size . "px";

		$explanation_italics = empty($instance['explanation_italics']) ? 'normal' : 'italic';

		$explanation_bold = empty($instance['explanation_bold']) ? 'normal' : 'bold';

		global $wpdb;
		$thirukural_table = $wpdb->prefix . "thirukural";
		$explanation_table = $wpdb->prefix . "thirukural_explanation";

		$kural_id = rand(1, 1330);
		$sqlKural = "SELECT * FROM `" . $thirukural_table . "` WHERE `id` = " . $kural_id;
		$kural = $wpdb->get_row($sqlKural);
		//$kural_array = explode(',', $kural->kural);

		$sqlExplanation = "SELECT `" . $explanation_by . "` FROM `" . $explanation_table . "` WHERE `kural_id` = " . $kural_id;
		$explanation = $wpdb->get_var($sqlExplanation);

		echo $before_widget;
		if ($title) {
			echo $before_title . $title . $after_title;
		}
?>

		<?php if ($show_chapter_section) { ?>
			<div class="row">
				<div class="col-md-6">
					<p>
						<b><?php echo $kural->section_name ?></b>: <?php echo $kural->chapter_name ?>
					</p>
				</div>
			</div>
		<?php } ?>
		<div class="my-20 row kural-wrapper">
			<div class="col-12 kural">
				<?php echo $kural->kural ?>
			</div>
			<div class="col-12 kural-author">
				<strong>திருவள்ளுவர்</strong>
			</div>
		</div>


		<?php if ($show_explanation) { ?>
			<div class="my-20 row kural-explanation-wrapper">
				<div class="col-md-12">
					<b <?php echo "style=\"font-size: " . $explanation_font_size ?>";\">விளக்கம்:</b>
					<div class="kural-explanation" <?php echo "style=\"font-size: " . $explanation_font_size . "; font-weight: " . $explanation_bold . "; font-style:" . $explanation_italics . "; \">" . $explanation ?></div> </div> </div> <?php }
																																																											echo $after_widget;
																																																										}

																																																										/**
																																																										 * Sanitize widget form values as they are saved.
																																																										 *
																																																										 * @see WP_Widget::update()	 *
																																																										 * @param array $new_instance Values just sent to be saved.
																																																										 * @param array $old_instance Previously saved values from database.	 *
																																																										 * @return array Updated safe values to be saved.
																																																										 */
																																																										public function update($new_instance, $old_instance)
																																																										{
																																																											$instance = $old_instance;
																																																											$instance['title'] = sanitize_text_field($new_instance['title']);
																																																											$instance['kural_font_size'] = (int) $new_instance['kural_font_size'];
																																																											$instance['kural_italics'] = !empty($new_instance['kural_italics']) ? 1 : 0;
																																																											$instance['kural_bold'] = !empty($new_instance['kural_bold']) ? 1 : 0;
																																																											$instance['show_chapter_section'] = !empty($new_instance['show_chapter_section']) ? 1 : 0;
																																																											$instance['show_explanation'] = !empty($new_instance['show_explanation']) ? 1 : 0;
																																																											if (in_array($new_instance['explanation_by'], array('kalaignar_version', 'varatharasanar_version', 'solomonpapaiya_version'))) {
																																																												$instance['explanation_by'] = $new_instance['explanation_by'];
																																																											} else {
																																																												$instance['explanation_by'] = 'kalaignar_version';
																																																											}
																																																											$explanation_by = $instance['explanation_by'];
																																																											$instance['explanation_font_size'] = (int) $new_instance['explanation_font_size'];
																																																											$instance['explanation_italics'] = !empty($new_instance['explanation_italics']) ? 1 : 0;
																																																											$instance['explanation_bold'] = !empty($new_instance['explanation_bold']) ? 1 : 0;
																																																											return $instance;
																																																										}

																																																										/**
																																																										 * Outputs the settings form for the Tamil Thirukural widget.
																																																										 *
																																																										 * @see WP_Widget::form()	 *
																																																										 * @param array $instance Saved values from database.	 *
																																																										 */
																																																										public function form($instance)
																																																										{
																																																											//Defaults
																																																											$instance = wp_parse_args((array) $instance, array('explanation_by' => 'kalaignar_version', 'title' => ''));
																																																											$title     = isset($instance['title']) ? esc_attr($instance['title']) : __('திருக்குறள்', 'text_domain');
																																																											$kural_font_size    = isset($instance['kural_font_size']) ? absint($instance['kural_font_size']) : 16;
																																																											$kural_italics = isset($instance['kural_italics']) ? (bool) $instance['kural_italics'] : false;
																																																											$kural_bold = isset($instance['kural_bold']) ? (bool) $instance['kural_bold'] : false;
																																																											$show_chapter_section = isset($instance['show_chapter_section']) ? (bool) $instance['show_chapter_section'] : false;
																																																											$show_explanation = isset($instance['show_explanation']) ? (bool) $instance['show_explanation'] : false;
																																																											$explanation_by = isset($instance['explanation_by']) ? $instance['explanation_by'] : __('கலைஞர் கருணாநிதி', 'text_domain');
																																																											$explanation_font_size = isset($instance['explanation_font_size']) ? $instance['explanation_font_size'] : 16;
																																																											$explanation_italics = isset($instance['explanation_italics']) ? (bool) $instance['explanation_italics'] : false;
																																																											$explanation_bold = isset($instance['explanation_bold']) ? (bool) $instance['explanation_bold'] : false;
																																																												?> <p>
						<label for="<?php echo $this->get_field_id('title'); ?>">
							<?php _e('Widget Title:'); ?>
						</label>
						<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
						</p>

						<p style="background:#f2f2f2">
							<b>Customize Thirukural</b><br />
							<label for="<?php echo $this->get_field_id('kural_font_size'); ?>">
								<?php _e('Font Size(px):'); ?>
							</label>
							<input id="<?php echo $this->get_field_id('kural_font_size'); ?>" name="<?php echo $this->get_field_name('kural_font_size'); ?>" type="number" min="-30" max="100" step="1" value="<?php echo $kural_font_size; ?>" />

							<label for="<?php echo $this->get_field_id('kural_italics'); ?>">
								<?php _e('Italics:'); ?>
							</label>
							<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('kural_italics'); ?>" name="<?php echo $this->get_field_name('kural_italics'); ?>" <?php checked($kural_italics); ?> />

							<label for="<?php echo $this->get_field_id('kural_bold'); ?>">
								<?php _e('Bold:'); ?>
							</label>
							<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('kural_bold'); ?>" name="<?php echo $this->get_field_name('kural_bold'); ?>" <?php checked($kural_bold); ?> />
						</p>

						<p>
							<label for="<?php echo $this->get_field_id('show_chapter_section'); ?>"><?php _e('Show Chapter & Section:'); ?></label>
							<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('show_chapter_section'); ?>" name="<?php echo $this->get_field_name('show_chapter_section'); ?>" <?php checked($show_chapter_section); ?> />
						</p>
						<p>
							<label for="<?php echo $this->get_field_id('show_explanation'); ?>"><?php _e('Show Explanation:'); ?></label>
							<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('show_explanation'); ?>" name="<?php echo $this->get_field_name('show_explanation'); ?>" <?php checked($show_explanation); ?> />
						</p>

						<p>
							<label for="<?php echo $this->get_field_id('explanation_by'); ?>">
								<?php _e('Explanation by:'); ?>
							</label>
							<select name="<?php echo esc_attr($this->get_field_name('explanation_by')); ?>" id="<?php echo esc_attr($this->get_field_id('explanation_by')); ?>" class="widefat">
								<option value="kalaignar_version" <?php selected($instance['explanation_by'], 'kalaignar_version'); ?>><?php _e('டாக்டர் கலைஞர் கருணாநிதி'); ?></option>
								<option value="varatharasanar_version" <?php selected($instance['explanation_by'], 'varatharasanar_version'); ?>><?php _e('டாக்டர் மு.வரதராசனார்'); ?></option>
								<option value="solomonpapaiya_version" <?php selected($instance['explanation_by'], 'solomonpapaiya_version'); ?>><?php _e('பேராசிரியர் சாலமன் பாப்பையா'); ?></option>
							</select>
						</p>

						<p style="background:#f2f2f2">
							<b>Customize Explanation</b><br />
							<label for="<?php echo $this->get_field_id('explanation_font_size'); ?>">
								<?php _e('Font Size(px):'); ?>
							</label>
							<input id="<?php echo $this->get_field_id('explanation_font_size'); ?>" name="<?php echo $this->get_field_name('explanation_font_size'); ?>" type="number" min="-30" max="100" step="1" value="<?php echo $explanation_font_size; ?>" />

							<label for="<?php echo $this->get_field_id('explanation_italics'); ?>">
								<?php _e('Italics:'); ?>
							</label>
							<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('explanation_italics'); ?>" name="<?php echo $this->get_field_name('explanation_italics'); ?>" <?php checked($explanation_italics); ?> />

							<label for="<?php echo $this->get_field_id('explanation_bold'); ?>">
								<?php _e('Bold:'); ?>
							</label>
							<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('explanation_bold'); ?>" name="<?php echo $this->get_field_name('explanation_bold'); ?>" <?php checked($explanation_bold); ?> />
						</p>
				<?php
																																																										}
																																																									}

																																																									// Register Thirukural_Widget widget

																																																									add_action('widgets_init', function () {
																																																										register_widget('Thirukural_Widget');
																																																									});
