<?php
session_start();
include ("con.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['job_title'];
    $jobType = $_POST['jobType'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];
    $requirement = $_POST['requirement'];
    $user_id = $_POST['user_id'];

    // Generate a unique job_id, this is a simple example, you might want to use a more robust method
    $new_id = uniqid('job_', true);

    $sql = "INSERT INTO `job` (
        `job_id`,
        `job_title`,
        `job_location`,
        `salary`,
        `requirement`,
        `job_types`,
        `recruiter_id`
    ) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    // Check if prepare() was successful
    if ($stmt === false) {
        $_SESSION['message'] = 'Prepare failed: ' . htmlspecialchars($conn->error);
        $_SESSION['msg_type'] = 'error';
    } else {
        $stmt->bind_param("sssssss", $new_id, $title, $location, $salary, $requirement, $jobType, $user_id);

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'New job posted successfully';
            // $_SESSION['msg_type'] = 'success';
        } else {
            $_SESSION['error_message'] = 'Error: ' . htmlspecialchars($stmt->error);
            // $_SESSION['msg_type'] = 'error';
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();

// Redirect back to the form page
header('Location: recruiter_profile.php');
exit();
?>
