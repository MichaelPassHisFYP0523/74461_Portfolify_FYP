<?php
session_start();

include 'con.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $userId = $_POST['user_id'];

    if (isset($_FILES['profilePicture'])) {
        // Handle profile picture update
        $profilePicture = $_FILES['profilePicture'];

        if ($profilePicture['error'] === 0) {

            $fileName = basename($profilePicture['name']);
            $targetDir = "./images/pro_pic/";

            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
            
            if (in_array($fileType, $allowedTypes)) {
                if (move_uploaded_file($profilePicture['tmp_name'], $targetFilePath)) {
                    $sql = "UPDATE user_profile SET ProfilePicture = ? WHERE User_ID = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('ss', $targetFilePath, $userId);
                    if ($stmt->execute()) {
                        $_SESSION['success_message'] = "Profile picture updated successfully.";
                    } else {
                        $_SESSION['error_message'] = "Error updating profile picture: " . $stmt->error;
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

    } elseif (isset($_POST['firstName'])) {
        // Handle personal information update
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $bio = $_POST['bio'];
        $gender = $_POST['gender'];
        $location = $_POST['location'];
        $socialMediaLinks = $_POST['socialMediaLinks'];

        $sql = "UPDATE user_profile SET FirstName = ?, LastName = ?, Bio = ?, Gender = ?, Location = ?, SocialMediaLinks = ? WHERE User_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssss', $firstName, $lastName, $bio, $gender, $location, $socialMediaLinks, $userId);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Personal information updated successfully.";
        } else {
            $_SESSION['error_message'] = "Failed to update personal information.";
        }
    } elseif (isset($_POST['workExperience'])) {
        // Handle work experience update
        $workExperience = $_POST['workExperience'];
        $skill = $_POST['skills'];
        $sql = "UPDATE user_profile SET Skills = ?, Experience = ? WHERE User_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $skill, $workExperience, $userId);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Work experience updated successfully";
        } else {
            $_SESSION['error_message'] = "Failed to update work experience..";
        }
    } elseif (isset($_POST['studyBackground'])) {
        // Handle study background update
        $studyBackground = $_POST['studyBackground'];
        $sql = "UPDATE user_profile SET Education = ? WHERE User_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $studyBackground, $userId);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Study background updated successfully.";
        } else {
            $_SESSION['error_message'] = "Failed to update study background.";
        }
    } elseif (isset($_FILES['resume'])) {
        // Handle resume upload
        $resume = $_FILES['resume'];

        if ($resume['error'] === 0) {
            $fileName = basename($resume['name']);

            $targetDir = "./files/resume/";

            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            $allowedTypes = array('pdf', 'doc', 'docx');
            if (in_array($fileType, $allowedTypes)) {
                if (move_uploaded_file($resume['tmp_name'], $targetFilePath)) {
                    $sql = "UPDATE user_profile SET Resume = ? WHERE User_ID = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('ss', $targetFilePath, $userId);
                    if ($stmt->execute()) {
                        $_SESSION['success_message'] = "Resume uploaded successfully.";
                    } else {
                        $_SESSION['error_message'] = "Failed to update resume in the database.";
                    }
                } else {
                    $_SESSION['error_message'] = "Failed to upload the file.";
                }
            } else {
                $_SESSION['error_message'] = "Only PDF, DOC, and DOCX files are allowed.";
            }
        } else {
            $_SESSION['error_message'] = "Error in file upload.";
        }
    }elseif (isset($_POST['industry'])) {
        // Handle perefernce update
        $industry = $_POST['industry'];
        $salary = $_POST['salary'];
        $availability = $_POST['availability'];

        $sql = "UPDATE user_profile SET prefer_industry = ?, expected_salary = ?, availability = ? WHERE User_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $industry, $salary, $availability, $userId);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Preference updated successfully.";
        } else {
            $_SESSION['error_message'] = "Failed to update Preference.";
        }
    }

    $conn->close();
    header("Location: edit_profile.php");
    exit();
}
?>
