<?php
// login.php
$servername = "127.0.0.1";
$username = "root"; 
$password = ""; 
$dbname = "hotel_booking";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];

            header("Location: main.html"); // Redirect to dashboard.html
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e6f7ff, #cceeff);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Container Styling */
        .login-container {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
            font-size: 1.8em;
        }
        


        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 1em;
            color: #555;
            margin-bottom: 5px;
        }

        input {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            color: #333;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Link Styling */
        a {
            text-decoration: none;
            color: #007bff;
            font-size: 0.9em;
            text-align: center;
            margin-top: 10px;
            display: block;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-container {
                padding: 20px;
            }

            button {
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
        <a href="signup.php">Don't have an account? Sign up</a>
    </div>
</body>
</html>
