<?php
session_start(); // Start a new session or resume the existing one
include 'database-connector.php'; // Include your database connection script

try {
    $conn = connect(); // Connect to the database

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Prepare the SQL statement to fetch the user data
        $sql = "SELECT * FROM user_table WHERE username='$username'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            
            // Verify the password
            if (password_verify($password, $user['password_hash'])) {
                // Set session variables upon successful login
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                
                echo "Login successful! Welcome, " . htmlspecialchars($user['username']) . "!";
                // Redirect or display a welcome message
                // header('Location: dashboard.php'); // Example redirect to a dashboard page
            } else {
                echo "Invalid username or password.";
            }
        } else {
            echo "Invalid username or password.";
        }
    }

} catch (Exception $e) {
    die($e->getMessage());
} finally {
    mysqli_close($conn); // Close the connection
}
?>
