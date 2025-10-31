<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            text-align: center;
        }
        h2 {
            color: #007bff;
        }
        a.button {
            display: block;
            margin: 15px auto;
            padding: 12px;
            width: 80%;
            text-decoration: none;
            color: white;
            border-radius: 8px;
            font-weight: bold;
        }
        a.upload {
            background-color: #28a745;
        }
        a.view {
            background-color: #17a2b8;
        }
        a.logout {
            background-color: #dc3545;
        }
        a.button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?> 🎓</h2>
        <a class="button upload" href="upload_assignment.php">📤 Upload Assignment</a>
        <a class="button view" href="view_assignments.php">📋 View Uploaded Assignments</a>
        <a class="button logout" href="logout.php">🚪 Logout</a>
    </div>
</body>
</html>
