<?php

include 'con.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

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

            $user_type = $row['role'];

            $user_id = $row['User_ID'];
            
            // Redirect based on user type
            if ($user_type == 'user') {
                // UPDATE query to update LastActive
                $update_sql = "UPDATE user_profile SET LastActive = NOW() WHERE User_ID = ?";
                $stmt = $conn->prepare($update_sql);
                $stmt->bind_param('s', $user_id);
                $stmt->execute();

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
