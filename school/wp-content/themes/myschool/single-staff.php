<?php
get_header();
?>
<?php
global $wp_query;
$postid = $wp_query->post->ID;
$name =  get_post_meta($postid, 'staff_name_meta', true);
$phone_number =  get_post_meta($postid, 'staff_phone_meta', true);
$email_id =  get_post_meta($postid, 'staff_email_meta', true);
$experience =  get_post_meta($postid, 'staff_exp_meta', true);
$qualify =  get_post_meta($postid, 'staff_quali_meta', true);
$bgroup =  get_post_meta($postid, 'staff_blood_meta', true);
$address =  get_post_meta($postid, 'staff_address_meta', true);

?>
<section class="main-post">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="post-title">
                    <h1>
                        <?php the_title(); ?>
                    </h1>
                </div>
                <div class="post-desc">
                    <?php the_excerpt(); ?>
                </div>
                <div class="post-details">
                    <h2>Staff Details</h2>
                    <div class="form-group">
                        <div>
                            <label>Name</label>
                            <h4><?php echo $name; ?></h4>
                        </div>
                        <div>
                            <label>Email</label>
                            <h4><?php echo $email_id; ?></h4>
                        </div>
                        <div>
                            <label>Phone Number</label>
                            <h4><?php echo $phone_number; ?></h4>
                        </div>
                        <div>
                            <label>Experience</label>
                            <h4><?php echo $experience; ?></h4>
                        </div>
                        <div>
                            <label>Qualification</label>
                            <h4><?php echo $qualify; ?></h4>
                        </div>
                        <div>
                            <label>Blood Group</label>
                            <h4><?php echo $bgroup; ?></h4>
                        </div>
                        <div>
                            <label>Address</label>
                            <h4><?php echo $address; ?></h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php
wp_reset_query();
get_footer();
?>