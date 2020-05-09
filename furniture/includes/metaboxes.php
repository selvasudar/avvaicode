<?php

/**Metaboxes related to whitepaper starts****/
function add_metabox_whitepaper()
{
	add_meta_box("whitepaper-widget", "White Paper Action", "whitepaper_callback", "whitepaper", "normal", "high");

	add_meta_box("whitepaper-widget", "Squad Selection", "add_whitepaper_squad", "whitepaper", "normal", "high");
}
function add_whitepaper_squad()
{
	$squad_arr = array("partners", "school", "soln", "process", "digital", "case", "project", "collaboration", "hr", "procurement", "finance", "brand");
	$post_id = get_post_custom($post->ID);
	$squad_value = isset($post_id['squad_val']) ? $post_id['squad_val'][0] : "brand";
	$head_val = isset($post_id['header_val']) ? $post_id['header_val'][0] : "brand";
	$foot_val = isset($post_id['footer_val']) ? $post_id['footer_val'][0] : "brand";

?>
	<div>
		<label for='squad_val'>Squad:</label>
		<select name='squad_val' id='squad_val'>
			<?php
			foreach ($squad_arr as $value) {
				if ($squad_value == $value) {
					echo '<option selected value= ' . $value . '>' . ucfirst($value) . '</option>';
				} else {
					echo '<option value= ' . $value . '>' . ucfirst($value) . '</option>';
				}
			}
			?>

		</select>
	</div>
	<div>
		<label for='head_squad'>Header Type:</label>
		<select name='head_squad' id='head_squad'>
			<?php
			foreach ($squad_arr as $value) {
				if ($head_val == $value) {
					echo '<option selected value= ' . $value . '>' . ucfirst($value) . '</option>';
				} else {
					echo '<option value= ' . $value . '>' . ucfirst($value) . '</option>';
				}
			}
			?>
		</select>
	</div>
	<div>
		<label for='foot_squad'>Footer Type:</label>
		<select name='foot_squad' id='foot_squad'>
			<?php
			foreach ($squad_arr as $value) {
				if ($foot_val == $value) {
					echo '<option selected value= ' . $value . '>' . ucfirst($value) . '</option>';
				} else {
					echo '<option value= ' . $value . '>' . ucfirst($value) . '</option>';
				}
			}
			?>
		</select>
	</div>
<?php
}
function whitepaper_callback($post)
{
	wp_nonce_field('global_notice_nonce', 'global_notice_nonce');


	// wp_nonce_field(plugin_basename(__FILE__), 'wp_custom_attachment_nonce');

	$html = '<p class="description">';
	$html .= 'Upload your PDF here.';
	$html .= '</p>';
	$html .= '<input type="file" id="wp_custom_attachment" name="wp_custom_attachment" value="" size="25" />';

	echo $html;


	$all_meta_values = get_post_custom($post->ID);
	$whitepaper_img = $all_meta_values['white_img_meta'][0];
	$title = $all_meta_values['white_title_meta'][0];
	$description = $all_meta_values['white_desc_meta'][0];
	$icon1 = $all_meta_values['white_icon1_meta'][0];
	$text1 = $all_meta_values['white_text1_meta'][0];
	$icon2 = $all_meta_values['white_icon2_meta'][0];
	$text2 = $all_meta_values['white_text2_meta'][0];
	$icon3 = $all_meta_values['white_icon3_meta'][0];
	$text3 = $all_meta_values['white_text3_meta'][0];
	$pdf_file = $all_meta_values['wp_custom_attachment'][0];
	echo $pdf_file;

	echo '<table><tbody><tr><td>Title:</td><td><input type="text" name="white_title" value="' . $title . '"></td></tr>';
	echo '<tr><td>Description:</td><td><input type="text" name="desc" value="' . $description . '"><td></tr>';
	echo '<tr><td>Whitepaper Image:</td><td><input type="text" name="white_image" value="' . $whitepaper_img . '"><td></tr>';
	// print_r($whitepaper_img);
	echo '<tr><td>Insight Text 1:</td><td><input type="text" name="text1" value="' . $text1 . '"><td></tr>';
	echo '<tr><td>Insight Icon 1:</td><td><input type="text" name="icon1" value="' . $icon1 . '"><td></tr>';
	echo '<tr><td>Insight Text 2:</td><td><input type="text" name="text2" value="' . $text2 . '"><td></tr>';
	echo '<tr><td>Insight Icon 2:</td><td><input type="text" name="icon2" value="' . $icon2 . '"><td></tr>';
	echo '<tr><td>Insight Text 3:</td><td><input type="text" name="text3" value="' . $text3 . '"><td></tr>';
	echo '<tr><td>Insight Icon 3:</td><td><input type="text" name="icon3" value="' . $icon3 . '"><td></tr>';
	echo '</tbody></table>';
}
function save_whitepaper_box_callback($post_id)
{
	$white_img_meta = isset($_POST['white_image']) ? $_POST['white_image'] : '';
	$white_title_meta = isset($_POST['white_title']) ? $_POST['white_title'] : '';
	$white_desc_meta = isset($_POST['desc']) ? $_POST['desc'] : '';
	$white_text1_meta = isset($_POST['text1']) ? $_POST['text1'] : '';
	$white_text2_meta = isset($_POST['text2']) ? $_POST['text2'] : '';
	$white_text3_meta = isset($_POST['text3']) ? $_POST['text3'] : '';
	$white_icon1_meta = isset($_POST['icon1']) ? $_POST['icon1'] : '';
	$white_icon2_meta = isset($_POST['icon2']) ? $_POST['icon2'] : '';
	$white_icon3_meta = isset($_POST['icon3']) ? $_POST['icon3'] : '';

	/* --- security verification --- */
	// Make sure the file array isn't empty
	if (!empty($_FILES['wp_custom_attachment']['name'])) {

		// Setup the array of supported file types. In this case, it's just PDF.
		$supported_types = array('application/pdf');

		// Get the file type of the upload
		$arr_file_type = wp_check_filetype(basename($_FILES['wp_custom_attachment']['name']));
		$uploaded_type = $arr_file_type['type'];

		// Check if the type is supported. If not, throw an error.
		if (in_array($uploaded_type, $supported_types)) {

			// Use the WordPress API to upload the file
			$upload = wp_upload_bits($_FILES['wp_custom_attachment']['name'], null, file_get_contents($_FILES['wp_custom_attachment']['tmp_name']));

			if (isset($upload['error']) && $upload['error'] != 0) {
				// echo "<script>console.log('ERR');</script>";
				wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
			} else {
				// echo "<script>console.log('working');</script>";
				add_post_meta($post_id, 'wp_custom_attachment', $upload);
				update_post_meta($post_id, 'wp_custom_attachment', $upload['url']);
			} // end if/else

		} else {
			wp_die("The file type that you've uploaded is not a PDF.");
		} // end if/else

	} // end if

	update_post_meta($post_id, 'white_img_meta', $white_img_meta);
	update_post_meta($post_id, 'white_title_meta', $white_title_meta);
	update_post_meta($post_id, 'white_desc_meta', $white_desc_meta);
	update_post_meta($post_id, 'white_text1_meta', $white_text1_meta);
	update_post_meta($post_id, 'white_text2_meta', $white_text2_meta);
	update_post_meta($post_id, 'white_text3_meta', $white_text3_meta);
	update_post_meta($post_id, 'white_icon1_meta', $white_icon1_meta);
	update_post_meta($post_id, 'white_icon2_meta', $white_icon2_meta);
	update_post_meta($post_id, 'white_icon3_meta', $white_icon3_meta);
	// update_post_meta( $post_id, 'wp_custom_attachment', $upload); 
}

