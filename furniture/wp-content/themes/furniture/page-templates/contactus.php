<?php

/***Template Name: contact */
get_header();
?>



<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-xs-12 col-md-offset-2 col-md-8">
				<h3 class="breadcrumb-header">Contact Details</h3>
				<div class="col-md-6 order-md-last d-flex">
					<form action="#" method="post" class="bg-white p-5 contact-form">
						<div class="form-group">
							<input name="name" type="text" class="form-control" placeholder="Your Name">
						</div>
						<div class="form-group">
							<input name="email" type="email" class="form-control" placeholder="Your Email">
						</div>
						<div class="form-group">
							<input name="contact" type="text" class="form-control" placeholder="Your contact">
						</div>
						<div class="form-group">
							<textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
						</div>
						<div class="form-group">
							<input name="submit" type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
						</div>
					</form>

				</div>
			</div>
			<!-- /row -->
		</div>
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- NEWSLETTER -->

<!-- /NEWSLETTER -->
<?php
get_footer();
?>