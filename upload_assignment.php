<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["assignment"])) {
    $title = $_POST['title'];
    $uploaded_by = $_SESSION['username'];
    $file_name = $_FILES["assignment"]["name"];
    $temp_name = $_FILES["assignment"]["tmp_name"];
    $target_dir = "uploads/" . basename($file_name);

    if (move_uploaded_file($temp_name, $target_dir)) {
        $sql = "INSERT INTO assignments (title, file_path, uploaded_by)
                VALUES ('$title', '$target_dir', 
                (SELECT id FROM users WHERE username='$uploaded_by'))";
        if ($conn->query($sql) === TRUE) {
            $message = "✅ Assignment uploaded successfully!";
        } else {
            $message = "❌ Database error: " . $conn->error;
        }
    } else {
        $message = "❌ Failed to upload file!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Assignment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #e0f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            width: 400px;
            text-align: center;
        }
        input[type="text"], input[type="file"] {
            width: 90%;
            padding: 10px;
            margin: 12px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        button {
            background: #28a745;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            width: 95%;
            margin-top: 10px;
        }
        button:hover {
            opacity: 0.9;
        }
        p {
            color: green;
            margin-top: 10px;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <h2>📤 Upload Assignment</h2>
        <input type="text" name="title" placeholder="Enter Assignment Title" required>
        <input type="file" name="assignment" required>
        <button type="submit">Upload</button>
        <p><?php echo $message; ?></p>
        <a href="dashboard.php">⬅ Back to Dashboard</a>
    </form>
</body>
</html>
