<?php
include 'db_connect.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // encrypt password

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        $message = "✅ Registration successful! You can now log in.";
    } else {
        $message = "❌ Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            box-shadow: 0px 0px 10px gray;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }
        button {
            background: green;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 5px;
        }
        p {
            color: blue;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
        <h2>Student Registration</h2>
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit">Register</button>
        <p><?php echo $message; ?></p>
    </form>
</body>
</html>
