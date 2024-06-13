<?php
include "con.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST['email'];
    $position = $_POST['position'];
    $password = $_POST['password'];

    // Check if email already exists
    $checkEmailSql = "SELECT `email` FROM `users` WHERE `email` = ?";
    $stmt = $conn->prepare($checkEmailSql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Email already exists. Please use a different email.";
    } else {
        // Password encryption
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Retrieve the last ID from users table
        $getLastIdSql = "SELECT `User_ID` FROM `users` ORDER BY `User_ID` DESC LIMIT 1";
        $lastIdResult = $conn->query($getLastIdSql);

        if ($lastIdResult->num_rows > 0) {
            $row = $lastIdResult->fetch_assoc();
            $last_id = $row["User_ID"];
            $numeric_part = $last_id ? (int)substr($last_id, 5) : 0; 
            $new_id = "user-" . sprintf('%05d', $numeric_part + 1); 
        } else {
            $new_id = "user-00001";
        }

        // Determine the role
        $role = ($position == 'Recruiter') ? 'recruiter' : 'user';

        // Insert into users table
        $sql = "INSERT INTO `users`(`User_ID`, `email`, `password`, `role`) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $new_id, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            
            if ($role == 'recruiter') {
                // Retrieve the last ID from recruiter_profile
                $getLastId = "SELECT `r_id` FROM `recruiter_profile` ORDER BY `r_id` DESC LIMIT 1";
                $lastId = $conn->query($getLastId);

                if ($lastId->num_rows > 0) {
                    $row = $lastId->fetch_assoc();
                    $last_id = $row["r_id"];
                    $numeric_part = $last_id ? (int)substr($last_id, 2) : 0; 
                    $profile_id = "r-" . sprintf('%05d', $numeric_part + 1); 
                } else {
                    $profile_id = "r-00001";
                }

                // Insert into recruiter_profile
                $profile_sql = "INSERT INTO `recruiter_profile`(`r_id`, `User_ID`) VALUES (?, ?)";
            } else {
                // Retrieve the last ID from user_profile
                $getLastId = "SELECT `u_id` FROM `user_profile` ORDER BY `u_id` DESC LIMIT 1";
                $lastId = $conn->query($getLastId);

                if ($lastId->num_rows > 0) {
                    $row = $lastId->fetch_assoc();
                    $last_id = $row["u_id"];
                    $numeric_part = $last_id ? (int)substr($last_id, 2) : 0; 
                    $profile_id = "u-" . sprintf('%05d', $numeric_part + 1); 
                } else {
                    $profile_id = "u-00001";
                }

                // Insert into user_profile
                $profile_sql = "INSERT INTO `user_profile`(`u_id`, `email`, `User_ID`) VALUES (?, ?, ?)";
            }

            $stmt_profile = $conn->prepare($profile_sql);
            if ($role == 'recruiter') {
                $stmt_profile->bind_param("ss", $profile_id, $new_id);
            } else {
                $stmt_profile->bind_param("sss", $profile_id, $email, $new_id);
            }

            if ($stmt_profile->execute()) {
                echo "User registration successful!";
            } else {
                echo "Error inserting into profile table: " . $stmt_profile->error;
            }
            $stmt_profile->close();
        } else {
            echo "Error inserting into users: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    }

    $conn->close();
}
?>