add_action('add_meta_boxes', 'add_metabox_whitepaper');
add_action('save_post', 'save_whitepaper_box_callback');

function fileupload_metabox_header()
{

?>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('form#post').attr('enctype', 'multipart/form-data');
			jQuery('form#post').attr('encoding', 'multipart/form-data');
		});
	</script>
<?php
}
add_action('admin_head', 'fileupload_metabox_header');
/**Metaboxes related to whitepaper ends****/

/**Metaboxes related to enable/disable post starts****/
function add_metabox_post_cta_widget()
{
	add_meta_box("cta-widget", "Enable Call To Action", "enable_post_cta_widget", "post", "normal", "high");
}


function enable_post_cta_widget()
{
	global $post;
	$check = get_post_custom($post->ID);
	//print_r($check);
	$checked_value = isset($check['post_cta_widget']) ? esc_attr($check['post_cta_widget'][0]) : 'no';
	$cta_widget_option = isset($check['post_cta_widget_option']) ? esc_attr($check['post_cta_widget_option'][0]) : 'green';

	$cta_widget_title = isset($check['post_cta_widget_title']) ? $check['post_cta_widget_title'][0] : 'READY TO START CRUSHING YOUR CHAOS?';
	$cta_widget_btn_text = isset($check['post_cta_widget_button_text']) ? $check['post_cta_widget_button_text'][0] : 'JOIN NOW';
?>

	<label for="post_cta_widget">Enable CTA Widget:</label>
	<input type="checkbox" name="post_cta_widget" id="post_cta_widget" <?php if ($checked_value == "yes") {
																			echo "checked=checked";
																		} ?>>
	<p><em>( Check to enable Call-TO-Action form at footer. )</em></p>

	<label for="post_cta_widget_type">Choose CTA Widget Type:</label>
	<select name="post_cta_widget_type" id="post_cta_widget_type">
		<option value="green" <?php if ($cta_widget_option == "green") echo 'selected="selected"'; ?>>Green</option>
	</select>
	<p><em>( Choose Signup form color varitions. )</em></p>

	<label for="post_cta_widget_title">CTA Title:</label>
	<input type="text" name="post_cta_widget_title" id="post_cta_widget_title" value="<?php if (!empty($cta_widget_title)) {
																							echo $cta_widget_title;
																						} ?>">
	<p><em>( Check to enable Call-TO-Action form at footer. )</em></p>

	<label for="post_cta_widget_button_text">CTA Button Text:</label>
	<input type="text" name="post_cta_widget_button_text" id="post_cta_widget_button_text" value="<?php if (!empty($cta_widget_btn_text)) {
																										echo $cta_widget_btn_text;
																									} ?>">
	<p><em>( Check to enable Call-TO-Action form at footer. )</em></p>
