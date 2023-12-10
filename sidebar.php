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

        /* Sidebar styles */
        .sidebar {
            width: 250px;
            background-color: #333;
            color: #fff;
            padding: 20px;
            height:100vh;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: #fff;
            text-decoration: none;
            padding: 20px;
            margin-bottom: 5px;
            border-radius: 4px;
        }

        .sidebar a:hover {
            background-color: #555;
        }

        .sidebar a i {
            margin-right: 10px;
        }

   


    </style>
</head>

<body>

<div class="sidebar">
    <h3>DASHBOARD-CMS</h3>
    <hr />

    <a href="admin.php" class="active"><i class="fas fa-plus"></i> Add Meal</a>
    <a href="addSlot.php"><i class="fas fa-calendar-plus"></i> Add Slot</a>
    <a href="#"><i class="fas fa-file-alt"></i> Orders</a>
    <a href="users.php"><i class="fas fa-users"></i> Customers</a>
    <a href="feedback.php"><i class="fas fa-comment"></i> Feedback</a>
    <a href="#"><i class="fas fa-recycle"></i> Recycle</a>
    <a href="./admin/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>



</body>
</html>
