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
            background-color: #4caf50;
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

     
        .header{
            background-color: #fff;
            width: 100%;
            height: 74px;
            padding: 1px 0px 0px 5px;
        }
    </style>
</head>

<body>

<?php
require("./sidebar.php")
?>
    <!-- Main Content -->
    <div class="main-content">
<div class="header">
    <h3>Canteen Management System - CMS</h3>
</div>
    


<div class="btn" style="justify-content: space-between;">
    <h2>Customer's Feedback</h2>
   
</div>
       
    <!-- Table to display items -->
    <table border="1" id="itemTable">
        <thead>
        <tr>
            <th>Feedback ID</th>
            <th>Title</th>
            <th>Description </th>
            <th>Remark</th>
            <th>Date</th>
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
            url: "./admin/fetchFeedback.php", // Replace with your server-side script
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


// Function to delete a feedback entry
// Function to delete a feedback entry with confirmation alert
function deleteItem(feedbackID) {
    var confirmation = confirm('Are you sure you want to delete this feedback entry?');
    if (confirmation) {
        $.ajax({
            type: 'GET',
            url: `./admin/deleteFeedback.php?feedbackID=${feedbackID}`,
            success: function (response) {
                try {
                    var result = JSON.parse(response);
                    if (result.success) {
                        console.log('Feedback entry deleted successfully');
                        fetchItems(); // Refresh the table after deletion
                    } else {
                        console.error('Error deleting feedback entry:', result.error);
                    }
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
            }
        });
    }
}



    // Function to format the date
function formatDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' };
    const formattedDate = new Date(dateString).toLocaleDateString('en-US', options);
    return `${formattedDate}`;
}

    // Function to update the table with fetched items
    function updateTable(items) {
        var tableBody = $("#itemTable tbody");
        tableBody.empty();

        if (items && items.length > 0) {
            items.forEach(function (item) {
                var userInfo = `${item.Username} [${item.userID}] `;
                var row = `<tr>
                          <td>${item.feedbackID}</td>
                          <td>${item.title}</td>
                          <td>${item.discription}</td>
                          <td>${item.remark}</td>
                          <td>${formatDate(item.date)}</td>
                          <td>
                            <button class='delete' onclick='deleteItem(${item.feedbackID})'>Delete</button>
                        </td>
                    </tr>`;
                tableBody.append(row);
            });
        } else {
            console.log("No items to display.");
        }
    }

    $(document).ready(function () {
        fetchItems();
    });
</script>
</body>
</html>
