<?php
include "con.php";

function generateShortID($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $shortID = '';
    for ($i = 0; $i < $length; $i++) {
        $shortID .= $characters[rand(0, $charactersLength - 1)];
    }
    return $shortID;
}

$response = array("status" => "", "message" => "");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = $_POST['job_id'];
    $applicant_id = $_POST['applicant_id'];
    $application_status = 'Pending'; 
    $applied_at = date('Y-m-d H:i:s');

    // Generate unique application_id
    $application_id = generateShortID(10); 
    // Handle file uploads
    $upload_dir = './files/resume/';

    if (!is_dir('./files/resume/')) {
        mkdir('./files/resume/', 0777, true);
    }

    $cover_letter_path = $upload_dir . basename($_FILES['coverLetter']['name']);
    $resume_path = $upload_dir . basename($_FILES['resume']['name']);

    if (move_uploaded_file($_FILES['coverLetter']['tmp_name'], $cover_letter_path)) {
        if ($_FILES['resume']['name']) {
            move_uploaded_file($_FILES['resume']['tmp_name'], $resume_path);
        } else {
            $resume_path = null;
        }

        // Insert into job_application table
        $stmt = $conn->prepare("INSERT INTO job_application (application_id, job_id, applicant_id, application_status, cover_letter, resume, applied_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $application_id, $job_id, $applicant_id, $application_status, $cover_letter_path, $resume_path, $applied_at);

        if ($stmt->execute()) {
            $response["status"] = "success";
            $response["message"] = "Application submitted successfully.";
        } else {
            $response["status"] = "error";
            $response["message"] = "Error submitting application: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $response["status"] = "error";
        $response["message"] = "Error uploading cover letter.";
    }

    $conn->close();
} else {
    $response["status"] = "error";
    $response["message"] = "Invalid request method.";
}

header('Content-Type: application/json');
echo json_encode($response);
?>
