<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title><?php wp_title(''); ?></title>
	
	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
	<?php wp_head(); ?>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body <?php body_class(); ?>>
	<!-- HEADER -->
	<header>

		<!-- /TOP HEADER -->

		<!-- MAIN HEADER -->
		<div id="header">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- LOGO -->
					<div class="col-md-3">
						<div class="header-logo">
							<a href="#" class="logo">
								<img src="<?php echo IMAGES_URI; ?>/logo.png" alt="">
							</a>
						</div>

					</div>
					<!-- /LOGO -->


					<!-- container -->
					<div class="container">
						<!-- responsive-nav -->
						<div id="responsive-nav">
							<!-- NAV -->
							<ul class="main-nav nav navbar-nav">
								<li class="active"><a href="/homepage">Home</a></li>
								<li><a href="/aboutus">About Us</a></li>
								<li><a href="/product">Products</a></li>
								<li><a href="/contact">Contact</a></li>
							</ul>
							<!-- /NAV -->
						</div>
						<!-- /responsive-nav -->
					</div>
					<!-- /container -->

					

				</div>
				<!-- row -->
			</div>
			<!-- container -->
		</div>
		<!-- /MAIN HEADER -->
	</header>