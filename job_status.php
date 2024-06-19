<?php

include 'con.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['job_id'])) {
    $job_id = $_POST['job_id'];
    $action = $_POST['action'];

    // Update the project status in the database
    if ($action == 'deactivate') {
        $sql = "UPDATE job SET job_status = 0 WHERE job_id = ?";
        $successMessage = "Job deactivated successfully.";
        $errorMessage = "Error deactivating Job: ";

    } elseif ($action == 'activate') {
        $sql = "UPDATE job SET job_status = 1 WHERE job_id = ?";
        $successMessage = "Job activated successfully.";
        $errorMessage = "Error activating Job: ";

    } else {
        echo "Invalid action.";
        exit();
    }

    if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $job_id);
        if ($stmt->execute()) {
            echo $successMessage;
        } else {
            echo $errorMessage . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
