<?php
include "con.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Password encryption
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Retrieve the last ID from the database
    $getLastIdSql = "SELECT `UserID` FROM `user_profile` ORDER BY `UserID` DESC LIMIT 1";
    $lastIdResult = $conn->query($getLastIdSql);

    if ($lastIdResult->num_rows > 0) {
        
        $row = $lastIdResult->fetch_assoc();
        $last_id = $row["UserID"];
        $numeric_part = (int)substr($last_id, 5); 
        $new_id = "user-" . sprintf('%05d', $numeric_part + 1); 
        
    } else {
        
        $new_id = "user-00001";
    }

    // Prepare SQL statement using prepared statements and parameter binding
    $sql = "INSERT INTO user_profile (UserID, Email, Password, FirstName, Lastname, Gender) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $new_id, $email, $hashed_password, $firstName, $lastName, $gender);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "User registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
    $conn->close();
}
?>
