<?php

include 'con.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Adjust the column name 'email' to match your database
    $sql = "SELECT * FROM users WHERE `email` = '$email'";
    echo $sql;
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];
        if (password_verify($password, $hashed_password)) {
            
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $row['User_ID'];
            // Determine user type
            $user_type = $row['role'];
            
            // Redirect based on user type
            if ($user_type == 'user') {
                header("Location: profile.php");
                exit();
            } elseif ($user_type == 'recruiter') {
                header("Location: recruiter_profile.php"); 
                exit();
            } else {
                // Handle unknown user type
                header("Location: error_page.php?error=UnknownUserType");
                exit();
            }

        } else {
            header("Location: Sign_In.php?error=InvalidCredentials");
            exit();
        }
    } else {
        header("Location: Sign_In.php?error=UserNotFound");
        exit();
    }
}

$conn->close();
?>
