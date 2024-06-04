<?php
session_start();
include 'con.php';

$userId = $_POST['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['logoPicture'])) {
        // Handle profile picture update
        $logoPicture = $_FILES['logoPicture'];

        if ($logoPicture['error'] === 0) {

            $fileName = basename($logoPicture['name']);
            $targetDir = "./images/logo_pic/";

            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
            
            if (in_array($fileType, $allowedTypes)) {
                if (move_uploaded_file($logoPicture['tmp_name'], $targetFilePath)) {
                    $sql = "UPDATE recruiter_profile SET logo = ? WHERE User_ID = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('ss', $targetFilePath, $userId);
                    if ($stmt->execute()) {
                        $_SESSION['success_message'] = "Logo picture updated successfully.";
                    } else {
                        $_SESSION['error_message'] = "Error updating logo picture: " . $stmt->error;
                    }
                } else {
                    $_SESSION['error_message'] = "Error moving the uploaded file.";
                }
            } else {
                $_SESSION['error_message'] = "Upload failed. Allowed file types: " . implode(',', $allowedTypes);
            }
        } else {
            $_SESSION['error_message'] = "No file uploaded or there was an upload error.";
        }

    } elseif (isset($_POST['companyName'])) {
        // Handle company information update
        $companyName = $_POST['companyName'];
        $about = $_POST['about'];
        $contactEmail = $_POST['contactEmail'];
        $phone = $_POST['phone'];
        $website = $_POST['website'];

        $sql = "UPDATE recruiter_profile SET company_name = ?, contact_email = ?, contact_phone = ?, about = ?, website = ? WHERE User_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssss', $companyName, $about, $contactEmail, $phone, $website, $userId);
        if ($stmt->execute()) {
            
            $_SESSION['success_message'] = "Company information updated successfully.";
        } else {
            
            $_SESSION['error_message'] = "Failed to update company information.";
        }
    } elseif (isset($_POST['background'])) {
        // Handle study background update
        $compBackground = $_POST['background'];
        $sql = "UPDATE recruiter_profile SET background = ? WHERE User_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $compBackground, $userId);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Company background updated successfully.";
        } else {
            $_SESSION['error_message'] = "Failed to update company background.";
        }
    } 

    $conn->close();
    header("Location: edit_recruiter.php");
    exit();
}
?>