<?php
}

/**Save the Enable/Disable sidebar meta box value*/
function save_metabox_post_cta_widget($post_id)
{
	// Bail if we're doing an auto save
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

	// if our current user can't edit this post, bail
	if (!current_user_can('edit_post')) return;

	$checked_value = isset($_POST['post_cta_widget']) ? 'yes' : 'no';
	$cta_widget_option = isset($_POST['post_cta_widget_option']) ? $_POST['post_cta_widget_option'][0] : 'green';
	$cta_widget_title = isset($_POST['post_cta_widget_title']) ? $_POST['post_cta_widget_title'] : 'READY TO START CRUSHING YOUR CHAOS?';
	$cta_widget_btn_text = isset($_POST['post_cta_widget_button_text']) ? $_POST['post_cta_widget_button_text'] : 'JOIN NOW';

	update_post_meta($post_id, 'post_cta_widget', $checked_value);
	update_post_meta($post_id, 'post_cta_widget_option', $cta_widget_option);
	update_post_meta($post_id, 'post_cta_widget_title', $cta_widget_title);
	update_post_meta($post_id, 'post_cta_widget_button_text', $cta_widget_btn_text);
}

add_action('admin_init', 'add_metabox_post_cta_widget');
add_action('save_post', 'save_metabox_post_cta_widget');

/**Metaboxes related to enable/disable post ends****/

/**Metaboxes for Affix Banner starts*****/
add_action('admin_init', 'add_metabox_post_banner_image_widget');
add_action('save_post', 'save_metabox_post_banner_image_widget');
function add_metabox_post_banner_image_widget()
{
	add_meta_box("banner_image", "Blog Sidebar Settings:", "enable_post_banner_image_widget", "post", "normal", "high");
}

