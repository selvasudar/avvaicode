<?php
add_action('add_meta_boxes', 'add_metabox_staff');
add_action('save_post', 'save_staffdetails');

function add_metabox_staff()
{
    add_meta_box("staff-widget", "Staff Details", "staff_callback", "staff", "normal", "high");
}
function staff_callback($post_id)
{

    $current_post = get_post_custom();

?>
    <div class="staffdetails">
        <div class="">
            <label>Name</label>
            <input type="text" name="staffname" value="<?php echo $current_post['staff_name_meta'][0] ?>" />
        </div>
        <div class="">
            <label>Phone Number</label>
            <input type="text" name="phone" value="<?php echo $current_post['staff_phone_meta'][0] ?>" />
        </div>
        <div class="">
            <label>Email</label>
            <input type="text" name="email" value="<?php echo $current_post['staff_email_meta'][0] ?>" />
        </div>
        <div class="">
            <label>Experience</label>
            <input type="text" name="experience" value="<?php echo $current_post['staff_exp_meta'][0] ?>" />
        </div>
        <div class="">
            <label>qualificatoin</label>
            <input type="text" name="qualification" placeholder="M.A, M.phil, Dr" value="<?php echo $current_post['staff_quali_meta'][0] ?>" />
        </div>
        <div class="">
            <label>Blood Group</label>
            <input type="text" name="bgroup" value="<?php echo $current_post['staff_blood_meta'][0] ?>" />
        </div>
        <div class="">
            <label>Photo</label>
            <input type="text" name="staffphoto" value="<?php echo $current_post['staff_photo_meta'][0] ?>" />
        </div>
        <div class="">
            <label>Address</label>
            <input type="text" name="staffaddress" value="<?php echo $current_post['staff_address_meta'][0] ?>" />
        </div>
    </div>
<?php
}
function save_staffdetails($post_id)
{
    global $post;
    $staff_name_meta = isset($_POST['staffname']) ? $_POST['staffname'] : '';
    $staff_phone_meta = isset($_POST['phone']) ? $_POST['phone'] : '';
    $staff_email_meta = isset($_POST['email']) ? $_POST['email'] : '';
    $staff_exp_meta = isset($_POST['experience']) ? $_POST['experience'] : '';
    $staff_quali_meta = isset($_POST['qualification']) ? $_POST['qualification'] : '';
    $staff_blood_meta = isset($_POST['bgroup']) ? $_POST['bgroup'] : '';
    $staff_address_meta = isset($_POST['staffaddress']) ? $_POST['staffaddress'] : '';




    update_post_meta($post_id, 'staff_name_meta', $staff_name_meta);
    update_post_meta($post_id, 'staff_phone_meta', $staff_phone_meta);
    update_post_meta($post_id, 'staff_email_meta', $staff_email_meta);
    update_post_meta($post_id, 'staff_exp_meta', $staff_exp_meta);
    update_post_meta($post_id, 'staff_quali_meta', $staff_quali_meta);
    update_post_meta($post_id, 'staff_blood_meta', $staff_blood_meta);
    update_post_meta($post_id, 'staff_address_meta', $staff_address_meta);
}



/**News and Media Metaboxes */
function add_achievement()
{
    add_meta_box("achievement-widget", "Achievement Details", "achieve_callback", "achievement", "normal", "high");
}

function achieve_callback($post)
{
    wp_nonce_field('global_notice_nonce', 'global_notice_nonce');
    $all_meta_values = get_post_custom($post->ID);
    $ach_name = $all_meta_values['ach_name'][0];
    $ach_std = $all_meta_values['ach_std'][0];
    $ach_theme = $all_meta_values['ach_theme'][0];
?>
    <div class="col-12">
        <label>Name</label>
        <input type="text" placeholder="Name of the Student" name="ach_name" value="<?php echo $ach_name; ?>">
    </div>
    <div>
        <label>Standard</label>
        <input type="text" placeholder="Enter Standard" name="ach_std" value="<?php echo $ach_std; ?>">
    </div>
    <div>
        <label>Theme</label>
        <input type="text" placeholder="Name of Competition" name="ach_theme" value="<?php echo $ach_theme; ?>">
    </div>
<?php
}

function save_achievement($post_id)
{
    $news_link = isset($_POST['news_link']) ? $_POST['news_link'] : '';
    update_post_meta($post_id, 'news_link', $news_link);
}
// add_action('add_meta_boxes', 'add_achievement');
// add_action('save_post', 'save_achievement');
?>