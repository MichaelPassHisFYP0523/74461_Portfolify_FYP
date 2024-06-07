<?php
include 'con.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['full_name'], $_POST['description'], $_POST['user_id'], $_FILES['file'])) {
        
        $full_name = htmlspecialchars($_POST['full_name']);
        $description = htmlspecialchars($_POST['description']);
        $user_id = $_POST['user_id'];
        $file = $_FILES['file'];
        $status = 1;

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
                
                $sql = "INSERT INTO projects (project_id, user_id, title, description, created_at, project_path, proj_status) VALUES (?, ?, ?, ?, NOW(), ?, ?)";
                $stmt = $conn->prepare($sql);
                
                $stmt->bind_param("sssssi", $unique_id, $user_id, $full_name, $description, $file_destination, $status);

                if ($stmt->execute()) {
                    echo "";
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
    } else {
        echo "Required form fields are missing.";
    }
} else {
    echo "Form submission method is not POST.";
}
$conn->close();
?>
