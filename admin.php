<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-+ZdIH56hUMRIj9KzgeXqMz3hckuCiI1aYwehv5QFAGlrV0MzVgSSc9+eTGnL6Jh5i4gKVHa1T16ODk+2bNxrQg==" crossorigin="anonymous" />

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
        }
        /* Main content styles */
        .main-content {
            flex: 1; /* Take the remaining width */
            padding: 0px 20px 20px 20px;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin: 20px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            max-width: 600px;
            margin: 10px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            cursor: pointer;
        }

        button.add {
            margin-top: 30px;
            background-color: #4caf50;
            color: #fff;
            width: 22%!important;
        }

        button.edit {
            background-color: #008CBA;
            color: #fff;
        }

        button.copy {
            background-color: #f0ad4e;
            color: #fff;
        }

        button.delete {
            background-color: #d9534f;
            color: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .modal-bg {
    background: rgba(0, 0, 0, 0.5);
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content {
    width: 50%;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    position: relative;
}

        .header{
            background-color: #fff;
            width: 100%;
            height: 74px;
            padding: 1px 0px 0px 5px;
        }
        .btn{
            display: flex;
            flex-direction: row;
        }
    </style>
</head>

<body>

<!-- <div class="sidebar">
    <h3>DASHBOARD-CMS</h3>
    <hr />

    <a href="admin.php" class="active"><i class="fas fa-plus"></i> Add Meal</a>
    <a href="#"><i class="fas fa-calendar-plus"></i> Add Slot</a>
    <a href="#"><i class="fas fa-file-alt"></i> Orders</a>
    <a href="#"><i class="fas fa-users"></i> Customers</a>
    <a href="#"><i class="fas fa-comment"></i> Feedback</a>
    <a href="#"><i class="fas fa-recycle"></i> Recycle</a>
    <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div> -->
<?php
require("./sidebar.php")
?>
    <!-- Main Content -->
    <div class="main-content">
<div class="header">
    <h3>Canteen Management System - CMS</h3>
</div>
<div class="btn" style="justify-content: space-between;">
    <h2>Add Meal Menu</h2>
        <button class="add" onclick="openModal()">Add New Meal</button>
</div>
        <div id="myModal" class="modal-bg">
            <div class="modal-content">
                <span onclick="closeModal()" style="cursor: pointer; float: right;">&times;</span>
                <h2>Add New Meal</h2>
                <hr>
                <form id="addMealForm">
                    <label for="itemName">Item Name:</label>
                    <input type="text" id="itemName" name="itemName" required>

                    <label for="description">Description:</label>
                    <textarea id="discription" name="discription" required></textarea>

                    <label for="availability">Availability:</label>
                    <input type="number" id="availability" name="availability" required>


                    <label for="slot">Select Slot:</label>
                 <select id="slot" name="slot" style="height:30px; width:100%; margin-bottom:20px"></select>


                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" step="0.01" required>




                    <button class="add" type="button" onclick="addOrUpdateMeal()">Add Meal</button>

                </form>
            </div>
        </div>
    <!-- Table to display items -->
    <table border="1" id="itemTable">
        <thead>
        <tr>
            <th>ItemID</th>
            <th>ItemName</th>
            <th>Description</th>
            <th>Availability</th>
            <th>Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <!-- Data will be dynamically added here through JavaScript -->
        </tbody>
    </table>

</div>

<!-- Include your scripts at the end of the body to ensure the DOM is loaded -->
<script>

function addOrUpdateMeal() {
    var itemId = $("#itemId").val(); // Add an input field with id="itemId" to store the ItemID

    if (itemId) {
        // If itemId is available, it's an update
        updateMeal(itemId);
    } else {
        // If itemId is not available, it's an insert
        addMeal();
    }
}






    // Function to fetch items from the server and populate the table
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
                } catch (error) {
                    console.error("Error parsing JSON: " + error);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error:", textStatus, errorThrown);
            }
        });
    }

    function fetchItem() {
    $.ajax({
        type: "GET",
        url: "./admin/fetchSlot.php",
        success: function (response) {
            console.log("Raw Response:", response);

            try {
                var slots = JSON.parse(response.substring(response.indexOf('[')));
                console.log("Parsed Slots:", slots);

                // Update the select dropdown with fetched slots
                updateSelectDropdown(slots);
            } catch (error) {
                console.error("Error parsing JSON: " + error);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("AJAX Error:", textStatus, errorThrown);
        }
    });
}

function updateSelectDropdown(slots) {
    var selectDropdown = $("#slot");
    selectDropdown.empty();

    slots.forEach(function (slot) {
        console.log("Slot:", slot); // Add this line for debugging
        var option = $("<option>", {
            value: slot.TimeSlotID, // Save TimeSlotID as the value
            text: slot.status // Display status as the text
        });
        selectDropdown.append(option);
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
                        <td>${item.TimeSlotStatus}</td>
                        <td class='btn'>
                            <button class='edit' onclick='editItem(${item.ItemID})'>Edit</button>
                            <button class='delete' onclick='deleteItem(${item.ItemID})'>Delete</button>
                        </td>
                    </tr>`;
                tableBody.append(row);
            });
        } else {
            console.log("No items to display.");
        }
    }

    function editItem(itemId) {
    // Set the modal title to "Edit Meal"
    $("#myModal h2").text("Edit Meal");

    // Fetch the details of the selected item and populate the form fields
    $.ajax({
        type: "GET",
        url: "./admin/fetchSingleItem.php?itemId=" + itemId,
        success: function (response) {
            try {
                var item = JSON.parse(response);
                console.log("Parsed Item:", item);

                // Populate the form fields with item details
                $("#itemId").val(item.ItemID);
                $("#itemName").val(item.ItemName);
                $("#description").val(item.Description);
                $("#availability").val(item.Availability);
                $("#slot").val(item.TimeSlotID); // Assuming TimeSlotID is available in the response
                $("#price").val(item.Price);

                // Open the modal
                openModal();
            } catch (error) {
                console.error("Error parsing JSON: " + error);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("AJAX Error:", textStatus, errorThrown);
        }
    });
}


// Function to delete a meal
function deleteItem(itemId) {
    // Confirm deletion with an alert
    var confirmDelete = confirm("Are you sure you want to delete this item?");

    if (confirmDelete) {
        // Send an AJAX request to the server to delete the meal
        $.ajax({
            type: "POST",
            url: "./admin/deleteMeal.php", // Update the URL path if necessary
            data: { itemId: parseInt(itemId) }, // Convert itemId to integer
            success: function (response) {
                console.log(response);

                // Check the response for success
                if (response.trim() === "Meal deleted successfully.") {
                    // Show an alert after deleting a meal
                    alert("Meal deleted successfully!");

                    // After deleting a meal, fetch and refresh the table
                    fetchItems();
                } else {
                    // Show an alert with the error message
                    alert("Error deleting meal: " + response);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error:", textStatus, errorThrown);
            }
        });
    } else {
        // User canceled the deletion
        alert("Deletion canceled.");
    }
}

function addMeal() {
    var itemName = $("#itemName").val();
    var discription = $("#discription").val();
    var availability = parseInt($("#availability").val()); 
    var price = parseFloat($("#price").val()); 
    var slot = $("#slot").val();

    // Log data before sending
    console.log("Data before sending:", {
        itemName: itemName,
        discription: discription,
        availability: availability,
        price: price,
        TimeSlotID: slot
    });

    $.ajax({
        type: "POST",
        url: "./admin/addMeal.php",
        data: {
            itemName: itemName,
            discription: discription,
            availability: availability,
            price: price,
            slot: slot
        },
        success: function (response) {
            console.log(response);

            closeModal();
            fetchItems();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("AJAX Error:", textStatus, errorThrown);
            alert("Error adding meal. Please try again.");
        }
    });
}





    function openModal() {
        // Clear the form inputs
        $("#addMealForm")[0].reset();

        // Show the modal
        $("#myModal").css("display", "block");

        fetchItem();
    }

    // Function to close the modal
    function closeModal() {
        $("#myModal").css("display", "none");
    }

    // Initial fetch of items when the page loads
    $(document).ready(function () {
        fetchItems();
        fetchItem();
    });
</script>
</body>
</html>
