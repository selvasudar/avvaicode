<?php
/* Template Name: Alumnipage
    */
get_header();
?>
<?php



function insertuser()
{
    global $wpdb;
    $name = $_POST['alumni_name'];
    $email = $_POST['alumni_email'];
    $table_name = $wpdb->prefix . 'alumnidetails';
    $wpdb->insert($table_name, array(
        'name' => $name,
        'email' => $email
    ));
}
if ($_POST['submit']) {
    // insertuser();
    // echo "successfu";
}
?>
<main class="alumnipage">
    <section class="Alumnihero">
        <div class="container">
            <div class="row">
                <div class="col-12 offset-lg-3 col-lg-6">
                    <div class="text-center">
                        <h1>Alumni Registration</h1>
                    </div>
                    <div class="register">
                        <?php if (!$_POST['submit']) { ?>
                            <form method="POST">
                                <div class="form-group">
                                    <label for="exampleInputname">Name</label>
                                    <input required type="text" class="form-control" name="alumni_name" id="exampleInputname">
                                </div>
                                <div class="form-group">
                                    <label for="phonenumber">Phone Number</label>
                                    <input required type="text" class="form-control" name="alumni_phone" id="phonenumber">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputfname">Father's Name</label>
                                    <input type="text" class="form-control" name="alumni_father" id="exampleInputfname">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" name="alumni_email" aria-describedby="emailHelp">
                                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                </div>
                                <div class="form-group">
                                    <div><label>Passed out Standard</label></div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1" name="alumni_pass" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadioInline1">10<sup>th</sup></label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" name="alumni_pass" class="custom-control-input">
                                        <label class="custom-control-label" checked for="customRadioInline2">12<sup>th</sup></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Passed out year</label>
                                    <select class="form-control" name="alumni_year" id="exampleFormControlSelect1">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <!-- <div class="form-group">
                                <label for="pflphoto">Passport Size Photo </label>
                                <input  type="file" class="form-control-file" id="pflphoto">
                            </div> -->
                                <button type="submit" class="btn btn-primary">Register</button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>