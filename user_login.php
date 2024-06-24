<?php

include 'con.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start(); // Ensure session is started
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepared statement to prevent SQL injection
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $row['User_ID'];
            $_SESSION['role'] = $row['role'];

            $user_id = $row['User_ID'];

            // UPDATE query to update LastActive
            $update_sql = "UPDATE user_profile SET LastActive = NOW() WHERE User_ID = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param('s', $user_id);
            $update_stmt->execute();

            // Redirect to the originally intended page
            if (isset($_SESSION['redirect_url'])) {
                $redirect_url = $_SESSION['redirect_url'];
                unset($_SESSION['redirect_url']);
                header("Location: $redirect_url");
            } else {
                // Default redirect to profile page if no intended page is found
                header("Location: profile.php");
                // echo "Redirecting to profile.php";
            }
            exit();
        } else {
            // Invalid credentials
            header("Location: Sign_In.php?error=InvalidCredentials");
            exit();
        }
    } else {
        // User not found
        header("Location: Sign_In.php?error=UserNotFound");
        exit();
    }
}

$conn->close();
?>