function enable_post_banner_image_widget()
{
	global $post;

	$image = get_post_custom($post->ID);
	$checked_value = isset($image['post_banner_affix']) ? esc_attr($image['post_banner_affix'][0]) : 'no';
	$banner_image_src = $image['post_banner_image_src'][0];
	$banner_image_link = $image['post_banner_image_link'][0];
	$banner_image_alt = $image['post_banner_image_alt'][0];

	$blog_template = get_post_meta(get_the_ID(), "kissflow_seperate_template", true);
?>

	<label for="blog_template">Blog Template:</label>
	<select name="blog_template" id="blog_template">
		<option value="">Full Width</option>
		<option <?php if ($blog_template == "/page-templates/content-sidebar.php") echo "selected" ?> value="/page-templates/content-sidebar.php">Sidebar</option>
	</select>
	<p><em>Default: Full width</em></p>

	<label for="post_banner_image_src">Banner Image Url:</label>
	<input type="text" name="post_banner_image_src" id="post_banner_image_src" value="<?php if ($banner_image_src != '') { echo $banner_image_src;} ?>">
	<p><em>Example: https://kissflow.com/wp-content/uploads/2016/06/google-apps.jpg</em></p>
	<label for="post_banner_image_link">Banner Image Link:</label>
	<input type="text" name="post_banner_image_link" id="post_banner_image_link" value="<?php if ($banner_image_link != '') { echo $banner_image_link; } ?>">
	<p><em>Example: https://kissflow.com/wp-content/uploads/2016/06/google-apps.jpg</em></p>
	<label for="post_banner_image_alt">Banner Image Alt Text: </label>
	<input type="text" name="post_banner_image_alt" id="post_banner_image_alt" value="<?php if ($banner_image_alt != '') { echo $banner_image_alt; } ?>">
	<p><em>Example: Workflow for Google Apps</em></p>
	<label for="post_banner_image_affix">Affix this banner: </label>
	<input type="checkbox" id="post_banner_affix" name="post_banner_affix" <?php if ($checked_value == "yes") {
																				echo "checked=checked";
																			} ?>>
<?php
}
function save_metabox_post_banner_image_widget($post_id)
{
	// Bail if we're doing an auto save
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

	// if our current user can't edit this post, bail
	if (!current_user_can('edit_post')) return;

	$banner_image_src = isset($_POST['post_banner_image_src']) ? $_POST['post_banner_image_src'] : '';
	$banner_image_link = isset($_POST['post_banner_image_link']) ? $_POST['post_banner_image_link'] : '';
	$banner_image_alt = isset($_POST['post_banner_image_alt']) ? $_POST['post_banner_image_alt'] : '';
	$checked_value = isset($_POST['post_banner_affix']) ? 'yes' : 'no';
	$kissflow_seperate_template  = isset($_POST['blog_template']) ? $_POST['blog_template'] : '';
	update_post_meta($post_id, 'post_banner_image_src', $banner_image_src);
	update_post_meta($post_id, 'post_banner_image_link', $banner_image_link);
	update_post_meta($post_id, 'post_banner_image_alt', $banner_image_alt);
	update_post_meta($post_id, 'post_banner_affix', $checked_value);
	update_post_meta($post_id, 'kissflow_seperate_template', $kissflow_seperate_template);
}
/**Metaboxes for Affix Banner ends*****/
/**Metaboxes for Careers page starts**/
//TODO:
/**Metaboxes for Careers page ends**/
/**Metaboxes for success stories starts**/
function add_metabox_success_stories()
{
	add_meta_box("squad_success-stories-widget", "Squad Selection", "squad_scs_stories", "success-stories", "normal", "high");
	add_meta_box("success-stories-widget", "Success Stories Action", "country_meta_box_callback", "success-stories", "normal", "high");
}
function squad_scs_stories($post)
{
	$squad_arr = array("partners", "school", "soln", "process", "digital", "case", "project", "collaboration", "hr", "procurement", "finance", "brand");
	$post_id = get_post_custom($post->ID);
	$squad_value = isset($post_id['squad_val']) ? $post_id['squad_val'][0] : "brand";
	$head_val = isset($post_id['header_val']) ? $post_id['header_val'][0] : "brand";
	$foot_val = isset($post_id['footer_val']) ? $post_id['footer_val'][0] : "brand";
?>
	<div>
		<label for='squad_val'>Squad:</label>
		<select name='squad_val' id='squad_val'>
			<?php
			foreach ($squad_arr as $value) {
				if ($squad_value == $value) {
					echo '<option selected value= ' . $value . '>' . ucfirst($value) . '</option>';
				} else {
					echo '<option value= ' . $value . '>' . ucfirst($value) . '</option>';
				}
			}
			?>

		</select>
	</div>
	<div>
		<label for='head_squad'>Header Type:</label>
		<select name='head_squad' id='head_squad'>
			<?php
			foreach ($squad_arr as $value) {
				if ($head_val == $value) {
					echo '<option selected value= ' . $value . '>' . ucfirst($value) . '</option>';
				} else {
					echo '<option value= ' . $value . '>' . ucfirst($value) . '</option>';
				}
			}
			?>
		</select>
	</div>
	<div>
		<label for='foot_squad'>Footer Type:</label>
		<select name='foot_squad' id='foot_squad'>
			<?php
			foreach ($squad_arr as $value) {
				if ($foot_val == $value) {
					echo '<option selected value= ' . $value . '>' . ucfirst($value) . '</option>';
				} else {
					echo '<option value= ' . $value . '>' . ucfirst($value) . '</option>';
				}
			}
			?>
		</select>
	</div>
	<?php
}
function country_meta_box_callback($post)
{
	wp_nonce_field('global_notice_nonce', 'global_notice_nonce');

	$value = get_post_meta($post->ID, 'country_meta', True);

	$all_meta = get_all_meta_values('country_meta', 'success-stories', 'publish');
	$all_meta_values = get_post_custom($post->ID);
	$country_val = $all_meta_values['country_meta'][0];
	// print_r($country_val);
	$industry_val = $all_meta_values['industry_meta'][0];
	$brand_logo = $all_meta_values['blogo_meta'][0];
	$brand_name = $all_meta_values['bname_meta'][0];
	$brand_image = $all_meta_values['bimage_meta'][0];
	$brand_title = $all_meta_values['btitle_meta'][0];
	$emp_count = $all_meta_values['employee_count_meta'][0];
	$apps_count = $all_meta_values['apps_count_meta'][0];
	$quote_title = $all_meta_values['quote_title_meta'][0];
	$quote_text = $all_meta_values['quote_text_meta'][0];
	// echo $brand_logo;
	// print_r($all_meta);
	// echo '<input style="width:25%" id="country_meta" name="country_meta" value="">';
	$country_list = array("Asia Pacific", "North America", "South America / LATAM", "Africa", "Europe", "Middle East", "United Kingdom");
	$industry_list = array("Manufacturing", "Education", "Consumer Goods", "Telecom & Media", "Non Profit", "Construction", "Logistics", "Agriculture", "Financial Services", "Religious Organization", "Human Resources", "Health Care", "Internet - Digital & Creative", "IT - Software & Hardware", "Tourism & Travel", "Government & Defence", "Energy - Oil & Gas", "Jewelry", "Automotive");

	echo '<table><tbody><tr><td>Country:</td><td><select multiple="multiple" name="country_meta[]">';
	$selected = "selected";
	$not_selected = "";
	foreach ($country_list as $key => $value)
		// if ($value == explode(",",$country_val)) {
		if (in_array($value, explode(",", $country_val))) {
			echo '<option selected value="' . $value . '" >' . $value . '</option>';
		} else {
			echo '<option value="' . $value . '">' . $value . '</option>';
		}
	echo '</select></td></tr>';
	echo '<tr><td>Industry: <td><select name="industry_meta[]" multiple="multiple">';
	foreach ($industry_list as $industry_list_key => $industry_list_value) {
		if (in_array($industry_list_value, explode(",", $industry_val))) {
			echo '<option selected value="' . $industry_list_value . '">' . $industry_list_value . '</option>';
		} else {
			echo '<option value="' . $industry_list_value . '">' . $industry_list_value . '</option>';
		}
	}
	echo '</select></td></tr><tr><td>Brand Logo URL:</td>&nbsp;<td><input type="text" name="brand_logo" value="' . $brand_logo . '"><td></tr>';
	echo '</select></td></tr><tr><td>Brand Name:</td>&nbsp;<td><input type="text" name="brand_name" value="' . $brand_name . '""><td></tr>';
	echo '<tr><td>Brand Image URL:&nbsp;</td><td><input type="text" name="brand_image" value="' . $brand_image . '"></td></tr>';
	echo '<tr><td>Brand Title:&nbsp;</td><td><input maxlength="50" type="text" name="brand_title" value="' . $brand_title . '"></td></tr>';
	echo '<tr><td>Employee count:&nbsp;</td><td><input type="text" name="emp_count" value="' . $emp_count . '"></td></tr>';
	echo '<tr><td>Apps count:&nbsp;</td><td><input type="text" name="apps_count" value="' . $apps_count . '"></td></tr>';
	echo '<tr><td> Quote Author:&nbsp;</td><td><input maxlength="50" type="text" name="quote_title" value="' . $quote_title . '"></td></tr>';
	echo '<tr><td>Quote Text:&nbsp;</td><td><textarea name="quote_text">' . $quote_text . '</textarea></td></tr></tbody></table>';
}
function save_country_meta_box_callback($post_id)
{

	$country_meta = isset($_POST['country_meta']) ? esc_attr($_POST['country_meta']) : '';
	$industry_meta = isset($_POST['industry_meta']) ? $_POST['industry_meta'] : '';
	$blogo_meta = isset($_POST['brand_logo']) ? $_POST['brand_logo'] : '';
	$bname_meta = isset($_POST['brand_name']) ? $_POST['brand_name'] : '';
	$bimage_meta = isset($_POST['brand_image']) ? $_POST['brand_image'] : '';
	$btitle_meta = isset($_POST['brand_title']) ? $_POST['brand_title'] : '';
	$employee_count_meta = isset($_POST['emp_count']) ? $_POST['emp_count'] : '';
	$apps_count_meta = isset($_POST['apps_count']) ? $_POST['apps_count'] : '';
	$quote_title_meta = isset($_POST['quote_title']) ? $_POST['quote_title'] : '';
	$quote_text_meta = isset($_POST['quote_text']) ? $_POST['quote_text'] : '';
	// update_post_meta( $post_id, 'country_meta', $_POST['country_meta']);
	// rtrim(implode(',', $_POST['country_meta']), ',');

	// update_post_meta($post_id, 'country_meta', rtrim(implode(',', $_POST['country_meta']), ','));
	// update_post_meta($post_id, 'industry_meta', rtrim(implode(',', $_POST['country_meta']), ','));
	update_post_meta($post_id, 'blogo_meta', $blogo_meta);
	update_post_meta($post_id, 'bname_meta', $bname_meta);
	update_post_meta($post_id, 'bimage_meta', $bimage_meta);
	update_post_meta($post_id, 'btitle_meta', $btitle_meta);
	update_post_meta($post_id, 'employee_count_meta', $employee_count_meta);
	update_post_meta($post_id, 'apps_count_meta', $apps_count_meta);
	update_post_meta($post_id, 'quote_title_meta', $quote_title_meta);
	update_post_meta($post_id, 'quote_text_meta', $quote_text_meta);
}
function get_all_meta_values($key = '', $type, $status = 'publish')
{

	global $wpdb;

	if (empty($key))
		return;

	$r = $wpdb->get_col($wpdb->prepare("
	        SELECT distinct(pm.meta_value) FROM {$wpdb->postmeta} pm
	        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
	        WHERE pm.meta_key = '%s' 
	        AND p.post_status = '%s' 
	        AND p.post_type = '%s'
	    ", $key, $status, $type));
	return $r;
}
function get_single_post_meta_values($key = '', $type, $status = 'publish', $pid)
{

	global $wpdb;

	if (empty($key))
		return;

	$r = $wpdb->get_col($wpdb->prepare("
	        SELECT distinct(pm.meta_value) FROM {$wpdb->postmeta} pm
	        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
	        WHERE pm.meta_key = '%s' 
	        AND p.post_status = '%s' 
	        AND p.post_type = '%s'
	        AND p.ID = '%s'
	    ", $key, $status, $type, $pid));
	return $r;
}

function implement_ajax()
{
	if (isset($_POST['country_sel'])) {
		$single_brandlogo_meta = get_all_meta_values('blogo_meta', 'success-stories', 'publish');
		$query = new WP_Query(array('post_type' => 'success-stories', 'meta_key' => 'country_meta', 'meta_value' => $_POST["country_sel"], 'meta_compare' => 'LIKE'));

		while ($query->have_posts()) : $query->the_post();
			$single_brandlogo_meta = get_single_post_meta_values('blogo_meta', 'success-stories', 'publish', get_the_ID());
	?>
			<div class="col-sm-4">
				<div class="hover-sec">
					<div class="thumbs">
						<div class="inner">
							<a target="blank" href="<?php the_permalink(); ?>">
								<img src="<?php echo $single_brandlogo_meta[0]; ?>" />
							</a>
						</div>
					</div>
					<div class="title">
						<div class="inner">
							<a target="_blank" href="<?php the_permalink(); ?>" title="View Case Study">
								<h4><?php the_title() ?></h4>
								<span>View Case Study</span>
							</a>
						</div>
					</div>
				</div>
			</div>

		<?php
		endwhile;
		wp_die('');
	} else if (isset($_POST['industry_sel'])) {
		$single_brandlogo_meta = get_all_meta_values('blogo_meta', 'success-stories', 'publish');
		$query = new WP_Query(array('post_type' => 'success-stories', 'meta_key' => 'industry_meta', 'meta_value' => $_POST["industry_sel"], 'meta_compare' => 'LIKE'));


		while ($query->have_posts()) : $query->the_post();
			$single_brandlogo_meta = get_single_post_meta_values('blogo_meta', 'success-stories', 'publish', get_the_ID());
		?>
			<div class="col-sm-4">
				<div class="hover-sec">
					<div class="thumbs">
						<div class="inner">
							<a target="blank" href="<?php the_permalink() ?>">
								<img src="<?php echo $single_brandlogo_meta[0]; ?>" />
							</a>
						</div>
					</div>
					<div class="title">
						<div class="inner">
							<a target="_blank" href="<?php the_permalink(); ?>" title="View Case Study">
								<h4><?php the_title() ?></h4>
								<span>View Case Study</span>
							</a>
						</div>
					</div>
				</div>
			</div>

		<?php
		endwhile;
		wp_die('');
	} else {
		$single_brandlogo_meta = get_all_meta_values('blogo_meta', 'success-stories', 'publish');
		$query = new WP_Query(array('post_type' => 'success-stories', 'posts_per_page' => -1));

		while ($query->have_posts()) : $query->the_post();
			$single_brandlogo_meta = get_single_post_meta_values('blogo_meta', 'success-stories', 'publish', get_the_ID());
		?>
			<div class="col-sm-4">
				<div class="hover-sec">
					<div class="thumbs">
						<div class="inner">
							<a target="blank" href="<?php the_permalink() ?>">
								<img src="<?php echo $single_brandlogo_meta[0]; ?>" />
							</a>
						</div>
					</div>
					<div class="title">
						<div class="inner">
							<a target="_blank" href="<?php the_permalink(); ?>" title="View Case Study">
								<h4><?php the_title() ?></h4>
								<span>View Case Study</span>
							</a>
						</div>
					</div>
				</div>
			</div>
	<?php
		endwhile;

		wp_die('');
	}
}

add_action('add_meta_boxes', 'add_metabox_success_stories');
add_action('save_post', 'save_country_meta_box_callback');

add_action('wp_ajax_success_story_ajax', 'implement_ajax');
add_action('wp_ajax_nopriv_success_story_ajax', 'implement_ajax'); //for users that are not logged in.	
/**Metaboxes for success stories ends**/

/*** Metaboxes for Squad Selection starts**/
add_action('admin_init', 'squad_init');
add_action('save_post', 'save_squad');

function squad_init()
{
	add_meta_box("squad-widget", "Squad Mapping", "enable_squad", "post", "normal", "high");
	add_meta_box("squad-widget", "Squad Mapping", "enable_squad", "page", "normal", "high");
}
function enable_squad()
{
	$squad_arr = array("partners", "school", "soln", "process", "digital", "case", "project", "collaboration", "hr", "procurement", "finance", "brand");
	$post_id = get_post_custom($post->ID);
	$squad_value = isset($post_id['squad_val']) ? $post_id['squad_val'][0] : "brand";
	$head_val = isset($post_id['header_val']) ? $post_id['header_val'][0] : "brand";
	$foot_val = isset($post_id['footer_val']) ? $post_id['footer_val'][0] : "brand";

	?>
	<div>
		<label for='squad_val'>Squad:</label>
		<select name='squad_val' id='squad_val'>
			<?php
			foreach ($squad_arr as $value) {
				if ($squad_value == $value) {
					echo '<option selected value= ' . $value . '>' . ucfirst($value) . '</option>';
				} else {
					echo '<option value= ' . $value . '>' . ucfirst($value) . '</option>';
				}
			}
			?>

		</select>
	</div>
	<div>
		<label for='head_squad'>Header Type:</label>
		<select name='head_squad' id='head_squad'>
			<?php
			foreach ($squad_arr as $value) {
				if ($head_val == $value) {
					echo '<option selected value= ' . $value . '>' . ucfirst($value) . '</option>';
				} else {
					echo '<option value= ' . $value . '>' . ucfirst($value) . '</option>';
				}
			}
			?>
		</select>
	</div>
	<div>
		<label for='foot_squad'>Footer Type:</label>
		<select name='foot_squad' id='foot_squad'>
			<?php
			foreach ($squad_arr as $value) {
				if ($foot_val == $value) {
					echo '<option selected value= ' . $value . '>' . ucfirst($value) . '</option>';
				} else {
					echo '<option value= ' . $value . '>' . ucfirst($value) . '</option>';
				}
			}
			?>
		</select>
	</div>

<?php
}
function save_squad()
{
	global $post;
	$post_id = get_post_custom($post->ID);
	$squad_value = $_POST['squad_val'];
	$head_val = $_POST['head_squad'];
	$foot_val = $_POST['foot_squad'];

	update_post_meta($post->ID, 'squad_val',  $squad_value);
	update_post_meta($post->ID, 'header_val', $head_val);
	update_post_meta($post->ID, 'footer_val', $foot_val);
}
/*** Metaboxes for Squad Selection ends**/

// Category page Content Editor - Murali - 15 May

function cat_edit($term)
{
	$term_id = $term->term_id;
	$term_meta = get_option("taxonomy_$term_id");
?>
	<tr class="form-field">
		<th scope="row">
			<label for="term_meta"><?php echo _e('Category Content') ?></label>
		<td>
			<textarea style="display: none;" id="catg-content" rows="15" cols="15" name="term_meta"><?php echo $term_meta; ?></textarea>
			<?php
			$settings = array('textarea_name' => 'term_meta', 'textarea_cols' => 70, 'editor_css' => '<style>#catg-content.wp-editor-area{width:100% !important;}</style>');
			$editor_id = 'catg-content';
			wp_editor(stripslashes($term_meta), $editor_id, $settings);
			?>
		</td>
		</th>
	</tr>
<?php
}

add_action('category_edit_form_fields', 'cat_edit');

// save_tax_meta

function cat_save($term_id)
{
	if (isset($_POST['term_meta'])) {
		// Be careful with the intval here. If it's text you could use sanitize_text_field()
		$term_meta = isset($_POST['term_meta']) ? $_POST['term_meta'] : '';

		// Save the option.
		update_option("taxonomy_$term_id", $term_meta);
	}
}

add_action('edited_category', 'cat_save', 10, 2);


// Category Sidebar
function cat_sidebar_edit($term)
{
	$term_id = $term->term_id;
	$term_meta = get_option("taxonomy_sidebar_$term_id");
	$squad_meta = get_option("cat_edit_squad_val_$term_id");
	$header_meta =  get_option("cat_edit_header_val_$term_id");
	$footer_meta =  get_option("cat_edit_footer_val_$term_id");
?>
	<tr class="form-field squad-description-wrap">
		<th scope="row"><label for="description"><?php _e('Squad Mapping'); ?></label></th>
		<td>
			<?php
			$squad_arr = array("partners", "school", "soln", "process", "case", "project", "digital", "collaboration", "hr", "procurement", "finance", "brand");
			?>
			<div>
				<label for='cat_edit_squad_val'>Squad:</label>
				<select name='cat_edit_squad_val' id='cat_edit_squad_val'>
					<?php

					foreach ($squad_arr as $value) {
						if ($squad_meta == $value) {
							echo '<option selected value= ' . $value . '>' . ucfirst($value) . '</option>';
						} else {
							echo '<option value= ' . $value . '>' . ucfirst($value) . '</option>';
						}
					}
					?>

				</select>
			</div>
			<div>
				<label for='cat_edit_head_squad'>Header Type:</label>
				<select name='cat_edit_head_squad' id='cat_edit_head_squad'>
					<?php
					foreach ($squad_arr as $value) {
						if ($header_meta == $value) {
							echo '<option selected value= ' . $value . '>' . ucfirst($value) . '</option>';
						} else {
							echo '<option value= ' . $value . '>' . ucfirst($value) . '</option>';
						}
					}
					?>
				</select>
			</div>
			<div>
				<label for='cat_edit_foot_squad'>Footer Type:</label>
				<select name='cat_edit_foot_squad' id='cat_edit_foot_squad'>
					<?php
					foreach ($squad_arr as $value) {
						if ($footer_meta == $value) {
							echo '<option selected value= ' . $value . '>' . ucfirst($value) . '</option>';
						} else {
							echo '<option value= ' . $value . '>' . ucfirst($value) . '</option>';
						}
					}
					?>
				</select>
			</div>

		</td>
	</tr>
	<tr class="form-field">
		<th scope="row">
			<label for="term_meta"><?php echo _e('Category Sidebar') ?></label>
		<td>
			<textarea style="display: none;" id="catg-side-content" rows="15" cols="15" name="side_term_meta"><?php echo $term_meta; ?></textarea>
			<?php
			$settings = array('textarea_name' => 'side_term_meta', 'textarea_cols' => 70, 'editor_css' => '<style>#catg-side-content.wp-editor-area{width:100% !important;}</style>');
			$editor_id = 'catg-content';
			wp_editor(stripslashes($term_meta), $editor_id, $settings);
			?>
		</td>
		</th>
	</tr>

<?php
}
add_action('category_edit_form_fields', 'cat_sidebar_edit');


function cat_sidebar_save($term_id)
{
	if (isset($_POST['side_term_meta'])) {
		// Be careful with the intval here. If it's text you could use sanitize_text_field()
		$term_meta = isset($_POST['side_term_meta']) ? $_POST['side_term_meta'] : '';

		// Save the option.
		update_option("taxonomy_sidebar_$term_id", $term_meta);
	}

	// Be careful with the intval here. If it's text you could use sanitize_text_field()
	$squad_meta_val = isset($_POST['cat_edit_squad_val']) ? $_POST['cat_edit_squad_val'] : 'brand';
	$header_meta_val = isset($_POST['cat_edit_head_squad']) ? $_POST['cat_edit_head_squad'] : 'brand';
	$footer_meta_val = isset($_POST['cat_edit_foot_squad']) ? $_POST['cat_edit_foot_squad'] : 'brand';
	// Save the option.
	update_option("cat_edit_squad_val_$term_id", $squad_meta_val);
	update_option("cat_edit_header_val_$term_id", $header_meta_val);
	update_option("cat_edit_footer_val_$term_id", $footer_meta_val);
}

add_action('edited_category', 'cat_sidebar_save', 10, 2);


/***Careers Custom fields and Metaboxes ***/
function add_careers_box()
{
	add_meta_box("career-widget", "Career Section", "career_callback", "careers", "normal", "high");
}

function career_callback($post)
{
	wp_nonce_field('global_notice_nonce', 'global_notice_nonce');


	$all_meta_values = get_post_custom($post->ID);
	$career_location = $all_meta_values['career_location'][0];
	$career_experience = $all_meta_values['career_experience'][0];

	echo '<table><tbody><tr><td>Job Location:</td><td><input type="text" name="career_location" value="' . $career_location . '"></td></tr>';
	echo '<tr><td>Job Experience:</td><td><input type="text" name="career_experience" value="' . $career_experience . '"><td></tr>';
	echo '</tbody></table>';
}

function save_careers_box($post_id)
{
	$career_experience = isset($_POST['career_experience']) ? $_POST['career_experience'] : '';
	$career_location = isset($_POST['career_location']) ? $_POST['career_location'] : '';

	update_post_meta($post_id, 'career_location', $career_location);
	update_post_meta($post_id, 'career_experience', $career_experience);
}

add_action('add_meta_boxes', 'add_careers_box');
add_action('save_post', 'save_careers_box');

/**News and Media Metaboxes */
function add_news_box()
{
	add_meta_box("news-widget", "News and Media Section", "news_callback", "news-media", "normal", "high");
}

function news_callback($post)
{
	wp_nonce_field('global_notice_nonce', 'global_notice_nonce');
	$all_meta_values = get_post_custom($post->ID);
	$news_link = $all_meta_values['news_link'][0];

	echo '<table><tbody><tr><td>News Link</td><td><input type="text" name="news_link" value="' . $news_link . '"></td></tr>';
	echo '</tbody></table>';
}

function save_news_box($post_id)
{
	$news_link = isset($_POST['news_link']) ? $_POST['news_link'] : '';
	update_post_meta($post_id, 'news_link', $news_link);
}
add_action('add_meta_boxes', 'add_news_box');
add_action('save_post', 'save_news_box');
?>