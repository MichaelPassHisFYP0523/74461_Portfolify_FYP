<?php
include 'con.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    switch ($action) {
        case 'upload':
            $full_name = htmlspecialchars($_POST['full_name']);
            $description = htmlspecialchars($_POST['description']);
            $user_id = $_POST['user_id'];
            $proj_status = $_POST['collaborate'];
            $file = $_FILES['file'];
            $image = $_FILES['image_file']; 
        
            // Check if the file upload was successful
            if ($file['error'] === UPLOAD_ERR_OK) {
        
                $unique_id = 'proj-' . uniqid();
                $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $fileName = $unique_id . '.' . $file_extension;
                $file_destination = './files/project/' . $fileName;
        
                if (!is_dir('./files/project/')) {
                    mkdir('./files/project/', 0777, true);
                }
        
                if (move_uploaded_file($file['tmp_name'], $file_destination)) {
        
                    // Set image path
                    $default_image_path = '../images/Team_Office.jpg'; 
                    $image_path = $default_image_path; 
        
                    // If an image file is uploaded, move it and set the image path
                    if ($image['error'] === UPLOAD_ERR_OK) {
                        $image_unique_id = 'image-' . uniqid();
                        $image_extension = pathinfo($image['name'], PATHINFO_EXTENSION);
                        $imageFileName = $image_unique_id . '.' . $image_extension;
                        $image_destination = './files/images/' . $imageFileName;
        
                        if (!is_dir('./files/images/')) {
                            mkdir('./files/images/', 0777, true);
                        }
        
                        move_uploaded_file($image['tmp_name'], $image_destination);
                        $image_path = $image_destination;
                    }
        
                    // Prepare SQL statement with optional image path
                    $sql = "INSERT INTO projects (project_id, user_id, title, description, created_at, project_path, proj_status, project_image) VALUES (?, ?, ?, ?, NOW(), ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
        
                    // Bind parameters
                    $stmt->bind_param("sssssss", $unique_id, $user_id, $full_name, $description, $file_destination, $proj_status, $image_path);
        
                    // Execute the statement
                    if ($stmt->execute()) {
                        echo "Project uploaded successfully.";
                    } else {
                        echo "Error uploading project: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    echo "Error moving uploaded file.";
                }
            } else {
                echo "File upload failed with error code: " . $file['error'];
            }
            break;

        case 'edit':
            $project_id = $_POST['project_id'];
            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);
            $file = $_FILES['proj_file'];
            $image = $_FILES['image_file'];

            // Update logic
            $query = "UPDATE projects SET title=?, description=? WHERE project_id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sss", $title, $description, $project_id);

            if ($stmt->execute()) {
                echo "Project updated successfully.";
            } else {
                echo "Error updating project: " . $stmt->error;
            }

            // Check for file upload and update path if necessary
            if ($file && $file['error'] === UPLOAD_ERR_OK) {
                $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $fileName = 'proj-' . uniqid() . '.' . $file_extension;
                $file_destination = './files/project/' . $fileName;
                if (move_uploaded_file($file['tmp_name'], $file_destination)) {
                    $update_query = "UPDATE projects SET project_path=? WHERE project_id=?";
                    $update_stmt = $conn->prepare($update_query);
                    $update_stmt->bind_param("ss", $file_destination, $project_id);
                    $update_stmt->execute();
                    $update_stmt->close();
                }
            }

            // Check for image upload and update path if necessary
            if ($image && $image['error'] === UPLOAD_ERR_OK) {
                $image_extension = pathinfo($image['name'], PATHINFO_EXTENSION);
                $imageFileName = 'image-' . uniqid() . '.' . $image_extension;
                $image_destination = './files/images/' . $imageFileName;
                if (move_uploaded_file($image['tmp_name'], $image_destination)) {
                    $update_query = "UPDATE projects SET project_image=? WHERE project_id=?";
                    $update_stmt = $conn->prepare($update_query);
                    $update_stmt->bind_param("ss", $image_destination, $project_id);
                    $update_stmt->execute();
                    $update_stmt->close();
                }
            }
            break;

        case 'delete':
            $project_id = $_POST['project_id'];

            // Validate the project_id and user ownership
            $query = "SELECT * FROM projects WHERE project_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $project_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Project found, proceed to delete
                $delete_query = "DELETE FROM projects WHERE project_id = ?";
                $delete_stmt = $conn->prepare($delete_query);
                $delete_stmt->bind_param("s", $project_id);

                if ($delete_stmt->execute()) {
                    echo 'success';
                } else {
                    echo 'Error: ' . $delete_stmt->error;
                }
                $delete_stmt->close();
            } else {
                echo 'Error: Project not found or you do not have permission to delete this project.';
            }

            $stmt->close();
            break;

        default:
            echo 'Invalid action.';
            break;
    }
} else {
    echo 'Invalid request method.';
}

$conn->close();
?>
