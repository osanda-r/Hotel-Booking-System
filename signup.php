<?php
// signup.php
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
    $role = $_POST['role'];

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql_check = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql_check);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username already exists!";
    } else {
        $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $hashed_password, $role);

        if ($stmt->execute()) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;

            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Signup Container */
        .signup-container {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .signup-container h2 {
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

        input, select {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            color: #333;
        }

        input:focus, select:focus {
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
            .signup-container {
                padding: 20px;
            }

            button {
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Signup</h2>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="admin">Admin</option>
                <option value="guest">Guest</option>
            </select>
            
            <button type="submit">Signup</button>
        </form>
        <a href="login.php">Already have an account? Login</a>
    </div>
</body>
</html>
