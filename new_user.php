<?php
include "con.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $position = $_POST['position'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        $sql = "INSERT INTO `register`(`first_name`, `last_name`, `gender`, `email`, `mobile`, `position`, `password`) VALUES ('$firstName','$lastName','$gender','$email','$mobile','$position','$password')";
        
        if ($conn->query($sql) === TRUE) {
            
            echo "User registration successful!";
        } else {
            
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>