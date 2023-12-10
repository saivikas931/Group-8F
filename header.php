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

	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>

	<!--================ Start Header Menu Area =================-->
	<div class="menu-trigger">
		<span></span>
		<span></span>
		<span></span>
	</div>
	<header class="fixed-menu">
		<span class="menu-close"><i class="fa fa-times"></i></span>
		<div class="menu-header">
			<div class="logo d-flex justify-content-center">
				<img src="img/lo.png" alt="" style="height:150px">
			</div>
		</div>
		<div class="nav-wraper">
			<div class="navbar">
				<ul class="navbar-nav">
					<li class="nav-item"><a class="nav-link " href="home.php"><img src="img/header/nav-icon1.png" alt=""> home</a></li>
					<li class="nav-item"><a class="nav-link" href="about-us.php"><img src="img/header/nav-icon2.png" alt="">about</a></li>
					<li class="nav-item"><a class="nav-link" href="menu.php"><img src="img/header/nav-icon3.png" alt="">menu</a></li>
					<li class="nav-item">
    <a class="nav-link" href="cart.php">
        <img src="img/header/nav-icon3.png" alt=""> My Cart
        <span id="cartItemCount" class="cart-item-count " style="position:relative; top: -10px; font-weight:bolder"></span>
    </a>
</li>


                <li class="nav-item"><a class="nav-link" href="order.php"><img src="img/header/nav-icon7.png" alt="">Order</a></li>
					<li class="nav-item"><a class="nav-link" href="contact.php"><img src="img/header/nav-icon8.png" alt="">contact</a></li>

					<li class="nav-item ">
    <a class="nav-link active " href="./admin/logout.php">Logout - CMS </a>
</li>

				</ul>
			</div>
		</div>
	</header>
	
		<!--================ Start Footer Area =================-->
	</div>
<!-- Include your scripts at the end of the body to ensure the DOM is loaded -->
<script>
    function updateCartItemCount() {
        var cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
        $("#cartItemCount").text(cartItems.length);
    }

    $(document).ready(function () {
        updateCartItemCount();
    });
</script>

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