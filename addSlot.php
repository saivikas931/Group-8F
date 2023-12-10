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
            margin: 0 auto;
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
            width: 30%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            cursor: pointer;
        }

        button.add {
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
    <h2>Add Slot Time</h2>
    <button class="add" onclick="openModal()">Add New Slot</button>
</div>
       

        <div id="myModal" class="modal-bg">
            <div class="modal-content">
                <span onclick="closeModal()" style="cursor: pointer; float: right;">&times;</span>
                <h2>Add New Meal</h2>
                <hr>
                <form id="addMealForm">
                    <label for="start_time">Start Time:</label>
                    <input type="time" id="start_time" name="start_time" required>

                    <label for="end_time">End Time:</label>
                    <input type="time" id="end_time" name="end_time" required>

                    <label for="status">Status:</label>
                    <input type="text" id="status" name="status" required>

                    <button class="add" type="button" onclick="addSlot()">Add Slot</button>
                </form>
            </div>
        </div>
    <!-- Table to display items -->
    <table border="1" id="itemTable">
        <thead>
        <tr>
            <th>Time Slot ID</th>
            <th>Start Time</th>
            <th>End Time</th>
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
    // Function to fetch items from the server and populate the table
    function fetchItems() {
        $.ajax({
            type: "GET",
            url: "./admin/fetchSlot.php", // Replace with your server-side script
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

    // Function to update the table with fetched items
    function updateTable(items) {
        var tableBody = $("#itemTable tbody");
        tableBody.empty();

        if (items && items.length > 0) {
            items.forEach(function (item) {
                var row = `
                    <tr>
                        <td>${item.TimeSlotID}</td>
                        <td>${item.start_time}</td>
                        <td>${item.end_time}</td>
                        <td>${item.status}</td>
                        <td>
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

// Function to add a new slot
function addSlot() {
    // Get form values
    var startTime = $("#start_time").val();
    var endTime = $("#end_time").val();
    var status = $("#status").val();

    // Send an AJAX request to the server to add the slot
    $.ajax({
        type: "POST",
        url: "./admin/addTimeSlot.php", // Replace with your server-side script
        data: {
            start_time: startTime,
            end_time: endTime,
            status: status
        },
        success: function (response) {
            // Handle the response from the server (e.g., display a message)
            console.log(response);

            closeModal();
            // After adding a new slot, fetch and refresh the table
            fetchItems();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("AJAX Error:", textStatus, errorThrown);
        }
    });
}

    function openModal() {
        // Clear the form inputs
        $("#addMealForm")[0].reset();

        // Show the modal
        $("#myModal").css("display", "block");
    }

    // Function to close the modal
    function closeModal() {
        $("#myModal").css("display", "none");
    }

    // Initial fetch of items when the page loads
    $(document).ready(function () {
        fetchItems();
    });
</script>
</body>
</html>
