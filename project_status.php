<?php

include 'con.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['project_id'])) {
    $project_id = $_POST['project_id'];
    $action = $_POST['action'];

    // Update the project status in the database
    if ($action == 'deactivate') {
        $sql = "UPDATE projects SET proj_status = 0 WHERE project_id = ?";
        $successMessage = "Project deactivated successfully.";
        $errorMessage = "Error deactivating project: ";

    } elseif ($action == 'activate') {
        $sql = "UPDATE projects SET proj_status = 1 WHERE project_id = ?";
        $successMessage = "Project activated successfully.";
        $errorMessage = "Error activating project: ";
        
    } else {
        echo "Invalid action.";
        exit();
    }

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $project_id);
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
