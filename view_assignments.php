<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("
    SELECT a.title, a.file_path, a.upload_date, u.username 
    FROM assignments a
    LEFT JOIN users u ON a.uploaded_by = u.id
    ORDER BY a.upload_date DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Assignments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            padding: 30px;
            margin: 0;
        }
        h2 {
            text-align: center;
            color: #17a2b8;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
            text-align: center;
        }
        th {
            background: #007bff;
            color: white;
        }
        tr:hover {
            background: #f1f1f1;
        }
        a.download {
            color: #28a745;
            text-decoration: none;
            font-weight: bold;
        }
        a.download:hover {
            text-decoration: underline;
        }
        .back {
            text-align: center;
            margin-top: 20px;
        }
        .back a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .back a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>📋 Uploaded Assignments</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Uploaded By</th>
            <th>Date</th>
            <th>Download</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['title']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['upload_date']}</td>
                        <td><a class='download' href='{$row['file_path']}' download>📥 Download</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No assignments uploaded yet.</td></tr>";
        }
        ?>
    </table>
    <div class="back">
        <a href="dashboard.php">⬅ Back to Dashboard</a>
    </div>
</body>
</html>
