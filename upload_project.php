<?php
include 'con.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = htmlspecialchars($_POST['full_name']);
    $description = htmlspecialchars($_POST['description']);
    $user_id = $_POST['user_id'];
    $proj_status = $_POST['collaborate'];
    $file = $_FILES['file'];
    $image = $_FILES['image_file']; // This is the optional image upload field

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

            // Prepare SQL statement with optional image path
            $sql = "INSERT INTO projects (project_id, user_id, title, description, created_at, project_path, proj_status, project_image) VALUES (?, ?, ?, ?, NOW(), ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bind_param("sssssss", $unique_id, $user_id, $full_name, $description, $file_destination, $proj_status, $image_path);

            // Set image path
            $image_path = null; // Default value for NULL (no image)

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

} else {
    echo "Form submission method is not POST.";
}
$conn->close();
?>
