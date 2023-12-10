<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="img/favicon.png" type="image/png">
	<title>SteakShop Restaurant</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="vendors/linericon/style.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
	<link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
	<link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
	<link rel="stylesheet" href="vendors/jquery-ui/jquery-ui.css">
	<link rel="stylesheet" href="vendors/animate-css/animate.css">
	<!-- main css -->
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

	<!--================ Start Header Menu Area =================-->
	<div class="menu-trigger">
		<span></span>
		<span></span>
		<span></span>
	</div>
	<?php 
include ("./header.php")
?>
	<!--================ End Header Menu Area =================-->

	<div class="site-main">
		<!--================ Start Home Banner Area =================-->
		<section class="home_banner_area common-banner">
			<div class="banner_inner">
				<div class="container-fluid no-padding">
					<div class="row fullscreen">

					</div>
				</div>
			</div>
		</section>
		<!-- Start banner bottom -->
		<div class="row banner-bottom common-bottom-banner align-items-center justify-content-center">
			<div class="col-lg-8 offset-lg-4">
				<div class="banner_content">
					<div class="row d-flex align-items-center">
						<div class="col-lg-7 col-md-12">
							<h1>Contact Us</h1>
							<p>We are pleased to have you join our Canteen Management System. Your comments, questions, and ideas are extremely valuable to us. Please don't hesitate to get in touch with us by a number of the following methods:</p>
						</div>
						<div class="col-lg-5 col-md-12">
							<div class="page-link-wrap">
								<div class="page_link">
									<a href="index.php">Home</a>
									<a href="contact.php">Contact</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End banner bottom -->
		<!--================ End Home Banner Area =================-->

		<!--================Contact Area =================-->
		<section class="contact_area section_gap">
			<div class="container">
				
				<div class="row">
					<div class="col-lg-6">
					<div class="contact_info">
					<h6>Customer Support</h6>
								<p>We have a committed customer support team available to provide assistance for any inquiries or concerns that you might have. We are available to assist with menu items, order status, and technical inquiries.</p>
						
					</div>		<div class="contact_info">
							
							<div class="info_item">
								<i class="lnr lnr-phone-handset"></i>
								<h6><a href="#">+123-456-7890</a></h6>
								<p>Mon to Fri 9am to 6 pm</p>
							</div>
							<div class="info_item">
								<i class="lnr lnr-envelope"></i>
								<h6><a href="#">support@canteenmanagement.com</a></h6>
								<p>Send us your query anytime!</p>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						
					<h6>FeedBack - message</h6>
					<form class="row contact_form" action="./admin/contactfeedback.php" method="post" id="contactForm" novalidate="novalidate" style="border: 1px solid lightgrey;padding:30px">

					<div class="col-lg-12">
	<div class="form-group">
		<label for="title">Title</label>
		<input type="text" class="form-control" id="title" name="title" placeholder="Enter your title">
	</div>
	<div class="form-group">
		<label for="discription">Description</label>
		<input type="email" class="form-control" id="discription" name="discription" placeholder="Enter description">
	</div>
	<div class="form-group">
		<label for="remark">Remarks</label>
		<input type="text" class="form-control" id="remarks" name="remark" placeholder="Enter remarks">
	</div>

	<button type="submit" value="submit" class="primary-btn text-uppercase">Send FeedBack</button>
					</div>
</form>

					</div>
				</div>
			</div>
		</section>
		<!--================Contact Area =================-->

		<!--================ Start Footer Area =================-->
		<footer class="footer-area overlay">
            <p style="color: white; text-align: center;">Canteen Management System-CMS || Copyright@2023 </p>
        </footer>
		<!--================ Start Footer Area =================-->
	</div>

	<!--================Contact Success and Error message Area =================-->
	<div id="success" class="modal modal-message fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-close"></i>
					</button>
					<h2>Thank you</h2>
					<p>Your message is successfully sent...</p>
				</div>
			</div>
		</div>
	</div>

	<!-- Modals error -->

	<div id="error" class="modal modal-message fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-close"></i>
					</button>
					<h2>Sorry !</h2>
					<p> Something went wrong </p>
				</div>
			</div>
		</div>
	</div>
	<!--================End Contact Success and Error message Area =================-->

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/stellar.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="vendors/lightbox/simpleLightbox.min.js"></script>
	<script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
	<script src="vendors/owl-carousel/owl.carousel.min.js"></script>
	<script src="vendors/jquery-ui/jquery-ui.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="vendors/counter-up/jquery.waypoints.min.js"></script>
	<script src="vendors/counter-up/jquery.counterup.js"></script>
	<script src="js/mail-script.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/theme.js"></script>
</body>

</html>