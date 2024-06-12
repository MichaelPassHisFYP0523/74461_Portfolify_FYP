<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "con.php";

    $project_id = $_POST['project_id'];
    $sender_id = $_POST['user_id']; 
    $message = $_POST['message']; 

    // Fetch the project owner ID from the database
    $query = "SELECT user_id FROM `projects` WHERE `project_id` = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        exit();
    }
    $stmt->bind_param("s", $project_id);
    if (!$stmt->execute()) {
        echo "Error executing statement: " . $stmt->error;
        exit();
    }
    $stmt->bind_result($receiver_id);
    $stmt->fetch();
    $stmt->close();

    if ($receiver_id) {
        if ($receiver_id == $sender_id) {
            echo json_encode(array("status" => "error", "message" => "You cannot send a collaboration request to yourself."));
            exit();
        }
        
        $status = 'pending';
        $created_at = date('Y-m-d H:i:s');

        // Insert the application into the database without collab_id
        $stmt = $conn->prepare("INSERT INTO `collab_invites` (`proj_id`, `sender_id`, `receiver_id`, `status`, `message`, `created_at`) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            echo "Error preparing insert statement: " . $conn->error;
            exit();
        }
        $stmt->bind_param("ssssss", $project_id, $sender_id, $receiver_id, $status, $message, $created_at);

        if ($stmt->execute()) {
            // Retrieve the last inserted id
            $last_inserted_id = $conn->insert_id;
            $new_collab_id = "collab-" . str_pad($last_inserted_id, 6, '0', STR_PAD_LEFT);

            // Update the collab_id in the database
            $update_stmt = $conn->prepare("UPDATE `collab_invites` SET `collab_id` = ? WHERE `id` = ?");
            if (!$update_stmt) {
                echo "Error preparing update statement: " . $conn->error;
                exit();
            }
            $update_stmt->bind_param("si", $new_collab_id, $last_inserted_id);

            if ($update_stmt->execute()) {
                $response = array(
                    "status" => "success",
                    "message" => "Application submitted successfully!"
                );
            } else {
                $response = array(
                    "status" => "error",
                    "message" => "Error submitting application: " . $update_stmt->error
                );
            }

            $update_stmt->close();
        } else {
            echo "Error submitting application: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Project owner not found.";
    }

    $conn->close();

    echo json_encode($response);
}
?>