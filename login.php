<?php
include 'db_connect.php';
session_start();

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            header("Location: dashboard.php"); // Redirect after login
            exit();
        } else {
            $message = "❌ Incorrect password!";
        }
    } else {
        $message = "❌ No user found with that email!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial;
            background: #e0f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px gray;
            width: 300px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }
        button {
            background: #00796b;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 5px;
        }
        p {
            color: red;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
        <h2>Login</h2>
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit">Login</button>
        <p><?php echo $message; ?></p>
    </form>
</body>
</html>
