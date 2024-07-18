<?php
include 'auth.php';
include 'con.php';

header('Content-Type: application/json');

// Enable error reporting for debugging purposes
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$response = [];

if (isset($_POST['invite_id'])) {
    $invite_id = $_POST['invite_id'];
    $status = 'accepted';

    $sql = "UPDATE collab_invites SET status = ? WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $status, $invite_id);
        if ($stmt->execute()) {
            $response = ['status' => 'success'];
        } else {
            $response = ['status' => 'error', 'message' => $stmt->error];
        }
        $stmt->close();
    } else {
        $response = ['status' => 'error', 'message' => $conn->error];
    }
    $conn->close();
} else {
    $response = ['status' => 'error', 'message' => 'Invalid request'];
}

echo json_encode($response);
?>
