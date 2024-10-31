<?php
include 'database-connector.php'; // Include your database connection script

try {
    $conn = connect(); // Call the function to connect to the database

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $role = mysqli_real_escape_string($conn, $_POST['role']);
        
        // Hash the password
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Prepare and execute the SQL statement
        $sql = "INSERT INTO user_table (name, email, username, password_hash, role) VALUES ('$name', '$email', '$username', '$password_hash', '$role')";

        if (mysqli_query($conn, $sql)) {
            echo "Registration successful!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

} catch (Exception $e) {
    die($e->getMessage());
} finally {
    mysqli_close($conn); // Close the connection
}
?>
