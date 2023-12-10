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

	<style>
    /* Add your CSS styles for cards here */
	.card-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px; 
    justify-content: center; /* Center the cards horizontally */
    align-items: center; /* Center the cards vertically */
}

.card {
    width: 300px; /* Set your desired width */
    border: 1px solid #ccc;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

    .card-body {
        padding: 16px;
		height: 350px;
    }

    .card-title {
        font-size: 1.25rem;
        margin-bottom: 8px;
    }

    .card-text {
        margin-bottom: 4px;
    }
	.card-text-pr {
        margin-bottom: 4px;
		color: red;
		font-weight: bolder;
    }
	.card-text-av{
        margin-bottom: 4px;
		background-color: #F0F8FF;
		font-weight: bolder;
		padding: 7px;
		color: blue;
    }
	.card-text-slot{
		margin-bottom: 4px;
		background-color:lightgoldenrodyellow;
		padding: 2px;
		color: green;
	}
</style>
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
		<section class="home_banner_area">
			<div class="banner_inner">
				<div class="container-fluid no-padding">
					<div class="row fullscreen">
                  
					</div>
				</div>
			</div>
		</section>
		<!-- Start banner bottom -->
		<div class="row banner-bottom align-items-center justify-content-center">
			<div class="col-lg-8" style="margin-right:20px; margin-left:auto">
				<div class="banner_content">
					<div class="row d-flex align-items-center">
						<div class="col-lg-8 col-md-12">
							
							<h1>Canteen Management System - CMS</h1>
                            <p class="top-text">Canteen Shop offers best in town</p>
							<p>Efficiently Manage Canteen Operations with our Canteen Management System</p>
						</div>
						<div class="col-lg-4 col-md-12">
							<div class="banner-btn">
								<a class="primary-btn text-uppercase" href="menu.php"> Menu</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End banner bottom -->
	

		<!--================ Start Reservstion Area =================-->
		<section class="section mb-5 ">
		<h1 class="card-title m-5" style="font-size: 30px;padding-top:20px; border-bottom:1px solid black">C M S - Menu Items List</h1>
		<div id="cardContainer" class="card-container"></div>
		</section>
		<!--================ End Reservstion Area =================-->




		<!--================ Start Footer Area =================-->
		<footer class="footer-area overlay">
    <p style="color: white; text-align: center;">Canteen Management System-CMS || Copyright@2023 </p>
     </footer>

		<!--================ Start Footer Area =================-->
	</div>
<!-- Include your scripts at the end of the body to ensure the DOM is loaded -->
<script>
    // Function to fetch items from the server and populate the card container
   // Function to fetch items from the server and populate the card container
function fetchItems() {
    $.ajax({
        type: "GET",
        url: "./admin/fetchItems.php", // Replace with your server-side script
        success: function (response) {
            console.log("Raw Response:", response);

            try {
                // Remove any additional strings and only parse the JSON part
                var items = JSON.parse(response.substring(response.indexOf('[')));
                console.log("Parsed Items:", items);
                updateCards(items);
            } catch (error) {
                console.error("Error parsing JSON: " + error);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("AJAX Error:", textStatus, errorThrown);
        }
    });
}

function updateCards(items) {
    var cardContainer = $("#cardContainer");
    cardContainer.empty();

    if (items && items.length > 0) {
        items.forEach(function (item) {
            var card = `
                <div class="card" data-item-id="${item.ItemID}" data-item-name="${item.ItemName}" data-item-description="${item.Description}" data-item-availability="${item.Availability}" data-item-price="${item.Price}">
                    <div class="card-body">
                        <h5 class="card-title">${item.ItemName}</h5>
                        <p class="card-text-slot">${item.start_time} - ${item.end_time} [${item.TimeSlotStatus}]</p>
                        <hr>
                        <p class="card-text">${item.Description}</p>
                        <p class="card-text-av">Availability: <span>${item.Availability}</span></p>
                        <p class="card-text-pr">Price: ${item.Price}</p>
                        <button class="btn btn-success add-to-cart-btn">Add to Cart</button>
                    </div>
                </div>`;
            cardContainer.append(card);
        });
    } else {
        console.log("No items to display.");
    }
}

$(document).on("click", ".add-to-cart-btn", function () {
    var $card = $(this).closest('.card');
    var itemDetails = {
        ItemID: $card.data("item-id"),
        ItemName: $card.data("item-name"),
        Description: $card.data("item-description"),
        Availability: $card.data("item-availability"),
        Price: $card.data("item-price")
    };

    // Check if the item is already in the cart
    var cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
    var isItemInCart = cartItems.some(cartItem => cartItem.ItemID === itemDetails.ItemID);

    if (isItemInCart) {
        alert("Item already in the cart!");
    } else {
        // Add your logic here for adding the item to the cart

        // Store the item details in localStorage
        cartItems.push(itemDetails);
        localStorage.setItem("cartItems", JSON.stringify(cartItems));

        console.log("Item added to cart successfully:", itemDetails);
        console.log("Updated cartItems in localStorage:", cartItems);

        alert("Item added to cart successfully!");
    }
});

// Initial fetch of items when the page loads
$(document).ready(function () {
    fetchItems();
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