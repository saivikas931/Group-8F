<!DOCTYPE html>
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

    <style>
        /* Add your CSS styles for cards here */
        .card-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            justify-content: center; /* Center the cards horizontally */
            align-items: center; /* Center the cards vertically */
        }

        .card {
            width: 700px; /* Set your desired width */
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 6px;
            height: 220px;
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

        .card-text-av {
            margin-bottom: 4px;
            background-color: #F0F8FF;
            font-weight: bolder;
            padding: 7px;
            color: blue;
        }

        .card-text-slot {
            margin-bottom: 4px;
            background-color: lightgoldenrodyellow;
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
    
    session_start();
    include("./header.php");


  
 $userId = $_SESSION['UserID']; 
 echo '<script>var userId = ' . json_encode($userId) . ';</script>';
    ?>
    <!--================ End Header Menu Area =================-->

    <div class="site-main">

        <!--================ Start Reservstion Area =================-->
        <section class="section mb-5">
            <h1 class="card-title m-5" style="font-size: 30px;padding-top:20px; border-bottom:1px solid black">C M S -
                My Cart </h1>
            <div id="cardContainer" class="card-container"></div>
            <div id="grandTotal" class="m-5" style="font-size: 20px; border-top:1px solid black">Grand Total: $0.00</div>
            <button class="btn btn-success m-5" onclick="submitOrder()">Submit Order</button>
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

            // Get the items from localStorage
            var cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
            console.log("Cart items:", cartItems);

            var grandTotal = 0;

            // Display all items
            cartItems.forEach(function (item) {
                var totalPrice = parseFloat(item.Price) * parseFloat(item.Quantity);
                grandTotal += totalPrice;

                var card = `
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">${item.ItemName}</h5>
                   
                    <hr>
                    <p class="card-text">${item.Description}</p>
              
                    <p class="card-text-pr">Price: ${item.Price}</p>
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="${item.Quantity}" min="1" onchange="updateQuantity(${item.ItemID}, this.value)">
                    <p>Total Price: $${totalPrice.toFixed(2)}</p>
                </div>
            </div>`;
                cardContainer.append(card);
            });

            // Display grand total
            $("#grandTotal").text("Grand Total: $" + grandTotal.toFixed(2));
        }

        function updateQuantity(itemId, newQuantity) {
            // Update the quantity in localStorage
            var cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
            var updatedCartItems = cartItems.map(function (item) {
                if (item.ItemID === itemId) {
                    item.Quantity = parseInt(newQuantity);
                }
                return item;
            });
            localStorage.setItem("cartItems", JSON.stringify(updatedCartItems));

            // Update the displayed cards
            updateCards([]);
        }

        function submitOrder() {
    var cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
    var grandTotal = calculateGrandTotal(cartItems);

    $.ajax({
        type: "POST",
        url: "./admin/submitOrder.php",
        data: {
            items: cartItems,
            grandTotal: grandTotal,
            userId: userId // Send user ID to the server
        },
        success: function (response) {
            console.log("Order submitted successfully:", response);

            // Clear the cart after successful submission
            localStorage.removeItem("cartItems");

            // Optional: You might want to redirect the user to a confirmation page
            // window.location.href = "confirmation.php";
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Order submission failed:", textStatus, errorThrown);
        }
    });
}


        // Calculate the grand total from the cart items
        function calculateGrandTotal(cartItems) {
            var grandTotal = 0;
            cartItems.forEach(function (item) {
                grandTotal += parseFloat(item.Price) * parseFloat(item.Quantity);
            });
            return grandTotal;
        }

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
