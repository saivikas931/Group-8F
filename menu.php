<!DOCTYPE html>
<html lang="en">

<head>
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
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- Main CSS -->
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
            height: 300px;
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

        /* Add your CSS styles for the table here */
        #itemTable {
            width: 90%;
            border-collapse: collapse;
            margin: 40px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #itemTable th,
        #itemTable td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        #itemTable th {
            background-color: #f2f2f2;
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
    <?php include("./header.php") ?>
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
        <div class="row banner-bottom common-bottom-banner align-items-center justify-content-center">
            <div class="col-lg-8 offset-lg-4">
                <div class="banner_content">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-7 col-md-12">
                            <h1>Menu Items List</h1>
                            <p>Explore our delicious menu items below. Click "Add to Cart" to place your order.</p>
                        </div>
                        <div class="col-lg-5 col-md-12">
                            <div class="page-link-wrap">
                                <div class="page_link">
                                    <a href="index.php">Back To Home</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--================ Start Reservstion Area =================-->
        <section class="section mb-5 ">
            <h1 class="card-title m-5" style="font-size: 30px;padding-top:20px; border-bottom:1px solid black">C M S -
                Menu Items List</h1>
            <!-- Table to display items -->
            <table class="table" id="itemTable">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ItemID</th>
                        <th scope="col">ItemName</th>
                        <th scope="col">Description</th>
                        <th scope="col">Availability</th>
                        <th scope="col">Price</th>
                        <th scope="col">Time</th>
                        <th scope="col">Meal Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Items will be dynamically added here using JavaScript -->
                </tbody>
            </table>

        </section>
        <!--================ End Reservstion Area =================-->

        <!--================ Start Footer Area =================-->
        <footer class="footer-area overlay">
            <p style="color: white; text-align: center;">Canteen Management System-CMS || Copyright@2023 </p>
        </footer>
        <!--================ Start Footer Area =================-->
    </div>

    <!-- Include your scripts at the end of the body to ensure the DOM is loaded -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Your custom scripts -->
    <script>
        // Function to fetch items from the server and populate the table and card container
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
                        updateTable(items);
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

        // Function to update the table with fetched items
        function updateTable(items) {
            var tableBody = $("#itemTable tbody");
            tableBody.empty();

            if (items && items.length > 0) {
                items.forEach(function (item) {
                    var row = `
                        <tr>
                            <td>${item.ItemID}</td>
                            <td>${item.ItemName}</td>
                            <td>${item.Description}</td>
                            <td>${item.Availability}</td>
                            <td>${item.Price}</td>
                            <td>${item.start_time} - ${item.end_time}</td>
                            <td>${item.TimeSlotStatus}</td>
                            <td><button class="btn btn-success add-to-cart-btn" data-item-id="${item.ItemID}">Add to
                                    Cart</button></td>
                        </tr>`;
                    tableBody.append(row);
                });
            } else {
                console.log("No items to display in the table.");
            }
        }

       

 // Example of a click event for the "Add to Cart" button in the table
$(document).on("click", ".add-to-cart-btn", function () {
    var $button = $(this);
    var $row = $button.closest('tr'); // Find the closest table row

    var itemDetails = {
        ItemID: $row.find("td:eq(0)").text(), // Extract ItemID from the first cell of the row
        ItemName: $row.find("td:eq(1)").text(), // Extract ItemName from the second cell of the row
        Description: $row.find("td:eq(2)").text(), // Extract Description from the third cell of the row
        Availability: $row.find("td:eq(3)").text(), // Extract Availability from the fourth cell of the row
        Price: $row.find("td:eq(4)").text() // Extract Price from the fifth cell of the row
    };

    // Check if the item is already in the cart
    var cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
    var isItemInCart = cartItems.some(cartItem => cartItem.ItemID === itemDetails.ItemID);

    if (isItemInCart) {
        alert("Item already in the cart!");
    } else {
        // Store the item details in localStorage
        cartItems.push(itemDetails);
        localStorage.setItem("cartItems", JSON.stringify(cartItems));

        console.log("Updated cartItems in localStorage:", cartItems);

        alert("Item added to cart successfully!");
    }
});

// Function to check if an item with a specific ItemID is already in the cart
function isItemInCart(itemID) {
    var cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
    return cartItems.some(item => item.ItemID === itemID);
}


        // Initial fetch of items when the page loads
        $(document).ready(function () {
            fetchItems();

            // Initialize DataTables with pagination
            $('#itemTable').DataTable({
                "paging": true,
                "pageLength": 10, // Show 10 items per page
                "lengthChange": false, // Disable the "Show [X] entries" dropdown
                "info": false // Disable the "Showing X to Y of Z entries" info
            });
        });
    </script>
</body>

</html>
