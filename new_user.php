<?php
include "con.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $position = $_POST['position'];
    $password = $_POST['password'];

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

    // Retrieve the last ID from user_profile
    $getLastId = "SELECT `u_id` FROM `user_profile` ORDER BY `u_id` DESC LIMIT 1";
    $lastId = $conn->query($getLastId);
    
    if ($lastId->num_rows > 0) {
        $row = $lastId->fetch_assoc();
        $last_id = $row["u_id"];
        $numeric_part = $last_id ? (int)substr($last_id, 5) : 0; 
        $userProfile_id = "u-" . sprintf('%05d', $numeric_part + 1); 
    } else {
        $userProfile_id = "u-00001";
    }

    // Prepare SQL statement using prepared statements and parameter binding
    $sql = "INSERT INTO `users`(`User_ID`, `email`, `password`, `role`) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $role = ($position == 'Recruiter') ? 'recruiter' : 'user'; 
    $stmt->bind_param("ssss", $new_id, $email, $hashed_password, $role);

    // Execute the prepared statement
    if ($stmt->execute()) {
        $last_inserted_id = mysqli_insert_id($conn); 
        // Insert into user_profile table
        $user_profile_sql = "INSERT INTO `user_profile`(`u_id`, `email`, `User_ID`) VALUES (?, ?, ?)";
        $stmt_profile = $conn->prepare($user_profile_sql);
        $stmt_profile->bind_param("sss", $userProfile_id, $email, $new_id);
        if ($stmt_profile->execute()) {
            echo "User registration successful!";
        } else {
            echo "Error inserting into user_profile: " . $stmt_profile->error;
        }
        $stmt_profile->close();
    } else {
        echo "Error inserting into users: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
    $conn->close();
}
?>
